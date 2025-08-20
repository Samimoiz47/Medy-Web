<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Lightning Apps Store - Free Apps</title>
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

        /* Header */
        .cyber-header {
            text-align: center;
            padding: 3rem 1rem;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3);
            position: relative;
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

        /* Navigation */
        .nav-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .nav-btn {
            padding: 0.8rem 1.5rem;
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid #00d4ff;
            border-radius: 25px;
            color: #00d4ff;
            text-decoration: none;
            font-family: 'Orbitron', monospace;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .nav-btn:hover, .nav-btn.active {
            background: #00d4ff;
            color: #0a0a0a;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
        }

        /* App Grid */
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .app-card {
            position: relative;
            background: rgba(10, 10, 10, 0.9);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            cursor: pointer;
            min-height: 450px;
            border: 1px solid rgba(0, 212, 255, 0.2);
        }

        .app-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(0, 212, 255, 0.4),
                0 0 60px rgba(255, 0, 255, 0.2);
            border-color: #00d4ff;
        }

        .app-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            position: relative;
            overflow: hidden;
            border-radius: 15px 15px 0 0;
        }

        .app-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .app-card:hover .app-image img {
            transform: scale(1.1);
        }

        .app-content {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .app-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.3rem;
            font-weight: 700;
            color: #00d4ff;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }

        .app-description {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .app-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.8rem;
        }

        .app-rating {
            color: #00ff88;
            font-weight: 600;
        }

        .app-size {
            color: rgba(255, 255, 255, 0.6);
        }

        .app-category {
            color: #ff00ff;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .download-btn {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(45deg, #00ff88, #32cd32);
            border: none;
            border-radius: 10px;
            color: white;
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 255, 136, 0.4);
        }

        .free-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #00ff88, #32cd32);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border-top: 1px solid rgba(0, 212, 255, 0.3);
            margin-top: 3rem;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .app-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1.5rem;
            }

            .cyber-title {
                font-size: 2.5rem;
            }

            .nav-container {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .cyber-header {
                padding: 2rem 1rem;
            }

            .cyber-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
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

    <!-- Header -->
    <header class="cyber-header">
        <h1 class="cyber-title">NEON LIGHTNING</h1>
        <p class="cyber-subtitle">Free Apps Store</p>
        
        <!-- Navigation -->
        <div class="nav-container">
            <a href="{{ route('welcome') }}" class="nav-btn">Home</a>
            <a href="{{ route('game-store-hyper') }}" class="nav-btn">Games</a>
            <a href="#" class="nav-btn active">Apps</a>
            <a href="{{ route('love-calculator') }}" class="nav-btn">Love</a>
        </div>
    </header>

    <!-- App Grid -->
    <div class="app-grid">
        <!-- Productivity Apps -->
        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=3840&h=2160&fit=crop&crop=center&q=90" alt="TaskMaster Pro" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">TaskMaster Pro</h3>
                <p class="app-description">Advanced task management with AI-powered scheduling and productivity insights</p>
                <div class="app-meta">
                    <span class="app-category">Productivity</span>
                    <span class="app-rating">⭐ 4.8</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">15 MB</span>
                    <span class="app-size">1M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=3840&h=2160&fit=crop&crop=center&q=90" alt="NoteFlow AI" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">NoteFlow AI</h3>
                <p class="app-description">Smart note-taking with voice recognition and AI summarization features</p>
                <div class="app-meta">
                    <span class="app-category">Productivity</span>
                    <span class="app-rating">⭐ 4.6</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">8 MB</span>
                    <span class="app-size">500K+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <!-- Health & Fitness Apps -->
        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=3840&h=2160&fit=crop&crop=center&q=90" alt="FitPulse AI" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">FitPulse AI</h3>
                <p class="app-description">Personal fitness coach with AI workout plans and real-time form correction</p>
                <div class="app-meta">
                    <span class="app-category">Health</span>
                    <span class="app-rating">⭐ 4.9</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">25 MB</span>
                    <span class="app-size">2M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=3840&h=2160&fit=crop&crop=center&q=90" alt="MindZen" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">MindZen</h3>
                <p class="app-description">Guided meditation and mindfulness app with personalized sessions</p>
                <div class="app-meta">
                    <span class="app-category">Health</span>
                    <span class="app-rating">⭐ 4.7</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">12 MB</span>
                    <span class="app-size">800K+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <!-- Photo & Video Apps -->
        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?w=400&h=200&fit=crop&crop=center" alt="PhotoNeon AI" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">PhotoNeon AI</h3>
                <p class="app-description">AI-powered photo editor with neon effects and professional filters</p>
                <div class="app-meta">
                    <span class="app-category">Photo</span>
                    <span class="app-rating">⭐ 4.5</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">35 MB</span>
                    <span class="app-size">3M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?w=400&h=200&fit=crop&crop=center" alt="VideoCraft AI" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">VideoCraft AI</h3>
                <p class="app-description">Professional video editor with AI effects and social media templates</p>
                <div class="app-meta">
                    <span class="app-category">Video</span>
                    <span class="app-rating">⭐ 4.6</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">45 MB</span>
                    <span class="app-size">1.5M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <!-- Social & Communication Apps -->
        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1614680376739-414d95ff43df?w=400&h=200&fit=crop&crop=center" alt="ChatSphere" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">ChatSphere</h3>
                <p class="app-description">Secure messaging with end-to-end encryption and AI chatbots</p>
                <div class="app-meta">
                    <span class="app-category">Social</span>
                    <span class="app-rating">⭐ 4.4</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">20 MB</span>
                    <span class="app-size">2.5M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>

        <div class="app-card">
            <div class="free-badge">FREE</div>
            <div class="app-image">
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400&h=200&fit=crop&crop=center" alt="SoundWave" loading="lazy">
            </div>
            <div class="app-content">
                <h3 class="app-title">SoundWave</h3>
                <p class="app-description">AI music player with personalized playlists and high-quality streaming</p>
                <div class="app-meta">
                    <span class="app-category">Music</span>
                    <span class="app-rating">⭐ 4.8</span>
                </div>
                <div class="app-meta">
                    <span class="app-size">18 MB</span>
                    <span class="app-size">4M+ Downloads</span>
                </div>
                <button class="download-btn">Download Now</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p class="footer-text">© 2024 Neon Lightning Apps Store - All apps are completely FREE to download and use</p>
    </footer>

    <!-- HD Icon Loader -->
    <script src="{{ asset('js/hd-icon-loader.js') }}"></script>
    <script>
        // Enhanced loading system for app store
        class AppStoreLoadingManager {
            constructor() {
                this.loadingOverlay = null;
                this.images = [];
                this.loadedCount = 0;
                this.totalCount = 0;
                this.createLoadingOverlay();
            }

            createLoadingOverlay() {
                // Create loading overlay if it doesn't exist
                if (!document.getElementById('loadingOverlay')) {
                    const overlay = document.createElement('div');
                    overlay.id = 'loadingOverlay';
                    overlay.className = 'loading-overlay';
                    overlay.innerHTML = `
                        <div class="loading-content">
                            <div class="loading-spinner"></div>
                            <div class="loading-text">Loading Apps Store...</div>
                            <div class="loading-progress">
                                <div class="loading-progress-bar"></div>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(overlay);
                }
                this.loadingOverlay = document.getElementById('loadingOverlay');
            }

            async init() {
                // Collect all images to preload
                this.collectImages();
                
                // Start preloading
                await this.preloadResources();
                
                // Initialize HD icon loading
                this.initHDIconLoading();
                
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

                    this.updateLoadingText(`Loading ${this.loadedCount}/${this.totalCount} images...`);

                    this.images.forEach((img, index) => {
                        const image = new Image();
                        
                        const src = img.dataset.src || img.src;
                        
                        image.onload = () => {
                            this.loadedCount++;
                            this.updateProgress();
                            
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
                    }, 6000);
                });
            }

            updateProgress() {
                const progressBar = document.querySelector('.loading-progress-bar');
                const progressText = document.querySelector('.loading-text');
                
                if (progressBar) {
                    const percentage = (this.loadedCount / this.totalCount) * 100;
                    progressBar.style.width = `${percentage}%`;
                }
                
                if (progressText) {
                    progressText.textContent = `Loading ${this.loadedCount}/${this.totalCount} apps...`;
                }
            }

            updateLoadingText(text) {
                const loadingText = document.querySelector('.loading-text');
                if (loadingText) {
                    loadingText.textContent = text;
                }
            }

            initHDIconLoading() {
                const appCards = document.querySelectorAll('.app-card');
                
                appCards.forEach((card, index) => {
                    const iconElement = card.querySelector('.app-image');
                    const appTitle = card.querySelector('.app-title')?.textContent || 'App';
                    const appCategory = card.querySelector('.app-category')?.textContent || 'utility';
                    
                    if (iconElement) {
                        iconElement.dataset.appName = appTitle;
                        iconElement.dataset.appCategory = appCategory;
                        iconElement.dataset.iconIndex = index;
                        iconElement.classList.add('hd-enabled');
                        
                        setTimeout(() => {
                            if (window.HDIconLoader) {
                                window.HDIconLoader.loadHDIcon(iconElement, appTitle, appCategory);
                            }
                        }, 100 * index);
                    }
                });
            }

            hideLoading() {
                if (this.loadingOverlay) {
                    this.loadingOverlay.style.opacity = '0';
                    setTimeout(() => {
                        this.loadingOverlay.style.display = 'none';
                    }, 500);
                }
            }
        }

        // Enhanced interactive effects
        function initInteractiveEffects() {
            // Card hover effects
            document.querySelectorAll('.app-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Download button effects
            document.querySelectorAll('.download-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const originalText = this.textContent;
                    const originalBg = this.style.background;
                    
                    this.innerHTML = '<span class="spinner"></span> Downloading...';
                    this.style.background = 'linear-gradient(45deg, #00ff88, #32cd32)';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.innerHTML = '✓ Downloaded!';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.background = originalBg;
                            this.disabled = false;
                        }, 2000);
                    }, 2000);
                });
            });
        }

        // Enhanced lightning particles
        function addLightningParticles() {
            const container = document.querySelector('.lightning-container');
            const particleCount = 40;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'lightning-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                particle.style.opacity = Math.random() * 0.5 + 0.5;
                container.appendChild(particle);
            }
        }

        // Add enhanced loading styles
        const style = document.createElement('style');
        style.textContent = `
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
            .loading-content {
                text-align: center;
                color: #00d4ff;
            }
            .loading-text {
                font-size: 1.2rem;
                margin-bottom: 1rem;
                font-family: 'Orbitron', monospace;
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
                box-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
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

        // Initialize everything
        const appStoreLoadingManager = new AppStoreLoadingManager();
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                appStoreLoadingManager.init();
                initInteractiveEffects();
            });
        } else {
            appStoreLoadingManager.init();
            initInteractiveEffects();
        }

        addLightningParticles();
    </script>
</body>
</html>
