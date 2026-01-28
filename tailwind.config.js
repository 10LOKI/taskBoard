/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.{blade.php,js}",
        "./resources/js/**/*.{js,jsx,ts,tsx}",
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                secondary: {
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                    950: '#030712',
                },
            },

            fontFamily: {
                sans: ['Figtree', 'system-ui', 'sans-serif'],
            },

            fontSize: {
                xs: ['0.75rem', { lineHeight: '1rem' }],
                sm: ['0.875rem', { lineHeight: '1.25rem' }],
                base: ['1rem', { lineHeight: '1.5rem' }],
                lg: ['1.125rem', { lineHeight: '1.75rem' }],
                xl: ['1.25rem', { lineHeight: '1.75rem' }],
                '2xl': ['1.5rem', { lineHeight: '2rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
            },

            spacing: {
                '4.5': '1.125rem',
                '5.5': '1.375rem',
            },

            borderRadius: {
                'xl': '0.75rem',
                '2xl': '1rem',
                '3xl': '1.5rem',
            },

            boxShadow: {
                'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
                'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                'inner': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.05)',
                'none': 'none',
                'glass': '0 8px 32px rgba(31, 38, 135, 0.37)',
            },

            animation: {
                'fadeIn': 'fadeIn 0.5s ease-out',
                'slideInRight': 'slideInRight 0.5s ease-out',
                'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
                'bounce-slow': 'bounce 3s infinite',
            },

            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInRight: {
                    '0%': { opacity: '0', transform: 'translateX(-20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                'pulse-soft': {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.5' },
                },
            },

            transitionDuration: {
                '200': '200ms',
                '300': '300ms',
                '400': '400ms',
                '500': '500ms',
            },

            backdropBlur: {
                'xs': '2px',
            },

            opacity: {
                '5': '0.05',
                '10': '0.1',
                '15': '0.15',
            },
        },
    },

    plugins: [
        // Custom plugin pour les gradients
        function ({ addUtilities }) {
            const newUtilities = {
                '.bg-gradient-glass': {
                    'background': 'linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05))',
                    'backdrop-filter': 'blur(10px)',
                },
                '.text-gradient': {
                    'background': 'linear-gradient(135deg, #3b82f6, #1e40af)',
                    '-webkit-background-clip': 'text',
                    '-webkit-text-fill-color': 'transparent',
                    'background-clip': 'text',
                },
                '.shadow-inner-lg': {
                    'box-shadow': 'inset 0 10px 20px rgba(0, 0, 0, 0.1)',
                },
            }
            addUtilities(newUtilities)
        },
    ],
}
