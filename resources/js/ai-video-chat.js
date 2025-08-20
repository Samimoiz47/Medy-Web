// AI Video Chat Integration using Free Services
class AIVideoChat {
    constructor() {
        this.isListening = false;
        this.isSpeaking = false;
        this.currentLanguage = 'en';
        this.recognition = null;
        this.synthesis = null;
        this.chatHistory = [];
        this.apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
        this.apiKey = 'AIzaSyAJ6bjfLV23HWPsAoaf4m_cZYR8jzsvbaY';
        
        this.init();
    }

    init() {
        this.setupSpeechRecognition();
        this.setupSpeechSynthesis();
        this.setupEventListeners();
        this.addWelcomeMessage();
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
        }
    }

    setupSpeechSynthesis() {
        this.synthesis = window.speechSynthesis;
    }

    setupEventListeners() {
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.querySelector('.send-btn');
        const micBtn = document.querySelector('.mic-btn');
        const videoBtn = document.querySelector('.video-btn');
        const stopBtn = document.querySelector('.stop-btn');
        const languageSelect = document.getElementById('languageSelect');

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.handleUserMessage(messageInput.value);
            }
        });

        sendBtn.addEventListener('click', () => {
            this.handleUserMessage(messageInput.value);
        });

        micBtn.addEventListener('click', () => {
            this.startListening();
        });

        videoBtn.addEventListener('click', () => {
            this.toggleVideo();
        });

        if (stopBtn) {
            stopBtn.addEventListener('click', () => {
                this.stopResponse();
            });
        }

        // Add global click handler for stop buttons
        document.addEventListener('click', (e) => {
            if (e.target.matches('.stop-btn') || e.target.matches('[title*="Stop"]')) {
                e.preventDefault();
                this.stopResponse();
            }
        });

        languageSelect.addEventListener('change', (e) => {
            this.currentLanguage = e.target.value;
            this.updateLanguage();
        });
    }

    handleUserMessage(message) {
        if (!message.trim()) return;

        this.addMessage(message, 'user');
        this.showTypingIndicator();
        this.generateAIResponse(message);
        
        document.getElementById('messageInput').value = '';
    }

    async generateAIResponse(userMessage) {
        try {
            // Simulate AI response using free services
            const response = await this.getAIResponse(userMessage);
            this.hideTypingIndicator();
            this.addMessage(response, 'ai');
            this.speak(response);
        } catch (error) {
            console.error('AI response error:', error);
            this.hideTypingIndicator();
            this.addMessage('I apologize, but I encountered an error. Please try again.', 'ai');
        }
    }

    async getAIResponse(message) {
        // Using a simple rule-based response for demo
        // In production, integrate with actual AI services
        const responses = {
            'hello': 'Hello! How can I assist you today?',
            'hi': 'Hi there! What would you like to talk about?',
            'how are you': 'I am an AI, so I don\'t have feelings, but I\'m functioning perfectly! How can I help?',
            'what can you do': 'I can chat with you, answer questions, help with tasks, and even speak in multiple languages!',
            'help': 'I\'m here to help! You can ask me questions, have a conversation, or request assistance with various topics.',
            'bye': 'Goodbye! It was nice chatting with you. Have a great day!',
            'thank you': 'You\'re very welcome! Is there anything else I can help you with?',
            'weather': 'I don\'t have real-time weather data, but you can check your local weather app for current conditions.',
            'time': `The current time is ${new Date().toLocaleTimeString()}.`,
            'date': `Today is ${new Date().toLocaleDateString()}.`,
            'joke': 'Why don\'t scientists trust atoms? Because they make up everything!',
            'default': 'That\'s an interesting question! Let me think about that... I believe the key is to approach it systematically.'
        };

        const lowerMessage = message.toLowerCase();
        
        for (const [key, response] of Object.entries(responses)) {
            if (lowerMessage.includes(key)) {
                return response;
            }
        }
        
        return responses.default;
    }

    addMessage(message, sender) {
        const messagesContainer = document.getElementById('messagesContainer');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.textContent = message;
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        this.chatHistory.push({ sender, message });
    }

    addWelcomeMessage() {
        setTimeout(() => {
            this.speak('Hello! I am your AI assistant. I can speak and understand multiple languages. How can I help you today?');
        }, 1000);
    }

    speak(text) {
        if (this.synthesis && !this.isSpeaking) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = this.getLanguageCode();
            utterance.rate = 1;
            utterance.pitch = 1;
            
            utterance.onstart = () => {
                this.isSpeaking = true;
                document.querySelector('.avatar-face').textContent = '🗣️';
            };
            
            utterance.onend = () => {
                this.isSpeaking = false;
                document.querySelector('.avatar-face').textContent = '🤖';
            };
            
            this.synthesis.speak(utterance);
        }
    }

    startListening() {
        if (this.recognition && !this.isListening) {
            this.recognition.lang = this.getLanguageCode();
            this.recognition.start();
            this.isListening = true;
            document.querySelector('.avatar-face').textContent = '👂';
            
            setTimeout(() => {
                if (this.isListening) {
                    this.recognition.stop();
                    this.isListening = false;
                    document.querySelector('.avatar-face').textContent = '🤖';
                }
            }, 5000);
        }
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
    }

    showTypingIndicator() {
        document.getElementById('typingIndicator').style.display = 'block';
    }

    hideTypingIndicator() {
        document.getElementById('typingIndicator').style.display = 'none';
    }

    showError(message) {
        this.addMessage(message, 'ai');
    }

    toggleMute() {
        const btn = event.target;
        const isMuted = btn.textContent === '🔇';
        btn.textContent = isMuted ? '🔊' : '🔇';
        
        if (this.synthesis) {
            if (isMuted) {
                this.synthesis.resume();
            } else {
                this.synthesis.pause();
            }
        }
    }

    toggleVideo() {
        const btn = event.target;
        const isVideoOn = btn.textContent === '📹';
        btn.textContent = isVideoOn ? '📷' : '📹';
        
        // In a real implementation, this would toggle camera
        this.addMessage(isVideoOn ? 'Video turned off' : 'Video turned on', 'ai');
    }

    stopResponse() {
        console.log('🛑 Stop response triggered - Immediate stop');
        
        // Stop speech synthesis immediately with multiple methods
        if (this.synthesis) {
            this.synthesis.cancel();
            this.synthesis.pause();
            this.synthesis.cancel();
            this.isSpeaking = false;
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

        // Add user feedback
        this.addMessage('Voice response stopped.', 'system');
        
        console.log('✅ Voice response stopped by user');
    }

    endCall() {
        if (confirm('Are you sure you want to end the AI chat?')) {
            window.location.href = '/';
        }
    }
}

// Initialize AI Video Chat when page loads
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/ai-video-chat') {
        new AIVideoChat();
    }
});

// Export for use in other modules
window.AIVideoChat = AIVideoChat;
