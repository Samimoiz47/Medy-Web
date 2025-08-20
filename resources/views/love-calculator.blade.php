<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love Calculator - Neon Dreams</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Animated background */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 0, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(0, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(255, 0, 128, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(128, 0, 255, 0.1) 0%, transparent 50%);
            animation: bgPulse 4s ease-in-out infinite;
        }

        @keyframes bgPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.7; }
        }

        .love-calculator {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 0, 255, 0.3);
            border-radius: 25px;
            padding: 3rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 10;
            box-shadow: 
                0 0 50px rgba(255, 0, 255, 0.2),
                inset 0 0 50px rgba(0, 255, 255, 0.1);
            animation: neonGlow 3s ease-in-out infinite alternate;
        }

        @keyframes neonGlow {
            0% {
                box-shadow: 
                    0 0 50px rgba(255, 0, 255, 0.2),
                    inset 0 0 50px rgba(0, 255, 255, 0.1);
            }
            100% {
                box-shadow: 
                    0 0 80px rgba(255, 0, 255, 0.4),
                    inset 0 0 80px rgba(0, 255, 255, 0.2);
            }
        }

        .title {
            font-size: 2.8rem;
            background: linear-gradient(45deg, #ff00ff, #00ffff, #ff00ff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: neonText 2s ease-in-out infinite alternate;
            margin-bottom: 2rem;
            text-shadow: 0 0 30px rgba(255, 0, 255, 0.5);
        }

        @keyframes neonText {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .input-group {
            margin: 2rem 0;
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 1.2rem;
            font-size: 1.1rem;
            border: 2px solid rgba(255, 0, 255, 0.3);
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.5);
            color: #00ffff;
            text-align: center;
            outline: none;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .input-field::placeholder {
            color: rgba(0, 255, 255, 0.6);
        }

        .input-field:focus {
            border-color: #00ffff;
            box-shadow: 
                0 0 20px rgba(0, 255, 255, 0.5),
                inset 0 0 20px rgba(255, 0, 255, 0.1);
            animation: inputPulse 1.5s ease-in-out infinite;
        }

        @keyframes inputPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 255, 255, 0.5), inset 0 0 20px rgba(255, 0, 255, 0.1); }
            50% { box-shadow: 0 0 30px rgba(0, 255, 255, 0.8), inset 0 0 30px rgba(255, 0, 255, 0.2); }
        }

        .calculate-btn {
            background: linear-gradient(45deg, #ff00ff, #00ffff);
            background-size: 200% 200%;
            color: white;
            padding: 1.2rem 2.5rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 1.5rem 0;
            box-shadow: 0 0 20px rgba(255, 0, 255, 0.3);
            animation: buttonGlow 2s ease-in-out infinite alternate;
            position: relative;
            overflow: hidden;
            z-index: 100;
            display: inline-block;
            min-height: 50px;
            line-height: 1.2;
        }

        .calculate-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .calculate-btn:hover::before {
            left: 100%;
        }

        .calculate-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 0 40px rgba(255, 0, 255, 0.6);
        }

        @keyframes buttonGlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .result {
            margin-top: 2rem;
            padding: 1.5rem;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 0, 255, 0.3);
            display: none;
            animation: resultGlow 1s ease-in-out;
        }

        @keyframes resultGlow {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }

        .percentage {
            font-size: 3.5rem;
            font-weight: bold;
            background: linear-gradient(45deg, #ff00ff, #00ffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: percentageGlow 1.5s ease-in-out infinite alternate;
            margin-bottom: 1rem;
        }

        @keyframes percentageGlow {
            0% { text-shadow: 0 0 10px rgba(255, 0, 255, 0.5); }
            100% { text-shadow: 0 0 20px rgba(0, 255, 255, 0.8); }
        }

        .message {
            font-size: 1.3rem;
            color: #00ffff;
            margin-bottom: 1rem;
            animation: messageFade 2s ease-in-out;
        }

        @keyframes messageFade {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .hearts-animation {
            font-size: 2.5rem;
            animation: neonHearts 1s ease-in-out infinite;
        }

        @keyframes neonHearts {
            0%, 100% { 
                transform: scale(1);
                filter: drop-shadow(0 0 10px #ff00ff);
            }
            50% { 
                transform: scale(1.2);
                filter: drop-shadow(0 0 20px #00ffff);
            }
        }

        .floating-hearts {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .heart-float {
            position: absolute;
            color: #ff00ff;
            font-size: 20px;
            animation: neonFloat 8s ease-in-out infinite;
            filter: drop-shadow(0 0 5px #ff00ff);
        }

        .heart-float:nth-child(odd) {
            color: #00ffff;
            filter: drop-shadow(0 0 5px #00ffff);
        }

        @keyframes neonFloat {
            0% { 
                transform: translateY(100vh) rotate(0deg) scale(0); 
                opacity: 0; 
            }
            10% { 
                opacity: 1; 
                transform: translateY(90vh) rotate(36deg) scale(1);
            }
            90% { 
                opacity: 1; 
                transform: translateY(-10vh) rotate(324deg) scale(1);
            }
            100% { 
                transform: translateY(-100vh) rotate(360deg) scale(0); 
                opacity: 0; 
            }
        }

        .back-btn {
            margin-top: 2rem;
            color: #00ffff;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.3);
        }

        .back-btn:hover {
            color: #ff00ff;
            border-color: #ff00ff;
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
            transform: translateY(-2px);
        }

        .love-meter {
            width: 100%;
            height: 25px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 0, 255, 0.3);
            border-radius: 15px;
            overflow: hidden;
            margin: 1.5rem 0;
            display: none;
            position: relative;
        }

        .love-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff00ff, #00ffff, #ff00ff);
            background-size: 200% 100%;
            width: 0%;
            transition: width 2s ease;
            border-radius: 15px;
            animation: loveFillGlow 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .love-fill::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: loveFillShine 2s linear infinite;
        }

        @keyframes loveFillGlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        @keyframes loveFillShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .love-calculator {
                padding: 2rem;
                margin: 1rem;
            }
            
            .title {
                font-size: 2.2rem;
            }
            
            .input-field {
                padding: 1rem;
                font-size: 1rem;
            }
            
            .calculate-btn {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <div class="floating-hearts">
        <div class="heart-float" style="left: 10%; animation-delay: 0s;">♥</div>
        <div class="heart-float" style="left: 20%; animation-delay: 1s;">♥</div>
        <div class="heart-float" style="left: 30%; animation-delay: 2s;">♥</div>
        <div class="heart-float" style="left: 40%; animation-delay: 3s;">♥</div>
        <div class="heart-float" style="left: 50%; animation-delay: 4s;">♥</div>
        <div class="heart-float" style="left: 60%; animation-delay: 5s;">♥</div>
        <div class="heart-float" style="left: 70%; animation-delay: 6s;">♥</div>
        <div class="heart-float" style="left: 80%; animation-delay: 7s;">♥</div>
        <div class="heart-float" style="left: 90%; animation-delay: 8s;">♥</div>
    </div>

    <div class="love-calculator">
        <h1 class="title">💕 Love Calculator 💕</h1>
        
        <div class="input-group">
            <input type="text" id="name1" class="input-field" placeholder="Your Name" required>
        </div>
        
        <div class="input-group">
            <input type="text" id="name2" class="input-field" placeholder="Your Crush's Name" required>
        </div>
        
        <button class="calculate-btn" onclick="calculateLove()">
            Calculate Love 💕
        </button>
        
        <div class="love-meter" id="loveMeter">
            <div class="love-fill" id="loveFill"></div>
        </div>
        
        <div class="result" id="result">
            <div class="percentage" id="percentage">0%</div>
            <div class="message" id="message"></div>
            <div class="hearts-animation">💕💕💕</div>
        </div>
        
        <a href="{{ route('welcome') }}" class="back-btn">← Back to Welcome</a>
    </div>

    <script>
        function calculateLove() {
            const name1 = document.getElementById('name1').value.trim();
            const name2 = document.getElementById('name2').value.trim();
            
            if (!name1 || !name2) {
                alert('Please enter both names! 💕');
                return;
            }
            
            // Modern love calculation algorithm
            const combinedNames = (name1 + name2).toLowerCase();
            let loveScore = 0;
            
            // Calculate based on letters and their positions
            for (let i = 0; i < combinedNames.length; i++) {
                const char = combinedNames[i];
                const charCode = char.charCodeAt(0);
                loveScore += (charCode * (i + 1)) % 100;
            }
            
            // Add some randomness for variety
            loveScore = (loveScore + Math.floor(Math.random() * 20)) % 101;
            
            // Ensure minimum 20% for romance
            loveScore = Math.max(20, loveScore);
            
            displayResult(loveScore);
        }
        
        function displayResult(percentage) {
            const result = document.getElementById('result');
            const percentageEl = document.getElementById('percentage');
            const messageEl = document.getElementById('message');
            const loveMeter = document.getElementById('loveMeter');
            const loveFill = document.getElementById('loveFill');
            
            result.style.display = 'block';
            loveMeter.style.display = 'block';
            
            // Animate the percentage
            let current = 0;
            const interval = setInterval(() => {
                current++;
                percentageEl.textContent = current + '%';
                loveFill.style.width = current + '%';
                
                if (current >= percentage) {
                    clearInterval(interval);
                    displayMessage(percentage);
                }
            }, 20);
        }
        
        function displayMessage(percentage) {
            const messageEl = document.getElementById('message');
            let message = '';
            
            if (percentage >= 90) {
                message = "💕 Soulmates! Your love is written in the stars! 💕";
            } else if (percentage >= 80) {
                message = "💖 Deep connection! You're meant to be together! 💖";
            } else if (percentage >= 70) {
                message = "💝 Strong attraction! Love is in the air! 💝";
            } else if (percentage >= 60) {
                message = "💗 Good chemistry! Keep exploring this connection! 💗";
            } else if (percentage >= 50) {
                message = "💓 Potential for love! Take your time! 💓";
            } else if (percentage >= 40) {
                message = "💞 Friendship could blossom into something more! 💞";
            } else {
                message = "💘 Every love story is unique - keep an open heart! 💘";
            }
            
            messageEl.textContent = message;
        }
        
        // Allow Enter key to calculate
        document.getElementById('name1').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') calculateLove();
        });
        
        document.getElementById('name2').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') calculateLove();
        });
    </script>
</body>
</html>
