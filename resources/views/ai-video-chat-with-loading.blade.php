<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Video Chat - Medy Apps</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Orbitron', monospace;
            background: #0a0a0a;
            color: #ffffff;
            overflow: hidden;
            height: 100vh;
        }

        /* Loading Animation Styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading-spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(0, 212, 255, 0.3);
            border-top: 4px solid #00d4ff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        .loading-text {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            color: #00d4ff;
            font-size: 1.2rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        /* Floating particles for loading */
        .loading-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #00d4ff;
            border-radius: 50%;
            animation: float 6s infinite linear;
            box-shadow: 0 0 10px #00d4ff;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        .chat-container {
            display: flex;
            height: 100vh;
            position: relative;
        }

        .video-section {
            flex: 2;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-right: 2px solid #00d4ff;
        }

        .ai-avatar {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.1), transparent);
        }

        .avatar-face {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(45deg, #00d4ff, #ff00ff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: 0 0 50px rgba(0, 212, 255, 0.5);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .chat-section {
            flex: 1;
            background: rgba(10, 10, 10, 0.9);
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .chat-title {
            font-size: 2rem;
            color: #00d4ff;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .chat-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            border: 1px solid rgba(0, 212, 255, 0.2);
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.8rem;
            border-radius: 10px;
            max-width: 80%;
            word-wrap: break-word;
        }

        .message.user {
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            margin-left: auto;
            text-align: right;
        }

        .message.ai {
            background: linear-gradient(135deg, #ff00ff, #ff1493);
            margin-right: auto;
        }

        .input-container {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .message-input {
            flex: 1;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid #00d4ff;
            border-radius: 25px;
            color: white;
            font-family: 'Orbitron', monospace;
            outline: none;
        }

        .message-input:focus {
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .send-btn, .mic-btn, .video-btn {
            padding: 1rem;
            border: none;
            border-radius: 50%;
            background: linear-gradient(45deg, #00d4ff, #ff00ff);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .send-btn:hover, .mic-btn:hover, .video-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 212, 255, 0.7);
        }

        .controls {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1rem;
            background: rgba(0, 0, 0, 0.7);
            padding: 1rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }

        .control-btn {
            padding: 0.8rem;
            border: none;
            border-radius: 50%;
            background: rgba(0, 212, 255, 0.2);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .control-btn:hover {
            background: rgba(0, 212, 255, 0.5);
            transform: scale(1.1);
        }

        .language-selector {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: rgba(0, 0, 0, 0.7);
            padding: 0.5rem;
            border-radius: 10px;
            border: 1px solid #00d4ff;
        }

        .language-selector select {
            background: transparent;
            border: none;
            color: white;
            font-family: 'Orbitron', monospace;
            outline: none;
        }

        .status-indicator {
            position: absolute;
            top: 2rem;
            left: 2rem;
            padding: 0.5rem 1rem;
            background: rgba(0, 255, 136, 0.2);
            border: 1px solid #00ff88;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .typing-indicator {
            display: none;
            color: #00d4ff;
            font-style: italic;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .chat-container {
                flex-direction: column;
            }
            
            .video-section {
                flex: 1;
                border-right: none;
                border-bottom: 2px solid #00d4ff;
            }
            
            .chat-section {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-particles">
            <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
            <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 70%; animation-delay: 6s;"></div>
            <div class="particle" style="left: 80%; animation-delay: 7s;"></div>
            <div class="particle" style="left: 90%; animation-delay: 8s;"></div>
        </div>
        <div class="loading-spinner"></div>
        <div class="loading-text">Initializing AI Video Chat...</div>
    </div>

    <div class="chat-container">
        <!-- Video Section -->
        <div class="video-section">
            <div class="status-indicator">AI Online</div>
            <div class="language-selector">
                <select id="languageSelect">
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                    <option value="de">Deutsch</option>
                    <option value="it">Italiano</option>
                    <option value="pt">Português</option>
                    <option value="ru">Русский</option>
                    <option value="ja">日本語</option>
                    <option value="ko">한국어</option>
                    <option value="zh">中文</option>
                    <option value="ar">العربية</option>
                    <option value="hi">हिन्दी</option>
                </select>
            </div>
            
            <div class="ai-avatar">
                <div class="avatar-face">🤖</div>
            </div>
            
            <div class="controls">
                <button class="control-btn" onclick="toggleMute()" title="Mute/Unmute">🔊</button>
                <button class="control-btn" onclick="toggleVideo()" title="Video On/Off">📹</button>
                <button class="control-btn" onclick="endCall()" title="End Call">📞</button>
            </div>
        </div>

        <!-- Chat Section -->
        <div class="chat-section">
            <div class="chat-header">
                <h2 class="chat-title">AI Video Chat</h2>
                <p class="chat-subtitle">Powered by Free AI Models</p>
            </div>

            <div class="messages-container" id="messagesContainer">
                <div class="message ai">
                    Hello! I'm your AI assistant. I can speak and understand multiple languages. How can I help you today?
                </div>
            </div>

            <div class="typing-indicator" id="typingIndicator">AI is typing...</div>

            <div class="input-container">
                <input type="text" class="message-input" id="messageInput" placeholder="Type your message...">
                <button class="send-btn" onclick="sendMessage()">📤</button>
                <button class="mic-btn" onclick="startListening()">🎤</button>
                <button class="video-btn" onclick="toggleVideo()">📹</button>
            </div>
        </div>
    </div>

    <script>
        // Hide loading overlay after page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                const loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }, 2000);
        });

        // Enhanced AI Video Chat functionality
        class AIVideoChat {
            constructor() {
                this.isListening = false;
                this.isSpeaking = false;
                this.currentLanguage = 'en';
                this.recognition = null;
                this.synthesis = null;
                this.chatHistory = [];
                this.init();
            }

            init() {
                this.setupSpeechRecognition();
                this.setupSpeechSynthesis();
                this.setupEventListeners();
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
                    };

                    this.recognition.onend = () => {
                        this.isListening = false;
                        document.querySelector('.mic-btn').textContent = '🎤';
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
                const languageSelect = document.getElementById('languageSelect');

                if (sendBtn) {
                    sendBtn.addEventListener('click', () => {
                        const message = messageInput.value.trim();
                        if (message) this.handleUserMessage(message);
                    });
                }

                if (messageInput) {
                    messageInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            const message = messageInput.value.trim();
                            if (message) this.handleUserMessage(message);
                        }
                    });
                }

                if (micBtn) {
                    micBtn.addEventListener('click', () => {
                        this.startListening();
                    });
                }

                if (languageSelect) {
                    languageSelect.addEventListener('change', (e) => {
                        this.currentLanguage = e.target.value;
                        this.updateLanguage();
                    });
                }
            }

            handleUserMessage(message) {
                if (!message.trim()) return;

                this.addMessage(message, 'user');
                this.showTypingIndicator();
                this.generateAIResponse(message);
                
                const messageInput = document.getElementById('messageInput');
                if (messageInput) messageInput.value = '';
            }

            async generateAIResponse(userMessage) {
                try {
                    // Simulate AI response for demo
                    setTimeout(() => {
                        this.hideTypingIndicator();
                        const responses = [
                            "I understand your message. How can I assist you further?",
                            "That's an interesting question. Let me help you with that.",
                            "I'm here to help! What would you like to know?",
                            "Thank you for your message. I'm processing your request."
                        ];
                        const response = responses[Math.floor(Math.random() * responses.length)];
                        this.addMessage(response, 'ai');
                        this.speak(response);
                    }, 1500);
                } catch (error) {
                    console.error('AI response error:', error);
                    this.hideTypingIndicator();
                    this.addMessage("I apologize, but I'm having trouble processing your request. Please try again.", 'ai');
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
            }

            speak(text) {
                if (this.synthesis && !this.isSpeaking) {
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'en-US';
                    
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
                    this.recognition.start();
                    this.isListening = true;
                    document.querySelector('.mic-btn').textContent = '👂';
                    document.querySelector('.avatar-face').textContent = '👂';
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

            updateLanguage() {
                const languageNames = {
                    'en': 'English', 'es': 'Spanish', 'fr': 'French', 'de': 'German',
                    'it': 'Italian', 'pt': 'Portuguese', 'ru': 'Russian', 'ja': 'Japanese',
                    'ko': 'Korean', 'zh': 'Chinese', 'ar': 'Arabic', 'hi': 'Hindi'
                };
                this.addMessage(`Language changed to ${languageNames[this.currentLanguage]}`, 'ai');
            }
        }

        // Initialize AI Video Chat
        document.addEventListener('DOMContentLoaded', () => {
            const chat = new AIVideoChat();
            
            // Add enhanced functionality
            window.toggleMute = () => {
                const btn = document.querySelector('[title*="Mute"]');
                btn.textContent = btn.textContent === '🔊' ? '🔇' : '🔊';
                chat.addMessage('Microphone toggled', 'system');
            };
            
            window.toggleVideo = () => {
                const btn = document.querySelector('[title*="Video"]');
                btn.textContent = btn.textContent === '📹' ? '📷' : '📹';
                chat.addMessage('Video toggled', 'system');
            };
            
            window.endCall = () => {
                if (confirm('Are you sure you want to end the chat?')) {
                    window.location.href = '/';
                }
            };
        });
    </script>
</body>
</html>
