import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                neon: {
                    50: '#fff1f2',
                    100: '#ffe4e6',
                    200: '#fecdd3',
                    300: '#fda4af',
                    400: '#fb7185',
                    500: '#f43f5e',
                    600: '#e11d48',
                    700: '#be123c',
                    800: '#9f1239',
                    900: '#881337',
                    950: '#4c0519',
                    DEFAULT: '#ff003c', // Bright Neon Red
                },
                dark: {
                    900: '#0f0505', // Very dark red-black
                    800: '#1a0a0a',
                }
            },
            boxShadow: {
                'neon': '0 0 5px theme("colors.neon.DEFAULT"), 0 0 20px theme("colors.neon.DEFAULT")',
                'neon-strong': '0 0 10px theme("colors.neon.DEFAULT"), 0 0 40px theme("colors.neon.DEFAULT"), 0 0 80px theme("colors.neon.DEFAULT")',
            },
            dropShadow: {
                'neon': '0 0 10px rgba(255, 0, 60, 0.75)',
            }
        },
    },

    plugins: [forms],
};
