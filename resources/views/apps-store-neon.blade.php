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

        /* Neon Border Effects */
        .neon-border {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(45deg, rgba(10, 10, 10, 0.9), rgba(10, 10, 10, 0.9)) padding-box,
                        linear-gradient(45deg, #00d4ff, #ff00ff, #00ff88, #00d4ff) border-box;
            background-size: 400% 400%;
            animation: neon-glow 3s ease-in-out infinite;
            border-radius: 20px;
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
            padding: 3rem 1rem;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3);
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

        /* App Grid */
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
            min-height: 400px;
        }

        .app-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(0, 212, 255, 0.4),
                0 0 60px rgba(255, 0, 255, 0.2);
        }

        .app-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #00d4ff;
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
        }

        .app-content {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .app-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.5rem;
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
        }

        .app-rating {
            color: #00ff88;
            font-weight: 600;
        }

        .app-size {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .download-btn {
            width: 100%;
            padding: 1rem;
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
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 255, 136, 0.4);
            background: linear-gradient(45deg, #32cd32, #00ff88);
        }

        .free-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #00ff88, #32cd32);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
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
        }

        @media (max-width: 480px) {
            .cyber-header {
                padding: 2rem 1rem;
            }

            .cyber-title {
                font-size: 2rem;
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
            border-top: 3px solid #I have gathered the necessary information to create a new apps store page with the neon lightning theme. Here’s the comprehensive plan for the task:

### Information Gathered:
- **Current Pages**:
  - The **welcome page** (`welcome.blade.php`) contains a button for the app store, which needs to be connected to the new apps store page.
  - The **game store page** (`game-store-hyper.blade.php`) has a similar structure and styling, which can be reused for the apps store page.
- **Routing**:
  - The routing file (`web.php`) already has a route for the apps store (`apps-store-neon`), which will be used to display the new page.
- **App Model**:
  - The `App` model defines the structure for the apps, including properties like `name`, `description`, `category`, `version`, `size`, `download_url`, `icon_url`, `rating`, `download_count`, and `is_free`.

### Plan:
1. **Create a New Apps Store Page**:
   - Duplicate the `game-store-hyper.blade.php` file and rename it to `apps-store-neon.blade.php`.
   - Update the title and header to reflect the apps store.
   - Modify the content to display free apps instead of games, using the existing `App` model to fetch the data.

2. **Update the Welcome Page**:
   - Modify the button in the `welcome.blade.php` file to link to the new apps store page.

3. **Ensure Styling Consistency**:
   - Use the existing CSS styles from `hyper-realistic-effects.css` and `lightning-neon-buttons.css` to maintain the neon lightning theme.

4. **Testing**:
   - Verify that the new apps store page displays correctly and that the button on the welcome page navigates to it.

### Dependent Files to be Edited:
- `resources/views/welcome.blade.php`
- `resources/views/apps-store-neon.blade.php` (new file)

### Follow-up Steps:
- Create the new apps store page.
- Update the welcome page to link to the new page.
- Test the navigation and display of the apps store.

<ask_followup_question>
<question>Please confirm if I can proceed with this plan? Let me know if you have any feedback.</question>
</ask_followup_question>
