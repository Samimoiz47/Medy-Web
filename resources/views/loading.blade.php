<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medy Apps - Loading...</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading-container {
            text-align: center;
            position: relative;
        }

        .logo-container {
            position: relative;
            margin-bottom: 3rem;
        }

        .medy-logo {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: logo-glow 2s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        @keyframes logo-glow {
            0%, 100% {
                filter: brightness(1) drop-shadow(0 0 20px rgba(0, 212, 255, 0.5));
            }
            50% {
                filter: brightness(1.5) drop-shadow(0 0 40px rgba(255, 0, 255, 0.8));
            }
        }

        .loading-spinner {
            width: 80px;
            height: 80px;
            margin: 2rem auto;
            position: relative;
        }

        .spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 4px solid transparent;
            border-radius: 50%;
            border-top-color: #00d4ff;
            border-right-color: #ff00ff;
            animation: spin 1.5s linear infinite;
        }

        .spinner-ring:nth-child(2) {
            width: 70%;
            height: 70%;
            top: 15%;
            left: 15%;
            border-top-color: #00ff88;
            border-right-color: #00d4ff;
            animation: spin 1.2s linear infinite reverse;
        }

        .spinner-ring:nth-child(3) {
            width: 40%;
            height: 40%;
            top: 30%;
            left: 30%;
            border-top-color: #ff00ff;
            border-right-color: #00ff88;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
            animation: pulse-text 1.5s ease-in-out infinite;
        }

        @keyframes pulse-text {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .loading-dots {
            display: inline-block;
        }

        .loading-dots::after {
            content: '';
            animation: dots 1.5s steps(4, end) infinite;
        }

        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }

        .progress-bar {
            width: 300px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin: 2rem auto;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #00d4ff, #ff00ff, #00ff88);
            background-size: 200% 100%;
            animation: progress-fill 3s ease-in-out forwards;
            border-radius: 2px;
        }

        @keyframes progress-fill {
            0% {
                width: 0%;
                background-position: 0% 50%;
            }
            100% {
                width: 100%;
                background-position: 100% 50%;
            }
        }

        .particles-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #00d4ff;
            border-radius: 50%;
            animation: float-particle 8s infinite linear;
            box-shadow: 0 0 10px #00d4ff;
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
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        .version-info {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
            animation: fade-in 2s ease-in-out;
        }

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="particles-container">
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

    <div class="loading-container">
        <div class="logo-container">
            <div class="medy-logo">MEDY APPS</div>
        </div>
        
        <div class="loading-text">
            Loading your experience<span class="loading-dots"></span>
        </div>
        
        <div class="loading-spinner">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
        </div>
        
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <div class="version-info">v2.0.0 - Neon Lightning Edition</div>
    </div>

    <script>
        // Redirect to welcome page after loading
        window.addEventListener('load', function() {
            // Simulate loading process
            setTimeout(() => {
                window.location.href = "{{ route('welcome') }}";
            }, 3000);
        });

        // Add some interactive effects
        document.addEventListener('mousemove', function(e) {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.5;
                const x = mouseX * 50 * speed;
                const y = mouseY * 50 * speed;
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>
