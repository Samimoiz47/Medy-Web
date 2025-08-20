<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loading AI Video Chat...</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ai-video-chat-loading.css') }}">
</head>
<body>
    <div class="ai-video-chat-loader" id="ai-chat-loader">
        <div class="ai-particles">
            <div class="ai-particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="ai-particle" style="left: 20%; animation-delay: 1s;"></div>
            <div class="ai-particle" style="left: 30%; animation-delay: 2s;"></div>
            <div class="ai-particle" style="left: 40%; animation-delay: 3s;"></div>
            <div class="ai-particle" style="left: 50%; animation-delay: 4s;"></div>
            <div class="ai-particle" style="left: 60%; animation-delay: 5s;"></div>
            <div class="ai-particle" style="left: 70%; animation-delay: 6s;"></div>
            <div class="ai-particle" style="left: 80%; animation-delay: 7s;"></div>
            <div class="ai-particle" style="left: 90%; animation-delay: 8s;"></div>
        </div>

        <div class="ai-chat-loading-container">
            <div class="ai-chat-logo">AI VIDEO CHAT</div>
            
            <div class="ai-chat-status">
                Initializing AI Assistant
                <div class="ai-chat-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <div class="ai-chat-spinner">
                <div class="ai-chat-ring"></div>
                <div class="ai-chat-ring"></div>
                <div class="ai-chat-ring"></div>
            </div>
            
            <div class="ai-progress-container">
                <div class="ai-progress-bar"></div>
            </div>
        </div>
    </div>

    <script>
        // Simulate AI initialization
        const loadingSteps = [
            'Connecting to AI servers...',
            'Loading neural networks...',
            'Setting up video streams...',
            'Preparing chat interface...',
            'Almost ready...'
        ];
        
        let currentStep = 0;
        const statusElement = document.querySelector('.ai-chat-status');
        
        const stepInterval = setInterval(() => {
            if (currentStep < loadingSteps.length) {
                statusElement.innerHTML = loadingSteps[currentStep] + 
                    '<div class="ai-chat-dots"><span></span><span></span><span></span></div>';
                currentStep++;
            } else {
                clearInterval(stepInterval);
            }
        }, 600);
    </script>
</body>
</html>
