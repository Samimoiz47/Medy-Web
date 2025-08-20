<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Video Chat - Neon Lightning Theme</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/ai-video-chat-neon.css', 'resources/js/ai-video-chat-fixed.js'])
    <style>
        /* Welcome Page Loading Animation Styles */
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

        /* Neon Lightning Variables */
        :root {
            --neon-blue: #00f5ff;
            --neon-pink: #ff0080;
            --neon-purple: #7b68ee;
            --neon-green: #39ff14;
            --neon-yellow: #ffff00;
            --dark-bg: #0a0a0f;
            --glass-bg: rgba(255, 255, 255, 0.05);
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
                radial-gradient(circle at 50% 20%, rgba(123, 104, 238, 0.1) 0%, transparent 50%);
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
                rgba(123, 104, 238, 0.1));
            border-right: 2px solid;
            border-image: linear-gradient(to bottom, 
                var(--neon-blue), 
                var(--neon-pink), 
                var(--neon-purple)) 1;
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
                var(--neon-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            animation: electric-pulse 2s ease-in-out infinite;
            box-shadow: 
                0 0 30px var(--neon-blue),
                0 0 60px var(--neon-pink),
                0 0 90px var(--neon-purple);
        }

        .chat-section {
            flex: 1;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-left: 2px solid;
            border-image: linear-gradient(to bottom, 
                var(--neon-green), 
                var(--neon-yellow), 
                var(--neon-blue)) 1;
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
                var(--neon-purple)) 1;
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
                var(--neon-purple));
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
                    var(--neon-purple)) 1;
            }

            .chat-section {
                flex: 1;
                border-left: none;
                border-top: 2px solid;
                border-image: linear-gradient(to right, 
                    var(--neon-green), 
                    var(--neon-yellow), 
                    var(--neon-blue)) 1;
            }

            .avatar-face {
                width: 200px;
                height: 200px;
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <style>
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
                border-color: var(--neon-blue);
                box-shadow: 0 0 5px var(--neon-blue), inset 0 0 5px var(--neon-blue);
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
</body>
    <!-- Welcome Page Loading Animation -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Gemini API functionality is handled by ai-video-chat-fixed.js -->
    <div class="chat-container">
        <div class="video-section">
            <div class="status-indicator">AI Online</div>
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
        // Hide loading overlay on page load
        window.addEventListener('load', function() {
            setTimeout(() => {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(() => {
                        loadingOverlay.style.display = 'none';
                    }, 500);
                }
            }, 1000);
        });

        // Also handle DOM ready for faster hiding
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(() => {
                        loadingOverlay.style.display = 'none';
                    }, 500);
                }
            }, 500);
        });
    </script>
</body>
</html>
