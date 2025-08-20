/* Landing Animations for Hyper-Realistic Game Store 2025 */
import * as THREE from 'three';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import { ShaderPass } from 'three/examples/jsm/postprocessing/ShaderPass.js';
import { CopyShader } from 'three/examples/jsm/shaders/CopyShader.js';
import { LuminosityHighPassShader } from 'three/examples/jsm/shaders/LuminosityHighPassShader.js';

// Enhanced Landing Animations and Effects
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all animations and effects
    initLandingAnimations();
    initInteractiveElements();
    initParticleSystem();
    initNavigationEffects();
});

// Landing Animations
function initLandingAnimations() {
    // Preloader Animation
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.classList.add('hidden');
        }, 3000);
    }

    // Smooth Landing Animations
    const elements = document.querySelectorAll('.hero-title, .hero-subtitle, .hero-cta');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            element.style.transition = 'all 1s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 1000 + (index * 200));
    });

    // Parallax Effects
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.floating-elements');
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// Interactive Elements
function initInteractiveElements() {
    // Navigation Buttons
    const navButtons = document.querySelectorAll('.nav-btn');
    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            navButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 1000);
        });
    });

    // Floating Navigation Effects
    const floatingNav = document.querySelector('.floating-nav');
    if (floatingNav) {
        floatingNav.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(-50%) translateY(-2px)';
            this.style.boxShadow = '0 12px 40px rgba(0, 245, 255, 0.2)';
        });
        
        floatingNav.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(-50%)';
            this.style.boxShadow = '0 8px 32px rgba(0, 245, 255, 0.1)';
        });
    }

    // Interactive Elements
    const interactiveElements = document.querySelectorAll('.game-card-hyper');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) rotateX(5deg) rotateY(5deg)';
            this.style.boxShadow = '0 20px 40px rgba(0, 245, 255, 0.2)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
            this.style.boxShadow = '0 8px 32px rgba(0, 245, 255, 0.1)';
        });
    });
}

// Particle System
function initParticleSystem() {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const particles = [];
    const particleCount = 100;

    // Resize canvas on window resize
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });

    // Particle class
    class Particle {
        constructor(x, y, vx, vy, radius, color) {
            this.x = x;
            this.y = y;
            this.vx = vx;
            this.vy = vy;
            this.radius = radius;
            this.color = color;
            this.alpha = 1;
        }

        update() {
            this.x += this.vx;
            this.y += this.vy;

            if (this.x < 0 || this.x > canvas.width) this.vx = -this.vx;
            if (this.y < 0 || this.y > canvas.height) this.vy = -this.vy;

            this.alpha -= 0.01;
            if (this.alpha < 0) this.alpha = 1;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(0, 245, 255, ${this.alpha})`;
            ctx.fill();
        }
    }

    // Initialize particles
    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle(
            Math.random() * canvas.width,
            Math.random() * canvas.height,
            (Math.random() - 0.5) * 2,
            (Math.random() - 0.5) * 2,
            Math.random() * 3 + 1,
            'rgba(0, 245, 255, 0.8)'
        ));
    }

    // Animation loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });
        
        requestAnimationFrame(animate);
    }

    animate();
}

// Navigation Effects
function initNavigationEffects() {
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Smooth scroll effects
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.floating-elements');
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// Initialize all effects
initLandingAnimations();
initInteractiveElements();
initParticleSystem();
initNavigationEffects();
