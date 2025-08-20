import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/hyper-realistic-effects.css',
                'resources/css/ai-video-chat-neon.css',
                'resources/css/ai-video-chat-neon-loading.css',
                'resources/js/app.js',
                'resources/js/ai-video-chat.js',
                'resources/js/ai-video-chat-fixed.js',
                'resources/js/ai-video-chat-neon-loading.js',
                'resources/css/ai-video-chat-complete.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            output: {
                manualChunks: {
                    'three-vendor': ['three'],
                    'three-examples': [
                        'three/examples/jsm/loaders/GLTFLoader.js',
                        'three/examples/jsm/postprocessing/EffectComposer.js',
                        'three/examples/jsm/postprocessing/RenderPass.js',
                        'three/examples/jsm/postprocessing/UnrealBloomPass.js',
                        'three/examples/jsm/postprocessing/ShaderPass.js',
                        'three/examples/jsm/shaders/CopyShader.js',
                        'three/examples/jsm/shaders/LuminosityHighPassShader.js',
                    ],
                },
            },
        },
    },
});
