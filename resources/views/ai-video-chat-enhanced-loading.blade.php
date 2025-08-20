<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loading AI Video Chat - Enhanced...</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ai-video-chat-enhanced-loading.css') }}">
</head>
<body>
    <div class="ai-video-chat-enhanced-loader" id="ai-chat-enhanced-loader">
        <!-- Enhanced Particle System -->
        <div class="ai-enhanced-particles">
            <div class="ai-particle" style="left: 5%; animation-delay: 0s;"></div>
            <div class="ai-particle" style="left: 15%; animation-delay: 0.5s;"></div>
            <div class="ai-particle" style="left: 25%; animation-delay: 1s;"></div>
            <div class="ai-particle" style="left: 35%; animation-delay: 1.5s;"></div>
            <div class="ai-particle" style="left: 45%; animation-delay: 2s;"></div>
            <div class="ai-particle" style="left: 55%; animation-delay: 2.5s;"></div>
            <div class="ai-particle" style="left: 65%; animation-delay: 3s;"></div>
            <div class="ai-particle" style="left: 75%; animation-delay: 3.5s;"></div>
            <div class="ai-particle" style="left: 85%; animation-delay: 4s;"></div>
            <div class="ai-particle" style="left: 95%; animation-delay: 4.5s;"></div>
        </div>

        <!-- Lightning Effects -->
        <div class="ai-lightning-container">
            <div class="ai-lightning-bolt"></div>
            <div class="ai-lightning-bolt" style="animation-delay: 1s;"></div>
            <div class="ai-lightning-bolt" style="animation-delay: 2s;"></div>
        </div>

        <!-- Enhanced Loading Container -->
        <div class="ai-enhanced-loading-container">
            <div class="ai-enhanced-logo">
                <span class="ai-logo-text">AI VIDEO CHAT</span>
                <span class="ai-logo-subtitle">Enhanced Multi-Language</span>
            </div>
            
            <div class="ai-enhanced-status" id="aiStatus">
                <span class="ai-status-text">Initializing AI Assistant</span>
                <div class="ai-enhanced-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <!-- 3D Multi-Ring Spinner -->
            <div class="ai-enhanced-spinner">
                <div class="ai-ring ai-ring-1"></div>
                <div class="ai-ring ai-ring-2"></div>
                <div class="ai-ring ai-ring-3"></div>
                <div class="ai-ring ai-ring-4"></div>
            </div>
            
            <!-- Enhanced Progress Bar -->
            <div class="ai-enhanced-progress-container">
                <div class="ai-progress-track">
                    <div class="ai-progress-bar" id="aiProgressBar"></div>
                    <div class="ai-progress-glow"></div>
                </div>
                <div class="ai-progress-text" id="aiProgressText">0%</div>
            </div>

            <!-- Language Indicator -->
            <div class="ai-language-indicator">
                <span class="ai-language-label">Language:</span>
                <span class="ai-language-value" id="aiLanguageValue">English</span>
            </div>
        </div>

        <!-- Neural Network Visualization -->
        <div class="ai-neural-network">
            <div class="ai-neural-node" style="top: 20%; left: 20%;"></div>
            <div class="ai-neural-node" style="top: 20%; left: 80%;"></div>
            <div class="ai-neural-node" style="top: 80%; left: 20%;"></div>
            <div class="ai-neural-node" style="top: 80%; left: 80%;"></div>
            <div class="ai-neural-node" style="top: 50%; left: 50%;"></div>
            <svg class="ai-neural-connections">
                <line x1="20%" y1="20%" x2="50%" y2="50%" stroke="rgba(0, 243, 255, 0.3)" stroke-width="1"/>
                <line x1="80%" y1="20%" x2="50%" y2="50%" stroke="rgba(255, 0, 229, 0.3)" stroke-width="1"/>
                <line x1="20%" y1="80%" x2="50%" y2="50%" stroke="rgba(157, 0, 255, 0.3)" stroke-width="1"/>
                <line x1="80%" y1="80%" x2="50%" y2="50%" stroke="rgba(0, 243, 255, 0.3)" stroke-width="1"/>
            </svg>
        </div>
    </div>

    <script>
        // Enhanced AI initialization with multi-language support
        const aiLoadingSteps = {
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

        // Get current language from URL or default to English
        const currentLanguage = new URLSearchParams(window.location.search).get('lang') || 'en';
        const loadingMessages = aiLoadingSteps[currentLanguage] || aiLoadingSteps['en'];
        
        let currentStep = 0;
        const statusElement = document.getElementById('aiStatus');
        const progressBar = document.getElementById('aiProgressBar');
        const progressText = document.getElementById('aiProgressText');
        const languageValue = document.getElementById('aiLanguageValue');
        
        // Update language indicator
        const languageNames = {
            'en': 'English',
            'es': 'Español',
            'fr': 'Français',
            'de': 'Deutsch',
            'ja': '日本語',
            'ko': '한국어',
            'zh': '中文'
        };
        languageValue.textContent = languageNames[currentLanguage] || 'English';
        
        // Enhanced loading sequence
        const totalSteps = loadingMessages.length;
        const stepInterval = setInterval(() => {
            if (currentStep < totalSteps) {
                // Update status text
                const statusText = statusElement.querySelector('.ai-status-text');
                statusText.textContent = loadingMessages[currentStep];
                
                // Update progress
                const progress = ((currentStep + 1) / totalSteps) * 100;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${Math.round(progress)}%`;
                
                // Add pulse effect on step change
                statusElement.classList.add('ai-step-change');
                setTimeout(() => statusElement.classList.remove('ai-step-change'), 500);
                
                currentStep++;
            } else {
                clearInterval(stepInterval);
                
                // Fade out and redirect to main chat
                setTimeout(() => {
                    const loader = document.getElementById('ai-chat-enhanced-loader');
                    loader.classList.add('ai-fade-out');
                    
                    setTimeout(() => {
                        window.location.href = `/ai-video-chat-enhanced?lang=${currentLanguage}`;
                    }, 1000);
                }, 1000);
            }
        }, 1200);
        
        // Add interactive hover effects
        document.addEventListener('mousemove', (e) => {
            const particles = document.querySelectorAll('.ai-particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>
