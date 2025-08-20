// Enhanced AI Video Chat with Complete Multi-Language Support
// This version integrates language packs and provides comprehensive language responses

class AIVideoChatEnhanced {
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
        
        // Enhanced language support
        this.languageManager = new LanguageManager();
        this.currentLanguagePack = this.languageManager.getCurrentLanguage();
        
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
            const errorMsg = this.languageManager.getMessage('errorMessages', 'network') || 
                           'Camera/Microphone access denied. Text chat will still work.';
            this.addMessage(errorMsg, 'ai');
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
            const welcomeMsg = this.languageManager.getMessage('welcomeMessages') || 
                             'Camera and microphone access granted! Ready for video chat.';
            this.addMessage(welcomeMsg, 'ai');
            
        } catch (error) {
            console.error('Permission denied:', error);
            const fallbackMsg = this.languageManager.getMessage('errorMessages', 'network') || 
                              'Camera/Microphone access denied. Using text-based chat.';
            this.addMessage(fallbackMsg, 'ai');
        }
    }

    setupSpeechRecognition() {
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            this.recognition.continuous = false;
            this.recognition.interimResults = false;
            this.recognition.lang = this.getLanguageCode();

            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.handleUserMessage(transcript);
            };

            this.recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                const errorMsg = this.languageManager.getMessage('errorMessages', 'speech') || 
                               'Speech recognition error. Please try again.';
                this.showError(errorMsg);
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
        
        if (this.synthesis) {
            this.synthesis.cancel();
            this.synthesis.pause();
            this.synthesis.cancel();
            
            this.isSpeaking = false;
            this.isResponseActive = false;
            
            if (this.currentUtterance) {
                this.currentUtterance.onend = null;
                this.currentUtterance.onstart = null;
                this.currentUtterance.onerror = null;
                this.currentUtterance.onpause = null;
                this.currentUtterance = null;
            }
        }

        if (this.recognition && this.isListening) {
            try {
                this.recognition.stop();
                this.isListening = false;
            } catch (e) {
                console.log('Recognition already stopped:', e);
            }
        }

        this.hideTypingIndicator();
        this.updateAvatar('⏹️');
        
        setTimeout(() => {
            this.updateAvatar('🤖');
        }, 800);
        
        const stopMsg = this.languageManager.getMessage('commonResponses', 'goodbye') || 
                      'Voice response stopped.';
        this.addMessage(stopMsg, 'system');
        
        console.log('✅ Voice response stopped by user');
    }

    setupEventListeners() {
        setTimeout(() => {
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.querySelector('.send-btn');
            const micBtn = document.querySelector('.mic-btn');
            const videoBtn = document.querySelector('.video-btn');
            const muteBtn = document.querySelector('.mute-btn');
            const stopBtn = document.querySelector('.stop-btn');
            const endCallBtn = document.querySelector('.end-call-btn');
            const languageSelect = document.getElementById('languageSelect');

            if (languageSelect) {
                languageSelect.style.pointerEvents = 'auto';
                languageSelect.style.cursor = 'pointer';
                languageSelect.style.zIndex = '1002';
                languageSelect.style.position = 'relative';
                
                languageSelect.addEventListener('change', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.currentLanguage = e.target.value;
                    this.languageManager.setLanguage(this.currentLanguage);
                    this.currentLanguagePack = this.languageManager.getCurrentLanguage();
                    this.updateLanguage();
                });
                
                languageSelect.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                });
                
                languageSelect.addEventListener('mousedown', (e) => {
                    e.stopPropagation();
                });
                
                languageSelect.addEventListener('touchstart', (e) => {
                    e.stopPropagation();
                });
                
                console.log('Language selector initialized and clickable');
            }

            const allStopBtns = document.querySelectorAll('.stop-btn, [title*="Stop"], [onclick*="stop"]');
            const allMuteBtns = document.querySelectorAll('.mute-btn, [title*="Mute"]');
            const allVideoBtns = document.querySelectorAll('.video-btn, [title*="Video"]');
            const allEndCallBtns = document.querySelectorAll('.end-call-btn, [title*="End"]');

            if (sendBtn) {
                sendBtn.addEventListener('click', () => {
                    const input = document.getElementById('messageInput');
                    if (input) this.handleUserMessage(input.value);
                });
            }

            if (messageInput) {
                messageInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.handleUserMessage(messageInput.value);
                    }
                });
            }

            if (micBtn) {
                micBtn.addEventListener('click', () => {
                    this.startListening();
                });
            }

            allVideoBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.toggleVideo();
                });
            });

            allMuteBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.toggleMute();
                });
            });

            allStopBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.stopResponse();
                });
            });

            allEndCallBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.endCall();
                });
            });

            document.addEventListener('click', (e) => {
                if (e.target.matches('.stop-btn') || e.target.matches('[title*="Stop"]')) {
                    e.preventDefault();
                    this.stopResponse();
                }
            });
        }, 500);
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
            const errorMsg = this.languageManager.getMessage('errorMessages', 'api') || 
                           'I apologize, but I encountered an error. Please try again.';
            this.addMessage(errorMsg, 'ai');
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
                                    text: `Please respond in ${this.languageManager.getLanguageName(this.currentLanguage)}: ${message}`
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
            
            if (data.candidates && data.candidates[0] && 
                data.candidates[0].content && data.candidates[0].content.parts && 
                data.candidates[0].content.parts[0]) {
                return data.candidates[0].content.parts[0].text;
            } else {
                throw new Error('Invalid response format from API');
            }
        } catch (error) {
            console.error('Error calling Gemini API:', error);
            const fallbackMsg = this.languageManager.getMessage('errorMessages', 'api') || 
                              "I'm having trouble connecting to the AI service. Please try again in a moment.";
            return fallbackMsg;
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
            const welcomeMsg = this.languageManager.getMessage('welcomeMessages') || 
                             'Hello! I am your AI assistant with full camera and microphone access. How can I help you today?';
            this.speak(welcomeMsg);
        }, 2000);
    }

    speak(text) {
        if (this.synthesis && !this.isSpeaking) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = this.getLanguageCode();
            
            const voiceSettings = this.languageManager.getVoiceSettings();
            if (voiceSettings) {
                utterance.rate = voiceSettings.rate;
                utterance.pitch = voiceSettings.pitch;
                utterance.volume = voiceSettings.volume;
            }
            
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
        
        const videoMsg = this.isVideoOn ? 
            this.languageManager.getMessage('commonResponses', 'help') || 'Video turned on' : 
            this.languageManager.getMessage('commonResponses', 'goodbye') || 'Video turned off';
        this.addMessage(videoMsg, 'ai');
    }

    toggleMute() {
        const muteBtn = document.querySelector('.mute-btn');
        if (!muteBtn || !this.microphoneStream) return;

        this.isAudioOn = !this.isAudioOn;
        this.microphoneStream.enabled = this.isAudioOn;
        muteBtn.textContent = this.isAudioOn ? '🔊' : '🔇';
        muteBtn.title = this.isAudioOn ? 'Mute' : 'Unmute';
        
        const muteMsg = this.isAudioOn ? 
            this.languageManager.getMessage('commonResponses', 'help') || 'Microphone unmuted' : 
            this.languageManager.getMessage('commonResponses', 'goodbye') || 'Microphone muted';
        this.addMessage(muteMsg, 'ai');
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
        const languageName = this.languageManager.getLanguageName(this.currentLanguage);
        const changeMsg = `${this.languageManager.getLanguageName(this.currentLanguage)} में बदल दिया गया है`;
        this.addMessage(`Language changed to ${languageName}`, 'ai');
        
        const speakMsg = this.languageManager.getMessage('welcomeMessages') || 
                        `I will now speak in ${languageName}`;
        this.speak(speakMsg);
        
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
        if (this.localStream) {
            this.localStream.getTracks().forEach(track => track.stop());
        }
        
        const confirmMsg = this.languageManager.getMessage('commonResponses', 'goodbye') || 
                         'Are you sure you want to end the AI chat?';
        if (confirm(confirmMsg)) {
            window.location.href = '/';
        }
    }
}

// Initialize Enhanced AI Video Chat when page loads
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.includes('ai-video-chat')) {
        new AIVideoChatEnhanced();
    }
});

// Export for use in other modules
window.AIVideoChatEnhanced = AIVideoChatEnhanced;
