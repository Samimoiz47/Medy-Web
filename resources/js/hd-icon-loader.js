/**
 * HD Icon Loader - Loads high-resolution images from external sources
 * for app/game icons without changing existing functionality
 */
class HDIconLoader {
    constructor() {
        this.fallbackIcons = {
            'productivity': '📊',
            'health': '💪',
            'photo': '📸',
            'video': '🎬',
            'social': '💬',
            'music': '🎵',
            'game': '🎮',
            'utility': '🔧'
        };
        
        this.hdIconSources = {
            // Default HD icon sources - can be updated dynamically
            google: 'https://via.placeholder.com/400x400/00d4ff/ffffff?text=',
            unsplash: 'https://source.unsplash.com/400x400/?',
            picsum: 'https://picsum.photos/400/400'
        };
    }

    /**
     * Load HD icon for an app/game
     * @param {HTMLElement} iconElement - The icon container element
     * @param {string} appName - Name of the app/game
     * @param {string} category - Category of the app/game
     * @param {string} source - Source of HD images (google, unsplash, picsum)
     */
    loadHDIcon(iconElement, appName, category, source = 'unsplash') {
        const img = document.createElement('img');
        img.alt = `${appName} icon`;
        img.className = 'hd-app-icon';
        img.style.cssText = `
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        `;

        // Set HD image source based on selected provider
        switch(source) {
            case 'google':
                img.src = `${this.hdIconSources.google}${encodeURIComponent(appName)}`;
                break;
            case 'unsplash':
                img.src = `${this.hdIconSources.unsplash}${encodeURIComponent(category)}`;
                break;
            case 'picsum':
                img.src = `${this.hdIconSources.picsum}?random=${Math.random()}`;
                break;
            default:
                img.src = iconElement.dataset.iconUrl || this.getFallbackIcon(category);
        }

        // Handle image loading errors
        img.onerror = () => {
            iconElement.innerHTML = this.getFallbackIcon(category);
            iconElement.style.cssText = `
                font-size: 4rem;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #00d4ff;
                text-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            `;
        };

        // Replace placeholder with HD image
        iconElement.innerHTML = '';
        iconElement.appendChild(img);
    }

    /**
     * Get fallback emoji icon based on category
     * @param {string} category 
     * @returns {string}
     */
    getFallbackIcon(category) {
        const normalizedCategory = category.toLowerCase();
        for (const [key, icon] of Object.entries(this.fallbackIcons)) {
            if (normalizedCategory.includes(key)) {
                return icon;
            }
        }
        return '📱'; // Default icon
    }

    /**
     * Initialize HD icon loading for all app cards
     */
    init() {
        const appCards = document.querySelectorAll('.app-card');
        
        appCards.forEach(card => {
            const iconElement = card.querySelector('.app-image');
            const appTitle = card.querySelector('.app-title')?.textContent || 'App';
            const appCategory = card.querySelector('.app-category')?.textContent || 'utility';
            
            if (iconElement) {
                // Load HD icon with a slight delay for better UX
                setTimeout(() => {
                    this.loadHDIcon(iconElement, appTitle, appCategory);
                }, 100);
            }
        });
    }

    /**
     * Update HD icon source dynamically
     * @param {string} source - New source (google, unsplash, picsum, custom)
     * @param {string} customUrl - Custom URL template for source
     */
    updateSource(source, customUrl = null) {
        if (customUrl) {
            this.hdIconSources[source] = customUrl;
        }
        
        // Reload all icons with new source
        this.init();
    }

    /**
     * Load custom HD icon from specific URL
     * @param {HTMLElement} iconElement 
     * @param {string} imageUrl 
     */
    loadCustomIcon(iconElement, imageUrl) {
        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = 'Custom app icon';
        img.className = 'hd-app-icon';
        img.style.cssText = `
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        `;
        
        iconElement.innerHTML = '';
        iconElement.appendChild(img);
    }
}

// Initialize HD icon loader when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const iconLoader = new HDIconLoader();
    iconLoader.init();
    
    // Make it globally accessible for dynamic updates
    window.HDIconLoader = iconLoader;
});

// Export for use in other modules
export default HDIconLoader;
