/* Interactive Elements for Hyper-Realistic Game Store 2025 */
import * as THREE from 'three';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import { ShaderPass } from 'three/examples/jsm/postprocessing/ShaderPass.js';

// Advanced Interactive Elements and Effects
class InteractiveElements {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.composer = null;
        this.mouse = new THREE.Vector2();
        this.raycaster = new THREE.Raycaster();
        this.interactiveObjects = [];
        
        this.init();
    }

    init() {
        this.setupThreeJS();
        this.setupMouseEvents();
        this.setupInteractiveElements();
        this.setupPostProcessing();
        this.animate();
    }

    setupThreeJS() {
        // Create scene
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(
            75,
            window.innerWidth / window.innerHeight,
            0.1,
            1000
        );
        this.camera.position.z = 5;

        // Create renderer
        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true
        });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        
        // Add to DOM
        const container = document.getElementById('three-canvas');
        if (container) {
            container.appendChild(this.renderer.domElement);
        }
    }

    setupPostProcessing() {
        // Create composer
        this.composer = new EffectComposer(this.renderer);
        
        // Add render pass
        const renderPass = new RenderPass(this.scene, this.camera);
        this.composer.addPass(renderPass);
        
        // Add bloom pass
        const bloomPass = new UnrealBloomPass(
            new THREE.Vector2(window.innerWidth, window.innerHeight),
            1.5, // strength
            0.4, // radius
            0.85  // threshold
        );
        this.composer.addPass(bloomPass);
    }

    setupMouseEvents() {
        window.addEventListener('mousemove', (event) => {
            this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            this.mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
            
            // Update camera based on mouse
            this.camera.position.x = this.mouse.x * 0.5;
            this.camera.position.y = this.mouse.y * 0.5;
        });

        window.addEventListener('resize', () => {
            this.camera.aspect = window.innerWidth / window.innerHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(window.innerWidth, window.innerHeight);
            this.composer.setSize(window.innerWidth, window.innerHeight);
        });
    }

    setupInteractiveElements() {
        // Create interactive 3D elements
        this.createFloatingElements();
        this.createInteractiveButtons();
        this.createMagneticEffects();
        this.createParticleTrails();
    }

    createFloatingElements() {
        // Create floating 3D elements
        const geometry = new THREE.SphereGeometry(0.5, 32, 32);
        const material = new THREE.MeshPhongMaterial({
            color: 0x00f5ff,
            emissive: 0x00f5ff,
            emissiveIntensity: 0.2,
            transparent: true,
            opacity: 0.8
        });

        for (let i = 0; i < 5; i++) {
            const sphere = new THREE.Mesh(geometry, material);
            sphere.position.set(
                (Math.random() - 0.5) * 10,
                (Math.random() - 0.5) * 10,
                (Math.random() - 0.5) * 10
            );
            sphere.userData = { type: 'floating', originalPosition: sphere.position.clone() };
            this.scene.add(sphere);
            this.interactiveObjects.push(sphere);
        }
    }

    createInteractiveButtons() {
        // Create interactive button effects
        const buttons = document.querySelectorAll('.nav-btn, .cta-primary, .cta-secondary');
        
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                this.createButtonGlow(button);
            });
            
            button.addEventListener('mouseleave', () => {
                this.removeButtonGlow(button);
            });
            
            button.addEventListener('click', () => {
                this.createClickEffect(button);
            });
        });
    }

    createButtonGlow(button) {
        const glow = document.createElement('div');
        glow.className = 'button-glow';
        glow.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #00f5ff, #ff0080);
            border-radius: inherit;
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
            filter: blur(20px);
        `;
        
        button.style.position = 'relative';
        button.appendChild(glow);
        
        setTimeout(() => {
            glow.style.opacity = '0.3';
        }, 10);
    }

    removeButtonGlow(button) {
        const glow = button.querySelector('.button-glow');
        if (glow) {
            glow.style.opacity = '0';
            setTimeout(() => glow.remove(), 300);
        }
    }

    createClickEffect(button) {
        const ripple = document.createElement('span');
        ripple.className = 'click-ripple';
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 245, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
        ripple.style.top = (event.clientY - rect.top - size / 2) + 'px';
        
        button.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }

    createMagneticEffects() {
        const magneticElements = document.querySelectorAll('.game-card-hyper');
        
        magneticElements.forEach(element => {
            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                element.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
            });
        });
    }

    createParticleTrails() {
        // Create particle trail effect on mouse move
        const particleTrail = [];
        const maxParticles = 50;
        
        document.addEventListener('mousemove', (e) => {
            if (particleTrail.length < maxParticles) {
                const particle = document.createElement('div');
                particle.className = 'mouse-particle';
                particle.style.cssText = `
                    position: fixed;
                    width: 4px;
                    height: 4px;
                    background: #00f5ff;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    transition: all 0.3s ease;
                `;
                
                particle.style.left = e.clientX + 'px';
                particle.style.top = e.clientY + 'px';
                
                document.body.appendChild(particle);
                particleTrail.push(particle);
                
                setTimeout(() => {
                    particle.style.opacity = '0';
                    particle.style.transform = 'scale(0)';
                    setTimeout(() => {
                        particle.remove();
                        const index = particleTrail.indexOf(particle);
                        if (index > -1) {
                            particleTrail.splice(index, 1);
                        }
                    }, 300);
                }, 100);
            }
        });
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        
        // Animate floating elements
        this.interactiveObjects.forEach(obj => {
            if (obj.userData.type === 'floating') {
                obj.rotation.x += 0.01;
                obj.rotation.y += 0.01;
                
                // Floating animation
                const time = Date.now() * 0.001;
                obj.position.y = obj.userData.originalPosition.y + Math.sin(time) * 0.5;
            }
        });
        
        // Render scene
        if (this.composer) {
            this.composer.render();
        } else if (this.renderer && this.scene && this.camera) {
            this.renderer.render(this.scene, this.camera);
        }
    }
}

// Advanced Interactive Features
class AdvancedInteractions {
    constructor() {
        this.init();
    }

    init() {
        this.setupScrollEffects();
        this.setupKeyboardShortcuts();
        this.setupGestureRecognition();
        this.setupHapticFeedback();
    }

    setupScrollEffects() {
        let ticking = false;
        
        function updateScrollEffects() {
            const scrolled = window.pageYOffset;
            const windowHeight = window.innerHeight;
            
            // Parallax effects
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            parallaxElements.forEach(element => {
                const speed = element.dataset.parallax || 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
            
            // Fade in effects
            const fadeElements = document.querySelectorAll('[data-fade]');
            fadeElements.forEach(element => {
                const elementTop = element.offsetTop;
                const elementVisible = 150;
                
                if (scrolled > elementTop - windowHeight + elementVisible) {
                    element.classList.add('visible');
                }
            });
            
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        });
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'ArrowUp':
                    e.preventDefault();
                    this.navigateUp();
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    this.navigateDown();
                    break;
                case 'Enter':
                    e.preventDefault();
                    this.activateCurrent();
                    break;
                case 'Escape':
                    this.closeAllModals();
                    break;
            }
        });
    }

    setupGestureRecognition() {
        let touchStartX = 0;
        let touchStartY = 0;
        
        document.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        });
        
        document.addEventListener('touchend', (e) => {
            const touchEndX = e.changedTouches[0].clientX;
            const touchEndY = e.changedTouches[0].clientY;
            
            const deltaX = touchEndX - touchStartX;
            const deltaY = touchEndY - touchStartY;
            
            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                if (deltaX > 50) {
                    this.swipeRight();
                } else if (deltaX < -50) {
                    this.swipeLeft();
                }
            }
        });
    }

    setupHapticFeedback() {
        // Simulate haptic feedback with visual cues
        const buttons = document.querySelectorAll('button, .game-card-hyper');
        
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                this.triggerHapticFeedback(button);
            });
            
            button.addEventListener('touchstart', () => {
                this.triggerHapticFeedback(button);
            });
        });
    }

    triggerHapticFeedback(element) {
        // Visual feedback
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 100);
        
        // Add ripple effect
        const ripple = document.createElement('div');
        ripple.className = 'haptic-ripple';
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 245, 255, 0.4);
            transform: scale(0);
            animation: haptic-ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (rect.width / 2 - size / 2) + 'px';
        ripple.style.top = (rect.height / 2 - size / 2) + 'px';
        
        element.style.position = 'relative';
        element.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }

    navigateUp() {
        // Navigate to previous section
        console.log('Navigate up');
    }

    navigateDown() {
        // Navigate to next section
        console.log('Navigate down');
    }

    activateCurrent() {
        // Activate current focused element
        console.log('Activate current');
    }

    closeAllModals() {
        // Close all open modals
        console.log('Close all modals');
    }

    swipeLeft() {
        // Handle left swipe
        console.log('Swipe left');
    }

    swipeRight() {
        // Handle right swipe
        console.log('Swipe right');
    }
}

// Initialize all interactive elements
document.addEventListener('DOMContentLoaded', function() {
    const interactiveElements = new InteractiveElements();
    const advancedInteractions = new AdvancedInteractions();
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes haptic-ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .mouse-particle {
            animation: mouse-particle-fade 0.3s ease-out;
        }
        
        @keyframes mouse-particle-fade {
            to {
                opacity: 0;
                transform: scale(0);
            }
        }
    `;
    document.head.appendChild(style);
});

// Export for use in other files
export { InteractiveElements, AdvancedInteractions };
