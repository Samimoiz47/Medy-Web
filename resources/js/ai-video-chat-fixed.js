// AI Video Chat with Camera/Microphone Support and Fixed Buttons
class AIVideoChatFixed {
    constructor() {
        this.isListening = false;
        this.isSpeaking = false;
        this.isVideoOn = false;
        this.isAudioOn = false;
        this.currentLanguage = 'en';
        this.recognition = null;
        this.synthesis = null;
        this.chatHistory = [];
        this.localStream = null;
        this.cameraStream = null;
        this.microphoneStream = null;
        this.currentUtterance = null;
        this.isResponseActive = false;
        this.abortController = null;
        
        this.apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
        this.apiKey = 'AIzaSyAJ6bjfLV23HWPsAoaf4m_cZYR8jzsvbaY';
        
        this.init();
    }

    init() {
        this.setupSpeechRecognition();
        this.setupSpeechSynthesis();
        this.setupEventListeners();
        this.setupMediaDevices();
        this.addWelcomeMessage();
    }

    async setupMediaDevices() {
        try {
            await this.requestMediaPermissions();
        } catch (error) {
            console.error('Media setup error:', error);
            this.addMessage('Camera/Microphone access denied. Text chat will still work.', 'ai');
        }
    }

    async requestMediaPermissions() {
        try {
            const constraints = {
                video: { width: { ideal: 640 }, height: { ideal: 480 } },
                audio: { echoCancellation: true, noiseSuppression: true }
            };
            
            this.localStream = await navigator.mediaDevices.getUserMedia(constraints);
            
            this.cameraStream = this.localStream.getVideoTracks()[0];
            this.microphoneStream = this.localStream.getAudioTracks()[0];
            
            this.isVideoOn = true;
            this.isAudioOn = true;
            
            console.log('Camera and microphone access granted');
            this.addMessage('Camera and microphone access granted! Ready for video chat.', 'ai');
            
        } catch (error) {
            console.error('Permission denied:', error);
            this.addMessage('Camera/Microphone access denied. Using text-based chat.', 'ai');
        }
    }

    setupSpeechRecognition() {
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            this.recognition.continuous = false;
            this.recognition.interimResults = false;
            this.recognition.lang = 'en-US';

            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.handleUserMessage(transcript);
            };

            this.recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                this.showError('Speech recognition error. Please try again.');
            };

            this.recognition.onend = () => {
                this.isListening = false;
                this.updateAvatar('🤖');
            };
        }
    }

    setupSpeechSynthesis() {
        this.synthesis = window.speechSynthesis;
    }

    stopResponse() {
        console.log('🛑 Stop response triggered - Immediate stop');
        
        // Stop speech synthesis immediately with multiple methods
        if (this.synthesis) {
            // Cancel any ongoing speech immediately
            this.synthesis.cancel();
            
            // Force pause and clear queue
            this.synthesis.pause();
            this.synthesis.cancel(); // Double cancel for reliability
            
            this.isSpeaking = false;
            this.isResponseActive = false;
            
            // Clear any pending utterances
            if (this.currentUtterance) {
                this.currentUtterance.onend = null;
                this.currentUtterance.onstart = null;
                this.currentUtterance.onerror = null;
                this.currentUtterance.onpause = null;
                this.currentUtterance = null;
            }
        }

        // Stop speech recognition if active
        if (this.recognition && this.isListening) {
            try {
                this.recognition.stop();
                this.isListening = false;
            } catch (e) {
                console.log('Recognition already stopped:', e);
            }
        }

        // Hide typing indicator immediately
        this.hideTypingIndicator();
        
        // Add visual feedback
        this.updateAvatar('⏹️');
        
        // Reset avatar after brief feedback
        setTimeout(() => {
            this.updateAvatar('🤖');
        }, 800);
        
        // Add user feedback
        this.addMessage('Voice response stopped.', 'system');
        
        console.log('✅ Voice response stopped by user');
    }

    setupEventListeners() {
        // Wait for DOM to be fully loaded
        setTimeout(() => {
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.querySelector('.send-btn')
            const micBtn = document.querySelector('.mic-btn')
            const videoBtn = document.querySelector('.video-btn')
            const muteBtn = document.querySelector('.mute-btn')
            const stopBtn = document.querySelector('.stop-btn')
            const endCallBtn = document.querySelector('.end-call-btn')
            const languageSelect = document.getElementById('languageSelect')

            // Ensure language selector is clickable and properly initialized
            if (languageSelect) {
                // Force enable pointer events and cursor
                languageSelect.style.pointerEvents = 'auto';
                languageSelect.style.cursor = 'pointer';
                languageSelect.style.zIndex = '1002';
                languageSelect.style.position = 'relative';
                
                // Add multiple event listeners for maximum compatibility
                languageSelect.addEventListener('change', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.currentLanguage = e.target.value;
                    this.updateLanguage();
                });
                
                // Handle click events
                languageSelect.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                });
                
                // Handle mousedown events for mobile
                languageSelect.addEventListener('mousedown', (e) => {
                    e.stopPropagation();
                });
                
                // Handle touch events for mobile
                languageSelect.addEventListener('touchstart', (e) => {
                    e.stopPropagation();
                });
                
                console.log('Language selector initialized and clickable');
            }

            // Use more specific selectors to ensure we get the right buttons
            const allStopBtns = document.querySelectorAll('.stop-btn, [title*="Stop"], [onclick*="stop"]')
            const allMuteBtns = document.querySelectorAll('.mute-btn, [title*="Mute"]')
            const allVideoBtns = document.querySelectorAll('.video-btn, [title*="Video"]')
            const allEndCallBtns = document.querySelectorAll('.end-call-btn, [title*="End"]')

            if (sendBtn) {
                sendBtn.addEventListener('click', () => {
                    const input = document.getElementById('messageInput')
                    if (input) this.handleUserMessage(input.value)
                })
            }

            if (messageInput) {
                messageInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.handleUserMessage(messageInput.value)
                    }
                })
            }

            if (micBtn) {
                micBtn.addEventListener('click', () => {
                    this.startListening()
                })
            }

            // Enhanced button listeners with multiple selectors
            allVideoBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.toggleVideo()
                })
            })

            allMuteBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.toggleMute()
                })
            })

            // Enhanced stop button listeners
            allStopBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.stopResponse()
                })
            })

            allEndCallBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.endCall()
                })
            })

            // Also add global click handlers for better reliability
            document.addEventListener('click', (e) => {
                if (e.target.matches('.stop-btn') || e.target.matches('[title*="Stop"]')) {
                    e.preventDefault()
                    this.stopResponse()
                }
            })
        }, 500) // Increased timeout to ensure DOM is fully loaded
    }

    handleUserMessage(message) {
        if (!message || !message.trim()) return;

        this.addMessage(message.trim(), 'user');
        this.showTypingIndicator();
        this.generateAIResponse(message.trim());
        
        const messageInput = document.getElementById('messageInput');
        if (messageInput) messageInput.value = '';
    }

    async generateAIResponse(userMessage) {
        try {
            const response = await this.getEnhancedAIResponse(userMessage);
            this.hideTypingIndicator();
            this.addMessage(response, 'ai');
            this.speak(response);
        } catch (error) {
            console.error('AI response error:', error);
            this.hideTypingIndicator();
            this.addMessage('I apologize, but I encountered an error. Please try again.', 'ai');
        }
    }

    async getEnhancedAIResponse(message) {
        try {
            const response = await fetch(this.apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-goog-api-key': this.apiKey
                },
                body: JSON.stringify({
                    contents: [
                        {
                            parts: [
                                {
                                    text: message
                                }
                            ]
                        }
                    ]
                })
            });

            if (!response.ok) {
                throw new Error(`API request failed: ${response.status}`);
            }

            const data = await response.json();
            
            // Extract the response text from Gemini API response
            if (data.candidates && data.candidates[0] && 
                data.candidates[0].content && data.candidates[0].content.parts && 
                data.candidates[0].content.parts[0]) {
                return data.candidates[0].content.parts[0].text;
            } else {
                throw new Error('Invalid response format from API');
            }
        } catch (error) {
            console.error('Error calling Gemini API:', error);
            // Fallback to a simple response if API fails
            return "I'm having trouble connecting to the AI service. Please try again in a moment.";
        }
    }

    addMessage(message, sender) {
        const messagesContainer = document.getElementById('messagesContainer');
        if (!messagesContainer) return;

        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.textContent = message;
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        this.chatHistory.push({ sender, message });
    }

    addWelcomeMessage() {
        setTimeout(() => {
            this.speak('Hello! I am your AI assistant with full camera and microphone access. How can I help you today?');
        }, 2000);
    }

    speak(text) {
        if (this.synthesis && !this.isSpeaking) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = this.getLanguageCode();
            utterance.rate = 1;
            utterance.pitch = 1;
            
            utterance.onstart = () => {
                this.isSpeaking = true;
                this.updateAvatar('🗣️');
            };
            
            utterance.onend = () => {
                this.isSpeaking = false;
                this.updateAvatar('🤖');
            };
            
            this.synthesis.speak(utterance);
        }
    }

    updateAvatar(emoji) {
        const avatar = document.querySelector('.avatar-face');
        if (avatar) avatar.textContent = emoji;
    }

    startListening() {
        if (this.recognition && !this.isListening) {
            this.recognition.lang = this.getLanguageCode();
            this.recognition.start();
            this.isListening = true;
            this.updateAvatar('👂');
        }
    }

    toggleVideo() {
        const videoBtn = document.querySelector('.video-btn');
        if (!videoBtn || !this.cameraStream) return;

        this.isVideoOn = !this.isVideoOn;
        this.cameraStream.enabled = this.isVideoOn;
        videoBtn.textContent = this.isVideoOn ? '📹' : '📷';
        videoBtn.title = this.isVideoOn ? 'Turn Video Off' : 'Turn Video On';
        
        this.addMessage(this.isVideoOn ? 'Video turned on' : 'Video turned off', 'ai');
    }

    toggleMute() {
        const muteBtn = document.querySelector('.mute-btn');
        if (!muteBtn || !this.microphoneStream) return;

        this.isAudioOn = !this.isAudioOn;
        this.microphoneStream.enabled = this.isAudioOn;
        muteBtn.textContent = this.isAudioOn ? '🔊' : '🔇';
        muteBtn.title = this.isAudioOn ? 'Mute' : 'Unmute';
        
        this.addMessage(this.isAudioOn ? 'Microphone unmuted' : 'Microphone muted', 'ai');
    }

    getLanguageCode() {
        const languageMap = {
            'en': 'en-US',
            'es': 'es-ES',
            'fr': 'fr-FR',
            'de': 'de-DE',
            'it': 'it-IT',
            'pt': 'pt-PT',
            'ru': 'ru-RU',
            'ja': 'ja-JP',
            'ko': 'ko-KR',
            'zh': 'zh-CN',
            'ar': 'ar-SA',
            'hi': 'hi-IN'
        };
        
        return languageMap[this.currentLanguage] || 'en-US';
    }

    updateLanguage() {
        const languageNames = {
            'en': 'English',
            'es': 'Spanish',
            'fr': 'French',
            'de': 'German',
            'it': 'Italian',
            'pt': 'Portuguese',
            'ru': 'Russian',
            'ja': 'Japanese',
            'ko': 'Korean',
            'zh': 'Chinese',
            'ar': 'Arabic',
            'hi': 'Hindi'
        };
        
        this.addMessage(`Language changed to ${languageNames[this.currentLanguage]}`, 'ai');
        this.speak(`I will now speak in ${languageNames[this.currentLanguage]}`);
        
        // Ensure speech recognition language is updated
        if (this.recognition) {
            this.recognition.lang = this.getLanguageCode();
        }
    }

    showTypingIndicator() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.style.display = 'block';
    }

    hideTypingIndicator() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.style.display = 'none';
    }

    showError(message) {
        this.addMessage(message, 'ai');
    }

    endCall() {
        // Stop all media streams
        if (this.localStream) {
            this.localStream.getTracks().forEach(track => track.stop());
        }
        
        if (confirm('Are you sure you want to end the AI chat?')) {
            window.location.href = '/';
        }
    }
}

// Initialize AI Video Chat when page loads
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.includes('ai-video-chat')) {
        new AIVideoChatFixed();
    }
});

// Export for use in other modules
window.AIVideoChatFixed = AIVideoChatFixed;
