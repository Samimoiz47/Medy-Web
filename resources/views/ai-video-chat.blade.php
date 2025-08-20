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
                <input type="text" class="messageTo integrate an AI video chat feature into the welcome page, I will follow these steps:

1. **Identify the AI Video Chat API**: Research and find a suitable free AI video chat API that supports real-time voice and video chat features.

2. **Update the Welcome Page**: Modify the `welcome.blade.php` file to include the necessary JavaScript and HTML elements to interact with the AI video chat API.

3. **Implement the Button Functionality**: Ensure that the "AI Video Chat" button triggers the video chat functionality when clicked.

4. **Test the Integration**: Verify that the video chat feature works as expected.

### Step 1: Identify the AI Video Chat API
I will search for a suitable free AI video chat API that meets the requirements. 

<search_code>
<query>AI video chat API free</query>
<path>c:/Users/DELL/Desktop/Medy-Apps</path>
</search_code>
