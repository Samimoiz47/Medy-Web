<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medy Apps - Neon Lightning Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Exo 2', sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated Background */
        .cyber-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(ellipse at top, #1a1a2e 0%, #0a0a0a 50%),
                radial-gradient(ellipse at bottom, #16213e 0%, #0a0a0a 50%);
            z-index: -2;
        }

        /* Lightning Particles */
        .lightning-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .lightning-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #00d4ff;
            border-radius: 50%;
            animation: lightning-float 8s infinite linear;
            box-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
        }

        @keyframes lightning-float {
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

        /* Neon Border Effects */
        .neon-border {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(45deg, rgba(10, 10, 10, 0.9), rgba(10, 10, 10, 0.9)) padding-box,
                        linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88, #00d4ff) border-box;
            background-size: 400% 400%;
            animation: neon-glow 3s ease-in-out infinite;
            border-radius: 20px;
        }

        @keyframes neon-glow {
            0%, 100% {
                background-position: 0% 50%;
                box-shadow: 
                    0 0 20px rgba(0, 212, 255, 0.5),
                    inset 0 0 20px rgba(0, 212, 255, 0.1);
            }
            50% {
                background-position: 100% 50%;
                box-shadow: 
                    0 0 40px rgba(255, 0, 255, 0.8),
                    inset 0 0 40px rgba(255, 0, 255, 0.2);
            }
        }

        /* Header */
        .cyber-header {
            text-align: center;
            padding: 3rem 1rem;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3);
        }

        .cyber-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            background: linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: title-pulse 2s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            margin-bottom: 0.5rem;
        }

        @keyframes title-pulse {
            0%, 100% {
                filter: brightness(1);
            }
            50% {
                filter: brightness(1.3);
            }
        }

        .cyber-subtitle {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Feature Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-card {
            background: rgba(10, 10, 10, 0.8);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 212, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 212, 255, 0.3);
            border-color: #00d4ff;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
            animation: icon-float 3s ease-in-out infinite;
        }

        @keyframes icon-float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .feature-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.3rem;
            font-weight: 700;
            color: #00d4ff;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .feature-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        /* Button Container */
        .button-container {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            margin: 3rem 0;
            flex-wrap: wrap;
        }

        .cyber-button {
            padding: 1.2rem 2.5rem;
            font-size: 1.1rem;
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            border: 2px solid transparent;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .love-btn {
            background: linear-gradient(45deg, #ff00ff, #ff1493);
            color: white;
            box-shadow: 0 5px 20px rgba(255, 0, 255, 0.4);
        }

        .love-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(255, 0, 255, 0.6);
            background: linear-gradient(45deg, #ff1493, #ff00ff);
        }

        .game-btn {
            background: linear-gradient(45deg, #00d4ff, #0099cc);
            color: white;
            box-shadow: 0 5px 20px rgba(0, 212, 255, 0.4);
        }

        .game-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.6);
            background: linear-gradient(45deg, #0099cc, #00d4ff);
        }

        .app-btn {
            background: linear-gradient(45deg, #00ff88, #32cd32);
            color: white;
            box-shadow: 0 5px 20px rgba(0, 255, 136, 0.4);
        }

        .app-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 255, 136, 0.6);
            background: linear-gradient(45deg, #32cd32, #00ff88);
        }

        .ai-btn {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            color: white;
            box-shadow: 0 5px 20px rgba(255, 107, 107, 0.4);
        }

        .ai-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.6);
            background: linear-gradient(45deg, #ff4757, #ff6b6b);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .cyber-title {
                font-size: 2.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .button-container {
                flex-direction: column;
                gap: 1rem;
            }

            .cyber-button {
                width: 100%;
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            .cyber-header {
                padding: 2rem 1rem;
            }

            .cyber-title {
                font-size: 2rem;
            }

            .cyber-subtitle {
                font-size: 1.2rem;
            }

            .feature-card {
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
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
            width: 60px;
            height: 60px;
            border: 3px solid rgba(0, 212, 255, 0.3);
            border-top: 3px solid #00d4ff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Floating Particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 1px;
            height: 1px;
            background: rgba(0, 212, 255, 0.5);
            border-radius: 50%;
            animation: float-particle 15s infinite linear;
        }

        @keyframes float-particle {
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
                transform: translateY(-100vh) translateX(50px);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Background Effects -->
    <div class="cyber-bg"></div>
    <div class="lightning-container">
        <div class="lightning-particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="lightning-particle" style="left: 20%; animation-delay: 1s;"></div>
        <div class="lightning-particle" style="left: 30%; animation-delay: 2s;"></div>
        <div class="lightning-particle" style="left: 40%; animation-delay: 3s;"></div>
        <div class="lightning-particle" style="left: 50%; animation-delay: 4s;"></div>
        <div class="lightning-particle" style="left: 60%; animation-delay: 5s;"></div>
        <div class="lightning-particle" style="left: 70%; animation-delay: 6s;"></div>
        <div class="lightning-particle" style="left: 80%; animation-delay: 7s;"></div>
        <div class="lightning-particle" style="left: 90%; animation-delay: 8s;"></div>
    </div>
    <div class="floating-particles"></div>

    <!-- Header -->
    <header class="cyber-header">
        <h1 class="cyber-title">MEDY APPS</h1>
        <p class="cyber-subtitle">Neon Lightning Experience</p>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Features Grid -->
        <div class="features-grid">
            <div class="feature-card neon-border">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Modern Apps</h3>
                <p class="feature-description">Discover cutting-edge applications with stunning interfaces and powerful functionality</p>
            </div>

            <div class="feature-card neon-border">
                <div class="feature-icon">💡</div>
                <h3 class="feature-title">Smart Tools</h3>
                <p class="feature-description">Intelligent solutions powered by AI to enhance your digital lifestyle</p>
            </div>

            <div class="feature-card neon-border">
                <div class="feature-icon">🚀</div>
                <h3 class="feature-title">Lightning Fast</h3>
                <p class="feature-description">Optimized performance with lightning-fast response times and smooth animations</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="button-container">
            <a href="{{ route('love-calculator') }}" class="cyber-button love-btn">
                💕 Love Calculator
            </a>
            <a href="{{ route('game-store-hyper') }}" class="cyber-button game-btn">
                🎮 Game Store
            </a>
<a href="{{ route('apps-store-neon') }}" class="cyber-button app-btn">
                📱 App Store
            </a>
            <a href="{{ route('ai-video-chat-neon') }}" class="cyber-button ai-btn">
                🤖 AI Video Chat
            </a>
        </div>
    </div>

    <script>
        // Hide loading overlay
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loadingOverlay').style.opacity = '0';
                setTimeout(() => {
                    document.getElementById('loadingOverlay').style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Add floating particles
        function addFloatingParticles() {
            const container = document.querySelector('.floating-particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                container.appendChild(particle);
            }
        }

        // Add more lightning particles
        function addLightningParticles() {
            const container = document.querySelector('.lightning-container');
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'lightning-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                container.appendChild(particle);
            }
        }

        addFloatingParticles();
        addLightningParticles();

        // Button hover effects
        document.querySelectorAll('.cyber-button').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.05)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
