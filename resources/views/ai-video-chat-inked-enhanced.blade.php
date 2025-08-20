<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inked Enhanced AI Video Chat - Blade Loading</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ai-video-chat-inked-enhanced.css') }}">
</head>
<body>
    <!-- Enhanced Loading Screen with Blade Animations -->
    <div class="inked-loading-overlay" id="inkedLoadingOverlay">
        <div class="blade-loading-container">
            <!-- Blade-like Loading Elements -->
            <div class="blade-spinner-container">
                <div class="blade-spinner">
                    <div class="blade-blade blade-1"></div>
                    <div class="blade-blade blade-2"></div>
                    <div class="blade-blade blade-3"></div>
                    <div class="blade-blade blade-4"></div>
                </div>
                <div class="blade-center-glow"></div>
            </div>

            <!-- Inked Neon Effects -->
            <div class="inked-neon-container">
                <div class="inked-neon-text">
                    <span class="inked-main-text">AI VIDEO CHAT</span>
                    <span class="inked-subtitle">INKED ENHANCED</span>
                </div>
                
                <div class="inked-loading-status">
                    <div class="inked-status-item">
                        <span class="inked-status-text">Initializing Neural Networks</span>
                        <div class="inked-progress-bar">
                            <div class="inked-progress-fill" id="neuralProgress"></div>
                        </div>
                    </div>
                    <div class="inked-status-item">
                        <span class="inked-status-text">Loading Multi-Language Support</span>
                        <div class="inked-progress-bar">
                            <div class="inked-progress-fill" id="languageProgress"></div>
                        </div>
                    </div>
                    <div class="inked-status-item">
                        <span class="inked-status-text">Calibrating Video Streams</span>
                        <div class="inked-progress-bar">
                            <div class="inked-progress-fill" id="videoProgress"></div>
                        </div>
                    </div>
                </div>

                <!-- Particle Ink Effects -->
                <div class="inked-particles">
                    <div class="inked-particle" style="--delay: 0s;"></div>
                    <div class="inked-particle" style="--delay: 0.5s;"></div>
                    <div class="inked-particle" style="--delay: 1s;"></div>
                    <div class="inked-particle" style="--delay: 1.5s;"></div>
                    <div class="inked-particle" style="--delay: 2s;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main AI Video Chat Interface -->
    <div class="inked-main-container" id="inkedMainContainer" style="display: none;">
        <!-- Header with Blade Design -->
        <header class="inked-header">
            <div class="inked-header-blade">
                <div class="inked-logo">
                    <span class="inked-logo-text">AI VIDEO CHAT</span>
                    <span class="inked-logo-subtitle">INKED ENHANCED</span>
                </div>
                <div class="inked-status-indicator">
                    <span class="inked-status-dot"></span>
                    <span class="inked-status-text">AI Online</span>
                </div>
            </div>
            
            <div class="inked-controls">
                <select id="inkedLanguageSelect" class="inked-language-selector">
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                    <option value="de">Deutsch</option>
                    <option value="ja">日本語</option>
                    <option value="ko">한국어</option>
                    <option value="zh">中文</option>
                </select>
                
                <div class="inked-control-buttons">
                    <button class="inked-btn inked-mute-btn" title="Mute/Unmute">
                        <span class="inked-icon">🔊</span>
                    </button>
                    <button class="inked-btn inked-video-btn" title="Video On/Off">
                        <span class="inked-icon">📹</span>
                    </button>
                    <button class="inked-btn inked-settings-btn" title="Settings">
                        <span class="inked-icon">⚙️</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Chat Layout -->
        <div class="inked-chat-layout">
            <!-- Video Section with Blade Frame -->
            <div class="inked-video-section">
                <div class="inked-video-frame">
                    <div class="inked-video-container">
                        <div class="inked-ai-avatar">
                            <div class="inked-avatar-display">
                                <div class="inked-avatar-face">🤖</div>
                                <div class="inked-avatar-glow"></div>
                            </div>
                        </div>
                        
                        <div class="inked-video-controls">
                            <button class="inked-video-control" data-action="fullscreen">
                                <span class="inked-icon">⛶</span>
                            </button>
                            <button class="inked-video-control" data-action="pip">
                                <span class="inked-icon">📺</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Section with Inked Design -->
            <div class="inked-chat-section">
                <div class="inked-chat-header">
                    <h2 class="inked-chat-title">AI Assistant</h2>
                    <p class="inked-chat-subtitle">Ready to chat in your language</p>
                </div>

                <div class="inked-messages-container" id="inkedMessagesContainer">
                    <div class="inked-message inked-message-ai">
                        <div class="inked-message-avatar">🤖</div>
                        <div class="inked-message-content">
                            <p>Welcome to Inked Enhanced AI Video Chat! I'm ready to assist you in your preferred language.</p>
                        </div>
                    </div>
                </div>

                <div class="inked-typing-indicator" id="inkedTypingIndicator">
                    <span>AI is thinking...</span>
                </div>

                <div class="inked-input-section">
                    <div class="inked-input-container">
                        <input type="text" 
                               id="inkedMessageInput" 
                               class="inked-message-input" 
                               placeholder="Type your message..."
                               autocomplete="off">
                        
                        <div class="inked-input-actions">
                            <button class="inked-action-btn inked-send-btn" title="Send">
                                <span class="inked-icon">📤</span>
                            </button>
                            <button class="inked-action-btn inked-mic-btn" title="Voice Input">
                                <span class="inked-icon">🎤</span>
                            </button>
                            <button class="inked-action-btn inked-emoji-btn" title="Emoji">
                                <span class="inked-icon">😊</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Blade Controls -->
        <div class="inked-floating-controls">
            <div class="inked-control-panel">
                <button class="inked-float-btn inked-float-mute" title="Mute">
                    <span class="inked-float-icon">🔊</span>
                </button>
                <button class="inked-float-btn inked-float-video" title="Video">
                    <span class="inked-float-icon">📹</span>
                </button>
                <button class="inked-float-btn inked-float-end" title="End Call">
                    <span class="inked-float-icon">📞</span>
                </button>
            </div>
        </div>
    </div>

