// Ultra-Fast Loading Controller - No Animation Version
class NeonLoadingController {
    constructor() {
        this.overlay = null;
        this.init();
    }

    init() {
        this.createLoadingOverlay();
        this.bindEvents();
    }

    createLoadingOverlay() {
        // Create minimal overlay
        this.overlay = document.createElement('div');
        this.overlay.className = 'neon-loading-overlay';
        this.overlay.style.display = 'none';
        document.body.appendChild(this.overlay);
    }

    bindEvents() {
        // Skip loading entirely on page load
        window.addEventListener('load', () => {
            this.hide();
        });

        // Listen for custom events
        document.addEventListener('showNeonLoading', () => this.show());
        document.addEventListener('hideNeonLoading', () => this.hide());
    }

    show() {
        // Skip showing loading
        this.hide();
    }

    hide() {
        // Hide immediately
        if (this.overlay) {
            this.overlay.style.display = 'none';
        }
    }

    // Static methods for easy access
    static show() {
        if (!window.neonLoader) {
            window.neonLoader = new NeonLoadingController();
        }
        window.neonLoader.hide();
    }

    static hide() {
        if (window.neonLoader) {
            window.neonLoader.hide();
        }
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.neonLoader = new NeonLoadingController();
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NeonLoadingController;
}
