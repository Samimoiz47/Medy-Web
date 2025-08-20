// Multilingual AI Support System - Fixed Version
// Comprehensive multilingual support with error handling

class MultilingualAISupport {
    constructor() {
        this.currentLanguage = 'en';
        this.supportedLanguages = ['en', 'es', 'fr', 'de', 'it', 'pt', 'ru', 'ja', 'ko', 'zh'];
        this.translations = {};
        this.aiResponses = {};
        this.isInitialized = false;
        this.fallbackTranslations = this.getDefaultTranslations();
        
        // Bind methods to prevent context issues
        this.init = this.init.bind(this);
        this.changeLanguage = this.changeLanguage.bind(this);
        this.t = this.t.bind(this);
        
        // Initialize
        this.init();
    }

    async init() {
        try {
            await this.loadTranslations();
            this.setupEventListeners();
            this.initializeAIResponses();
            this.restoreLanguagePreference();
            this.isInitialized = true;
            console.log('Multilingual AI Support initialized successfully');
        } catch (error) {
            console.error('Failed to initialize Multilingual AI Support:', error);
            this.setupFallbackTranslations();
        }
    }

    getDefaultTranslations() {
        return {
            en: {
                greeting: 'Hello',
                welcome: 'Welcome to our AI Assistant',
                loading: 'Loading...',
                error: 'An error occurred',
                try_again: 'Try again',
                send: 'Send',
                type_message: 'Type your message...',
                ai_thinking: 'AI is thinking...',
                language_changed: 'Language changed successfully',
                no_response: 'No response received',
                connection_error: 'Connection error. Please try again.'
            },
            es: {
                greeting: 'Hola',
                welcome: 'Bienvenido a nuestro Asistente IA',
                loading: 'Cargando...',
                error: 'Ocurrió un error',
                try_again: 'Intentar de nuevo',
                send: 'Enviar',
                type_message: 'Escribe tu mensaje...',
                ai_thinking: 'La IA está pensando...',
                language_changed: 'Idioma cambiado exitosamente',
                no_response: 'No se recibió respuesta',
                connection_error: 'Error de conexión. Por favor intenta de nuevo.'
            },
            fr: {
                greeting: 'Bonjour',
                welcome: 'Bienvenue dans notre Assistant IA',
                loading: 'Chargement...',
                error: 'Une erreur est survenue',
                try_again: 'Réessayer',
                send: 'Envoyer',
                type_message: 'Tapez votre message...',
                ai_thinking: "L'IA réfléchit...",
                language_changed: 'Langue changée avec succès',
                no_response: 'Aucune réponse reçue',
                connection_error: "Erreur de connexion. Veuillez réessayer."
            }
        };
    }

    setupFallbackTranslations() {
        this.translations = this.getDefaultTranslations();
    }

    async loadTranslations() {
        try {
            for (let lang of this.supportedLanguages) {
                try {
                    const response = await fetch(`/lang/${lang}.json`);
                    if (response.ok) {
                        const data = await response.json();
                        this.translations[lang] = { ...this.getDefaultTranslations()[lang], ...data };
                    } else {
                        this.translations[lang] = this.getDefaultTranslations()[lang] || this.getDefaultTranslations().en;
                    }
                } catch (error) {
                    console.warn(`Failed to load ${lang} translations, using defaults`);
                    this.translations[lang] = this.getDefaultTranslations()[lang] || this.getDefaultTranslations().en;
                }
            }
        } catch (error) {
            console.error('Error loading translations:', error);
            this.setupFallbackTranslations();
        }
    }

    setupEventListeners() {
        try {
            // Language selector
            const languageSelector = document.getElementById('language-selector');
            if (languageSelector) {
                languageSelector.addEventListener('change', (e) => {
                    this.changeLanguage(e.target.value);
                });
            }

            // AI chat form
            const chatForm = document.getElementById('ai-chat-form');
            if (chatForm) {
                chatForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleChatSubmit();
                });
            }

            // Language buttons
            document.querySelectorAll('[data-language]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.changeLanguage(button.dataset.language);
                });
            });

            // Auto-detect language on first load
            if (!localStorage.getItem('preferredLanguage')) {
                this.detectUserLanguage();
            }
        } catch (error) {
            console.error('Error setting up event listeners:', error);
        }
    }

    detectUserLanguage() {
        try {
            const userLang = navigator.language || navigator.userLanguage || 'en';
            const shortLang = userLang.substring(0, 2);
            if (this.supportedLanguages.includes(shortLang)) {
                this.changeLanguage(shortLang);
            }
        } catch (error) {
            console.warn('Could not detect user language:', error);
        }
    }

    changeLanguage(lang) {
        if (!this.supportedLanguages.includes(lang)) {
            console.warn(`Unsupported language: ${lang}`);
            return;
        }

        try {
            this.currentLanguage = lang;
            this.updateUI();
            this.updateAIResponses();
            this.saveLanguagePreference(lang);
            this.showNotification(this.t('language_changed'));
        } catch (error) {
            console.error('Error changing language:', error);
        }
    }

    saveLanguagePreference(lang) {
        try {
            localStorage.setItem('preferredLanguage', lang);
        } catch (error) {
            console.warn('Could not save language preference:', error);
        }
    }

    restoreLanguagePreference() {
        try {
            const saved = localStorage.getItem('preferredLanguage');
            if (saved && this.supportedLanguages.includes(saved)) {
                this.currentLanguage = saved;
            }
        } catch (error) {
            console.warn('Could not restore language preference:', error);
        }
    }

    t(key, fallback = '') {
        try {
            const translation = this.translations[this.currentLanguage]?.[key] || 
                               this.translations.en?.[key] || 
                               fallback || 
                               key;
            return translation || key;
        } catch (error) {
            console.error('Error getting translation:', error);
            return key;
        }
    }

    updateUI() {
        try {
            // Update text elements with data-i18n attributes
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                const translation = this.t(key);
                if (element.tagName === 'INPUT' && element.type !== 'submit') {
                    element.placeholder = translation;
                } else {
                    element.textContent = translation;
                }
            });

            // Update language selector
            const selector = document.getElementById('language-selector');
            if (selector) {
                selector.value = this.currentLanguage;
            }

            // Update document language
            document.documentElement.lang = this.currentLanguage;
        } catch (error) {
            console.error('Error updating UI:', error);
        }
    }

    initializeAIResponses() {
        this.aiResponses = {
            greeting: {
                en: "Hello! I'm your AI assistant. How can I help you today?",
                es: "¡Hola! Soy tu asistente IA. ¿Cómo puedo ayudarte hoy?",
                fr: "Bonjour! Je suis votre assistant IA. Comment puis-je vous aider aujourd'hui?"
            },
            help: {
                en: "I can help you with various tasks. Just ask me anything!",
                es: "Puedo ayudarte con varias tareas. ¡Solo pregúntame cualquier cosa!",
                fr: "Je peux vous aider avec diverses tâches. Demandez-moi n'importe quoi!"
            }
        };
    }

    updateAIResponses() {
        try {
            // Update AI chat responses based on current language
            const aiMessages = document.querySelectorAll('.ai-message');
            aiMessages.forEach(message => {
                const responseKey = message.dataset.responseKey;
                if (responseKey && this.aiResponses[responseKey]?.[this.currentLanguage]) {
                    message.textContent = this.aiResponses[responseKey][this.currentLanguage];
                }
            });
        } catch (error) {
            console.error('Error updating AI responses:', error);
        }
    }

    async handleChatSubmit() {
        try {
            const input = document.getElementById('ai-chat-input');
            const message = input?.value?.trim();
            
            if (!message) return;

            this.showUserMessage(message);
            input.value = '';

            await this.sendToAI(message);
        } catch (error) {
            console.error('Error handling chat submit:', error);
            this.showError(this.t('error'));
        }
    }

    showUserMessage(message) {
        try {
            const chatContainer = document.getElementById('ai-chat-messages');
            if (!chatContainer) return;

            const messageDiv = document.createElement('div');
            messageDiv.className = 'user-message';
            messageDiv.textContent = message;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        } catch (error) {
            console.error('Error showing user message:', error);
        }
    }

    async sendToAI(message) {
        try {
            this.showLoading();

            // Simulate AI response (replace with actual API call)
            const response = await this.simulateAIResponse(message);
            
            this.hideLoading();
            this.showAIMessage(response);
        } catch (error) {
            console.error('Error sending to AI:', error);
            this.hideLoading();
            this.showError(this.t('connection_error'));
        }
    }

    async simulateAIResponse(message) {
        // Simulate API delay
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Simple response based on keywords
        const lowerMessage = message.toLowerCase();
        if (lowerMessage.includes('hello') || lowerMessage.includes('hi')) {
            return this.aiResponses.greeting?.[this.currentLanguage] || 'Hello!';
        }
        return this.aiResponses.help?.[this.currentLanguage] || 'How can I help you?';
    }

    showLoading() {
        try {
            const loadingDiv = document.getElementById('ai-loading');
            if (loadingDiv) {
                loadingDiv.style.display = 'block';
                loadingDiv.textContent = this.t('ai_thinking');
            }
        } catch (error) {
            console.error('Error showing loading:', error);
        }
    }

    hideLoading() {
        try {
            const loadingDiv = document.getElementById('ai-loading');
            if (loadingDiv) {
                loadingDiv.style.display = 'none';
            }
        } catch (error) {
            console.error('Error hiding loading:', error);
        }
    }

    showAIMessage(message) {
        try {
            const chatContainer = document.getElementById('ai-chat-messages');
            if (!chatContainer) return;

            const messageDiv = document.createElement('div');
            messageDiv.className = 'ai-message';
            messageDiv.textContent = message;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        } catch (error) {
            console.error('Error showing AI message:', error);
        }
    }

    showError(message) {
        try {
            const errorDiv = document.getElementById('ai-error');
            if (errorDiv) {
                errorDiv.style.display = 'block';
                errorDiv.textContent = message;
                setTimeout(() => {
                    errorDiv.style.display = 'none';
                }, 5000);
            }
        } catch (error) {
            console.error('Error showing error:', error);
        }
    }

    showNotification(message) {
        try {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'language-notification';
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #4CAF50;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                z-index: 1000;
                animation: slideIn 0.3s ease;
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        } catch (error) {
            console.error('Error showing notification:', error);
        }
    }

    // Public API methods
    getCurrentLanguage() {
        return this.currentLanguage;
    }

    getSupportedLanguages() {
        return [...this.supportedLanguages];
    }

    isReady() {
        return this.isInitialized;
    }
}

// Initialize the multilingual support system
document.addEventListener('DOMContentLoaded', () => {
    window.multilingualAI = new MultilingualAISupport();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MultilingualAISupport;
}
