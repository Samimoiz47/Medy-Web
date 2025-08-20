<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Video Chat - Enhanced Multi-Language Support</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/ai-video-chat-complete.css', 'resources/css/ai-video-chat-enhanced-loading.css', 'resources/js/language-packs.js', 'resources/js/ai-video-chat-enhanced.js'])
    <style>
        /* Enhanced Multi-Language Variables */
        :root {
            --neon-blue: #00f5ff;
            --neon-pink: #ff0080;
            --neon-purple: #7b68ee;
            --neon-green: #39ff14;
            --neon-yellow: #ffff00;
            --neon-orange: #ff6b35;
            --dark-bg: #0a0a0f;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --language-indicator: #ff6b35;
        }

        body {
            font-family: 'Orbitron', monospace;
            background: var(--dark-bg);
            color: #ffffff;
            overflow: hidden;
            height: 100vh;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(0, 245, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(255, 0, 128, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(123, 104, 238, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 30% 80%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
        }

        .chat-container {
            display: flex;
            height: 100vh;
            position: relative;
            background: var(--dark-bg);
            border: 3px solid transparent;
            animation: lightning-border 4s linear infinite;
            overflow: hidden;
        }

        .video-section {
            flex: 2;
            position: relative;
            background: linear-gradient(135deg, 
                rgba(0, 245, 255, 0.1), 
                rgba(255, 0, 128, 0.1), 
                rgba(123, 104, 238, 0.1),
                rgba(255, 107, 53, 0.1));
            border-right: 2px solid;
            border-image: linear-gradient(to bottom, 
                var(--neon-blue), 
                var(--neon-pink), 
                var(--neon-purple),
                var(--neon-orange)) 1;
            animation: lightning-border 3s linear infinite;
        }

        .ai-avatar {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .avatar-face {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, 
                var(--neon-blue), 
                var(--neon-pink), 
                var(--neon-purple),
                var(--neon-orange));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            animation: electric-pulse 2s ease-in-out infinite;
            box-shadow: 
                0 0 30px var(--neon-blue),
                0 0 60px var(--neon-pink),
                0 0 90px var(--neon-purple),
                0 0 120px var(--neon-orange);
        }

        .chat-section {
            flex: 1;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-left: 2px solid;
            border-image: linear-gradient(to bottom, 
                var(--neon-green), 
                var(--neon-yellow), 
                var(--neon-blue),
                var(--neon-orange)) 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            border: 1px solid rgba(0, 245, 255, 0.3);
        }

        .message {
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 15px;
            max-width: 80%;
            word-wrap: break-word;
            border: 1px solid transparent;
            animation: lightning-border 5s linear infinite;
        }

        .message.user {
            background: linear-gradient(135deg, 
                rgba(0, 245, 255, 0.2), 
                rgba(0, 153, 204, 0.2));
            margin-left: auto;
            text-align: right;
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px rgba(0, 245, 255, 0.3);
        }

        .message.ai {
            background: linear-gradient(135deg, 
                rgba(255, 0, 128, 0.2), 
                rgba(255, 20, 147, 0.2));
            margin-right: auto;
            border-color: var(--neon-pink);
            box-shadow: 0 0 15px rgba(255, 0, 128, 0.3);
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
            border: 2px solid;
            border-image: linear-gradient(45deg, 
                var(--neon-blue), 
                var(--neon-pink), 
                var(--neon-purple),
                var(--neon-orange)) 1;
            border-radius: 25px;
            color: white;
            font-family: 'Orbitron', monospace;
        }

        .send-btn, .mic-btn, .video-btn {
            padding: 1rem;
            border: 2px solid;
            border-radius: 50%;
            background: linear-gradient(45deg, 
                var(--neon-blue), 
                var(--neon-pink), 
                var(--neon-purple),
                var(--neon-orange));
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .send-btn:hover, .mic-btn:hover, .video-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(0, 245, 255, 0.7);
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
            border: 2px solid;
            border-image: linear-gradient(45deg, 
                var(--neon-blue), 
                var(--neon-pink)) 1;
            animation: lightning-border 2.5s linear infinite;
        }

        .control-btn {
            padding: 0.8rem;
            border: 1px solid;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            border-image: linear-gradient(45deg, 
                var(--neon-blue), 
                var(--neon-pink)) 1;
        }

        .control-btn:hover {
            background: rgba(0, 245, 255, 0.2);
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 245, 255, 0.5);
        }

        .language-selector {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: rgba(0, 0, 0, 0.7);
            padding: 0.5rem;
            border-radius: 10px;
            border: 2px solid;
            border-image: linear-gradient(45deg, 
                var(--neon-blue), 
                var(--neon-pink)) 1;
            animation: lightning-border 3s linear infinite;
        }

        .language-selector select {
            background: transparent;
            border: none;
            color: white;
            font-family: 'Orbitron', monospace;
            outline: none;
            cursor: pointer;
            font-size: 14px;
            padding: 8px 12px;
        }

        .language-selector select option {
            background: #000;
            color: white;
            padding: 8px;
        }

        .status-indicator {
            position: absolute;
            top: 2rem;
            left: 2rem;
            padding: 0.5rem 1rem;
            background: rgba(0, 255, 136, 0.2);
            border: 2px solid var(--neon-green);
            border-radius: 20px;
            font-size: 0.8rem;
            animation: lightning-border 4s linear infinite;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
        }

        .typing-indicator {
            display: none;
            color: var(--neon-blue);
            font-style: italic;
            margin-bottom: 1rem;
            animation: electric-pulse 1s ease-in-out infinite;
        }

        .language-indicator {
            position: absolute;
            top: 4rem;
            left: 2rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 107, 53, 0.2);
            border: 2px solid var(--language-indicator);
            border-radius: 20px;
            font-size: 0.8rem;
            animation: lightning-border 3s linear infinite;
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
        }

        @media (max-width: 768px) {
            .chat-container {
                flex-direction: column;
            }

            .video-section {
                flex: 1;
                border-right: none;
                border-bottom: 2px solid;
                border-image: linear-gradient(to right, 
                    var(--neon-blue), 
                    var(--neon-pink), 
                    var(--neon-purple),
                    var(--neon-orange)) 1;
            }

            .chat-section {
                flex: 1;
                border-left: none;
                border-top: 2px solid;
                border-image: linear-gradient(to right, 
                    var(--neon-green), 
                    var(--neon-yellow), 
                    var(--neon-blue),
                    var(--neon-orange)) 1;
            }

            .avatar-face {
                width: 200px;
                height: 200px;
                font-size: 3rem;
            }
        }

        @keyframes lightning-border {
            0% {
                border-color: var(--neon-blue);
                box-shadow: 0 0 5px var(--neon-blue), inset 0 0 5px var(--neon-blue);
            }
            25% {
                border-color: var(--neon-pink);
                box-shadow: 0 0 15px var(--neon-pink), inset 0 0 15px var(--neon-pink);
            }
            50% {
                border-color: var(--neon-purple);
                box-shadow: 0 0 25px var(--neon-purple), inset 0 0 25px var(--neon-purple);
            }
            75% {
                border-color: var(--neon-green);
                box-shadow: 0 0 15px var(--neon-green), inset 0 0 15px var(--neon-green);
            }
            100% {
                border-color: var(--neon-orange);
                box-shadow: 0 0 5px var(--neon-orange), inset 0 0 5px var(--neon-orange);
            }
        }

        @keyframes electric-pulse {
            0%, 100% {
                opacity: 0.8;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="video-section">
            <div class="status-indicator">AI Online</div>
            <div class="language-indicator" id="languageIndicator">English</div>
            <div class="language-selector" style="position: absolute; top: 2rem; right: 2rem; z-index: 1000;">
                <select id="languageSelect" style="cursor: pointer; pointer-events: auto; background: rgba(0,0,0,0.7); color: white; border: 2px solid #00f5ff; border-radius: 10px; padding: 8px 12px; font-family: 'Orbitron', monospace; font-size: 14px;">
                    <option value="en" style="background: #000;">English</option>
                    <option value="es" style="background: #000;">Español</option>
                    <option value="fr" style="background: #000;">Français</option>
                    <option value="de" style="background: #000;">Deutsch</option>
                    <option value="it" style="background: #000;">Italiano</option>
                    <option value="pt" style="background: #000;">Português</option>
                    <option value="ru" style="background: #000;">Русский</option>
                    <option value="ja" style="background: #000;">日本語</option>
                    <option value="ko" style="background: #000;">한국어</option>
                    <option value="zh" style="background: #000;">中文</option>
                    <option value="ar" style="background: #000;">العربية</option>
                    <option value="hi" style="background: #000;">हिन्दी</option>
                </select>
            </div>
            <div class="ai-avatar">
                <div class="avatar-face">🤖</div>
            </div>
            <div class="controls">
                <button class="control-btn mute-btn" title="Mute/Unmute">🔊</button>
                <button class="control-btn video-btn" title="Video On/Off">📹</button>
                <button class="control-btn stop-btn" title="Stop Response">⏹️</button>
                <button class="control-btn end-call-btn" title="End Call">📞</button>
            </div>
        </div>
        <div class="chat-section">
            <div class="chat-header">
                <h2 class="chat-title">AI Video Chat - Enhanced</h2>
                <p class="chat-subtitle">Multi-Language Support & Advanced Features</p>
            </div>
            <div class="messages-container" id="messagesContainer">
                <div class="message ai">
                    Hello! I'm your AI assistant with complete multi-language support. I can speak and understand multiple languages. How can I help you today?
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
        // Enhanced loading system integration
        class EnhancedLoadingSystem {
            constructor() {
                this.loadingSteps = {
                    'en': [
                        'Initializing AI Assistant...',
                        'Loading neural networks...',
                        'Setting up video streams...',
                        'Preparing multi-language support...',
                        'Calibrating voice recognition...',
                        'Establishing secure connection...',
                        'Ready to chat!'
                    ],
                    'es': [
                        'Inicializando asistente IA...',
                        'Cargando redes neuronales...',
                        'Configurando transmisiones de video...',
                        'Preparando soporte multi-idioma...',
                        'Calibrando reconocimiento de voz...',
                        'Estableciendo conexión segura...',
                        '¡Listo para chatear!'
                    ],
                    'fr': [
                        'Initialisation de l\'assistant IA...',
                        'Chargement des réseaux neuronaux...',
                        'Configuration des flux vidéo...',
                        'Préparation du support multilingue...',
                        'Calibration de la reconnaissance vocale...',
                        'Établissement de la connexion sécurisée...',
                        'Prêt à discuter !'
                    ],
                    'de': [
                        'KI-Assistent wird initialisiert...',
                        'Neuronale Netzwerke werden geladen...',
                        'Video-Streams werden eingerichtet...',
                        'Mehrsprachige Unterstützung wird vorbereitet...',
                        'Spracherkennung wird kalibriert...',
                        'Sichere Verbindung wird hergestellt...',
                        'Bereit zum Chatten!'
                    ],
                    'ja': [
                        'AIアシスタントを初期化中...',
                        'ニューラルネットワークを読み込み中...',
                        'ビデオストリームを設定中...',
                        '多言語サポートを準備中...',
                        '音声認識を校正中...',
                        '安全な接続を確立中...',
                        'チャットの準備ができました！'
                    ],
                    'ko': [
                        'AI 어시스턴트 초기화 중...',
                        '신경망 로드 중...',
                        '비디오 스트림 설정 중...',
                        '다국어 지원 준비 중...',
                        '음성 인식 보정 중...',
                        '보안 연결 설정 중...',
                        '채팅 준비 완료!'
                    ],
                    'zh': [
                        '正在初始化AI助手...',
                        '正在加载神经网络...',
                        '正在设置视频流...',
                        '正在准备多语言支持...',
                        '正在校准语音识别...',
                        '正在建立安全连接...',
                        '准备聊天！'
                    ]
                };
                this.init();
            }

            init() {
                this.setupEnhancedLoading();
                this.setupLanguageSelector();
                this.setupLoadingAnimation();
                this.setupInteractiveEffects();
            }

            setupEnhancedLoading() {
                // Add enhanced loading overlay
                const loadingOverlay = document.createElement('div');
                loadingOverlay.id = 'enhanced-loading-overlay';
                loadingOverlay.innerHTML = `
                    <div class="enhanced-loading-container">
                        <div class="enhanced-logo">
                            <span class="logo-text">AI VIDEO CHAT</span>
                            <span class="logo-subtitle">Enhanced Multi-Language</span>
                        </div>
                        <div class="enhanced-status" id="loadingStatus">
                            <span class="status-text">Initializing AI Assistant</span>
                            <div class="enhanced-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="enhanced-spinner">
                            <div class="spinner-ring spinner-ring-1"></div>
                            <div class="spinner-ring spinner-ring-2"></div>
                            <div class="spinner-ring spinner-ring-3"></div>
                            <div class="spinner-ring spinner-ring-4"></div>
                        </div>
                        <div class="enhanced-progress-container">
                            <div class="progress-track">
                                <div class="progress-bar" id="loadingProgressBar"></div>
                                <div class="progress-glow"></div>
                            </div>
                            <div class="progress-text" id="loadingProgressText">0%</div>
                        </div>
                        <div class="language-indicator">
                            <span class="language-label">Language:</span>
                            <span class="language-value" id="loadingLanguageValue">English</span>
                        </div>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);

                // Add enhanced particles
                this.addEnhancedParticles();
            }

            addEnhancedParticles() {
                const particleContainer = document.createElement('div');
                particleContainer.className = 'enhanced-particles';
                
                for (let i = 0; i < 10; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'enhanced-particle';
                    particle.style.left = `${5 + (i * 9)}%`;
                    particle.style.animationDelay = `${i * 0.5}s`;
                    particleContainer.appendChild(particle);
                }
                
                document.body.appendChild(particleContainer);
            }

            setupLanguageSelector() {
                const languageSelect = document.getElementById('languageSelect');
                if (languageSelect) {
                    languageSelect.addEventListener('change', (e) => {
                        this.updateLanguageIndicator(e.target.value);
                        this.updateLoadingLanguage(e.target.value);
                    });
                }
            }

            setupLoadingAnimation() {
                const currentLanguage = new URLSearchParams(window.location.search).get('lang') || 'en';
                const loadingMessages = this.loadingSteps[currentLanguage] || this.loadingSteps['en'];
                
                let currentStep = 0;
                const totalSteps = loadingMessages.length;
                const statusElement = document.getElementById('loadingStatus');
                const progressBar = document.getElementById('loadingProgressBar');
                const progressText = document.getElementById('loadingProgressText');
                
                const stepInterval = setInterval(() => {
                    if (currentStep < totalSteps) {
                        if (statusElement) {
                            const statusText = statusElement.querySelector('.status-text');
                            if (statusText) {
                                statusText.textContent = loadingMessages[currentStep];
                            }
                        }
                        
                        if (progressBar && progressText) {
                            const progress = ((currentStep + 1) / totalSteps) * 100;
                            progressBar.style.width = `${progress}%`;
                            progressText.textContent = `${Math.round(progress)}%`;
                        }
                        
                        currentStep++;
                    } else {
                        clearInterval(stepInterval);
                        this.hideLoading();
                    }
                }, 1200);
            }

            setupInteractiveEffects() {
                // Add interactive hover effects
                document.addEventListener('mousemove', (e) => {
                    const particles = document.querySelectorAll('.enhanced-particle');
                    const mouseX = e.clientX / window.innerWidth;
                    const mouseY = e.clientY / window.innerHeight;
                    
                    particles.forEach((particle, index) => {
                        const speed = (index + 1) * 0.3;
                        const x = (mouseX - 0.5) * speed;
                        const y = (mouseY - 0.5) * speed;
                        particle.style.transform = `translate(${x}px, ${y}px)`;
                    });
                });
            }

            updateLanguageIndicator(language) {
                const indicator = document.getElementById('languageIndicator');
                if (indicator) {
                    const languageNames = {
                        'en': 'English',
                        'es': 'Español',
                        'fr': 'Français',
                        'de': 'Deutsch',
                        'it': 'Italiano',
                        'pt': 'Português',
                        'ru': 'Русский',
                        'ja': '日本語',
                        'ko': '한국어',
                        'zh': '中文',
                        'ar': 'العربية',
                        'hi': 'हिन्दी'
                    };
                    indicator.textContent = languageNames[language] || 'English';
                }
            }

            updateLoadingLanguage(language) {
                const loadingLanguageValue = document.getElementById('loadingLanguageValue');
                if (loadingLanguageValue) {
                    const languageNames = {
                        'en': 'English',
                        'es': 'Español',
                        'fr': 'Français',
                        'de': 'Deutsch',
                        'ja': '日本語',
                        'ko': '한국어',
                        'zh': '中文'
                    };
                    loadingLanguageValue.textContent = languageNames[language] || 'English';
                }
            }

            hideLoading() {
                const loadingOverlay = document.getElementById('enhanced-loading-overlay');
                if (loadingOverlay) {
                    loadingOverlay.classList.add('fade-out');
                    setTimeout(() => {
                        loadingOverlay.style.display = 'none';
                    }, 800);
                }
            }
        }

        // Initialize enhanced loading system
        const enhancedLoading = new EnhancedLoadingSystem();
        
        // Update language indicator
        function updateLanguageIndicator(language) {
            enhancedLoading.updateLanguageIndicator(language);
        }

        // Listen for language changes
        document.getElementById('languageSelect').addEventListener('change', function(e) {
            updateLanguageIndicator(e.target.value);
        });
    </script>
</body>
</html>
