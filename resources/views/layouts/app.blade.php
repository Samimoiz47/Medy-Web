<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Arcade Gaming Hub') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;900&family=Audiowide&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/arcade-enhanced.css') }}">
    <link rel="stylesheet" href="{{ asset('css/game-store-3d-complete.css') }}">
    
    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Navigation -->
        <nav class="arcade-nav">
            <div class="arcade-nav-content">
                <div class="arcade-brand">ARCADE HUB 3D</div>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="#battle-royale" class="btn-enhanced">BATTLE ROYALE</a>
                    <a href="#racing" class="btn-enhanced">RACING</a>
                    <a href="#action" class="btn-enhanced">ACTION</a>
                    <a href="#fighting" class="btn-enhanced">FIGHTING</a>
                    <a href="#rpg" class="btn-enhanced">RPG</a>
                    <a href="#sports" class="btn-enhanced">SPORTS</a>
                    <a href="#puzzle" class="btn-enhanced">PUZZLE</a>
                    <a href="#horror" class="btn-enhanced">HORROR</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer style="text-align: center; padding: 3rem; background: linear-gradient(135deg, rgba(255, 0, 128, 0.2), rgba(0, 245, 255, 0.2)); margin-top: 4rem;">
            <h3 style="font-family: 'Audiowide', cursive; font-size: 2rem; margin-bottom: 1rem;">ARCADE GAMING HUB 3D</h3>
            <p style="font-size: 1.2rem; color: rgba(255, 255, 255, 0.8);">Experience the future of gaming with hyper-realistic 3D characters and immersive gameplay</p>
            <div style="margin-top: 2rem;">
                <a href="#battle-royale" class="btn-enhanced">BACK TO TOP</a>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script type="module" src="{{ asset('js/arcade-enhancements.js') }}"></script>
    <script type="module" src="{{ asset('js/game-store-3d.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
