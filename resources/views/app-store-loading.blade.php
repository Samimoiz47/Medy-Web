<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loading App Store...</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app-store-loading.css') }}">
</head>
<body>
    <div class="app-store-loader" id="app-store-loader">
        <div class="app-particles">
            <div class="app-particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="app-particle" style="left: 20%; animation-delay: 1s;"></div>
            <div class="app-particle" style="left: 30%; animation-delay: 2s;"></div>
            <div class="app-particle" style="left: 40%; animation-delay: 3s;"></div>
            <div class="app-particle" style="left: 50%; animation-delay: 4s;"></div>
            <div class="app-particle" style="left: 60%; animation-delay: 5s;"></div>
            <div class="app-particle" style="left: 70%; animation-delay: 6s;"></div>
            <div class="app-particle" style="left: 80%; animation-delay: 7s;"></div>
            <div class="app-particle" style="left: 90%; animation-delay: 8s;"></div>
        </div>

        <div class="app-store-loading-container">
            <div class="app-store-logo">APP STORE</div>
            
            <div class="app-loading-status">
                Loading Apps
                <div class="app-loading-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <div class="app-grid-loader">
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
                <div class="app-grid-item"></div>
            </div>
            
            <div class="app-progress-container">
                <div class="app-progress-bar"></div>
            </div>
        </div>
    </div>

    <script>
        // Simulate App Store loading
        const loadingSteps = [
            'Fetching app data...',
            'Loading app icons...',
            'Setting up categories...',
            'Almost ready to explore...'
        ];
        
        let currentStep = 0;
        const statusElement = document.querySelector('.app-loading-status');
        
        const stepInterval = setInterval(() => {
            if (currentStep < loadingSteps.length) {
                statusElement.innerHTML = loadingSteps[currentStep] + 
                    '<div class="app-loading-dots"><span></span><span></span><span></span></div>';
                currentStep++;
            } else {
                clearInterval(stepInterval);
            }
        }, 600);
    </script>
</body>
</html>
