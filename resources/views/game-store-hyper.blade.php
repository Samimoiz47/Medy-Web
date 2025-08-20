<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyper-Realistic Game Store</title>
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
            background: linear-gradient(45deg, #0a0a0a, #0a0a0a) padding-box,
                        linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88, #00d4ff) border-box;
            background-size: 400% 400%;
            animation: neon-glow 3s ease-in-out infinite;
            border-radius: 15px;
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
            padding: 2rem 1rem;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3);
        }

        .cyber-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
            background: linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: title-pulse 2s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        @keyframes title-pulse {
            0%, 100% {
                filter: brightness(1);
            }
            50% {
                filter: brightness(1.3);
            }
        }

        /* Game Grid */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .game-card {
            position: relative;
            background: rgba(10, 10, 10, 0.9);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            cursor: pointer;
            min-height: 400px;
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(0, 212, 255, 0.1), transparent);
            z-index: 1;
            transition: all 0.4s ease;
        }

        .game-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(0, 212, 255, 0.4),
                0 0 60px rgba(255, 0, 255, 0.2);
        }

        .game-card:hover::before {
            background: linear-gradient(45deg, transparent, rgba(0, 212, 255, 0.3), transparent);
        }

        .game-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            position: relative;
            overflow: hidden;
            border-radius: 15px 15px 0 0;
        }

        .game-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .game-card:hover .game-image img {
            transform: scale(1.1);
        }

        .game-content {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .game-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            color: #00d4ff;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .game-description {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .game-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #00ff88;
            text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
        }

        .download-btn {
            width: 100%;
            padding: 1rem;
            margin-top: 1rem;
            background: linear-gradient(45deg, #00d4ff, #ff00ff);
            border: none;
            border-radius: 10px;
            color: white;
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 212, 255, 0.4);
            background: linear-gradient(45deg, #ff00ff, #00d4ff);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .game-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1.5rem;
            }

            .cyber-title {
                font-size: 2.5rem;
            }

            .game-card {
                min-height: 350px;
            }
        }

        @media (max-width: 480px) {
            .cyber-header {
                padding: 1rem;
            }

            .cyber-title {
                font-size: 2rem;
            }

            .game-grid {
                padding: 0.5rem;
                gap: 1rem;
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

        /* Floating Navigation */
        .floating-nav {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 1rem;
            flex-direction: column;
        }

        .nav-btn {
            padding: 0.75rem 1.5rem;
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #00d4ff;
            border-radius: 25px;
            color: #00d4ff;
            text-decoration: none;
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-btn:hover {
            background: rgba(0, 212, 255, 0.2);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            transform: translateY(-2px);
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

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-btn">🏠 Home</a>
        <a href="{{ route('love-calculator') }}" class="nav-btn">💕 Love</a>
    </div>

    <!-- Header -->
    <header class="cyber-header neon-border">
        <h1 class="cyber-title">HYPER GAME STORE</h1>
        <p style="color: rgba(255,255,255,0.8); margin-top: 0.5rem;">Experience the Future of Gaming</p>
    </header>

    <!-- Game Grid -->
    <div class="game-grid">
        <!-- Game Card 1 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Cyber Nexus Arena" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Cyber Nexus Arena</h3>
                <p class="game-description">Battle through neon-lit cyberpunk arenas in this intense multiplayer experience. Features advanced AI opponents and stunning visual effects.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem;">FREE</div>
                <button class="download-btn" onclick="downloadGame('cyber-nexus')">Download Now</button>
            </div>
        </div>

        <!-- Game Card 2 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Quantum Drift Racing" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Quantum Drift Racing</h3>
                <p class="game-description">Race through quantum tunnels at light speed. Master the art of dimensional drifting in this revolutionary racing game.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem;">FREE</div>
                <button class="download-btn" onclick="downloadGame('quantum-drift')">Download Now</button>
            </div>
        </div>

        <!-- Game Card 3 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Neural Assault" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Neural Assault</h3>
                <p class="game-description">Hack into enemy neural networks in this mind-bending strategy game. Control digital battlefields with your thoughts.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem; font-weight: bold;">FREE</div>
                <button class="download-btn" onclick="downloadGame('neural-assault')">Download Now</button>
            </div>
        </div>

        <!-- Game Card 4 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1563207153-f403bf289096?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Plasma Storm Warriors" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Plasma Storm Warriors</h3>
                <p class="game-description">Command plasma-powered mechs in epic battles. Customize your war machine with cutting-edge weaponry.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem; font-weight: bold;">FREE</div>
                <button class="download-btn" onclick="downloadGame('plasma-storm')">Download Now</button>
            </div>
        </div>

        <!-- Game Card 5 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1529699211952-734e80c4d42b?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Holographic Chess VR" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Holographic Chess VR</h3>
                <p class="game-description">Experience chess like never before in immersive 3D holographic environments. Challenge AI or friends worldwide.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem; font-weight: bold;">FREE</div>
                <button class="download-btn" onclick="downloadGame('holo-chess')">Download Now</button>
            </div>
        </div>

        <!-- Game Card 6 -->
        <div class="game-card neon-border">
            <div class="game-image">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=3840&h=2160&fit=crop&crop=center&q=90" alt="Neon Samurai Legends" loading="lazy">
            </div>
            <div class="game-content">
                <h3 class="game-title">Neon Samurai Legends</h3>
                <p class="game-description">Master the ancient art of cyber-samurai combat. Slice through digital enemies with precision and style.</p>
                <div class="game-price" style="color: #00ff88; font-size: 1.5rem; font-weight: bold;">FREE</div>
                <button class="download-btn" onclick="downloadGame('neon-samurai')">Download Now</button>
            </div>
        </div>
    </div>

    <script>
        // Enhanced loading system with resource preloading
        class LoadingManager {
            constructor() {
                this.loadingOverlay = document.getElementById('loadingOverlay');
                this.images = [];
                this.loadedCount = 0;
                this.totalCount = 0;
            }

            async init() {
                // Collect all images to preload
                this.collectImages();
                
                // Start preloading
                await this.preloadResources();
                
                // Hide loading overlay
                this.hideLoading();
            }

            collectImages() {
                const images = document.querySelectorAll('img[data-src], img[loading="lazy"]');
                this.images = Array.from(images);
                this.totalCount = this.images.length;
            }

            preloadResources() {
                return new Promise((resolve) => {
                    if (this.totalCount === 0) {
                        resolve();
                        return;
                    }

                    // Update loading text
                    this.updateLoadingText(`Loading ${this.loadedCount}/${this.totalCount} images...`);

                    this.images.forEach((img, index) => {
                        const image = new Image();
                        
                        // Handle both data-src and regular src
                        const src = img.dataset.src || img.src;
                        
                        image.onload = () => {
                            this.loadedCount++;
                            this.updateLoadingText(`Loading ${this.loadedCount}/${this.totalCount} images...`);
                            
                            // Replace placeholder with actual image
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                            }
                            
                            if (this.loadedCount === this.totalCount) {
                                resolve();
                            }
                        };
                        
                        image.onerror = () => {
                            this.loadedCount++;
                            console.warn(`Failed to load image: ${src}`);
                            
                            if (this.loadedCount === this.totalCount) {
                                resolve();
                            }
                        };
                        
                        image.src = src;
                    });

                    // Fallback timeout
                    setTimeout(() => {
                        if (this.loadedCount < this.totalCount) {
                            console.warn('Some images failed to load, continuing...');
                            resolve();
                        }
                    }, 5000);
                });
            }

            updateLoadingText(text) {
                const loadingText = document.querySelector('.loading-text');
                if (loadingText) {
                    loadingText.textContent = text;
                }
            }

            hideLoading() {
                this.loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    this.loadingOverlay.style.display = 'none';
                }, 500);
            }
        }

        // Initialize enhanced loading
        const loadingManager = new LoadingManager();
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => loadingManager.init());
        } else {
            loadingManager.init();
        }

        // Enhanced download game function with better UX
        function downloadGame(gameId) {
            const btn = event.target;
            const originalText = btn.textContent;
            const originalBg = btn.style.background;
            
            btn.innerHTML = '<span class="spinner"></span> Downloading...';
            btn.style.background = 'linear-gradient(45deg, #00ff88, #00d4ff)';
            btn.disabled = true;
            
            // Simulate download process
            setTimeout(() => {
                btn.innerHTML = '✓ Downloaded!';
                btn.style.background = 'linear-gradient(45deg, #00ff88, #00d4ff)';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = originalBg;
                    btn.disabled = false;
                }, 2000);
            }, 2000);
        }

        // Add CSS for enhanced loading spinner
        const style = document.createElement('style');
        style.textContent = `
            .loading-text {
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }
            .loading-progress {
                width: 200px;
                height: 4px;
                background: rgba(0, 212, 255, 0.3);
                border-radius: 2px;
                overflow: hidden;
                margin: 0 auto;
            }
            .loading-progress-bar {
                height: 100%;
                background: #00d4ff;
                transition: width 0.3s ease;
            }
            .spinner {
                display: inline-block;
                width: 12px;
                height: 12px;
                border: 2px solid rgba(255,255,255,0.3);
                border-radius: 50%;
                border-top-color: #fff;
                animation: spin 1s ease-in-out infinite;
                margin-right: 8px;
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);

        // Enhanced lightning particles
        function addLightningParticles() {
            const container = document.querySelector('.lightning-container');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'lightning-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                particle.style.opacity = Math.random() * 0.5 + 0.5;
                container.appendChild(particle);
            }
        }

        addLightningParticles();
    </script>
</body>
</html>
