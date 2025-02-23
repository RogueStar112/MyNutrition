import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        "./node_modules/flowbite/**/*.js",
        './resources/views/**/*.blade.php',
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            animation: {
                'gradient': 'gradient 10s linear infinite',
                'loadingai': 'gradient 1s linear infinite',
            },

            keyframes: {
                'gradient': {
                  to: { 'background-position': '200% center' },
                },
                'loadingai': {
                  to: { 'background-position': '200% center' },
                },
              },  


            dropShadow: {
                glow: [
                "0 0px 20px rgba(255,255, 255, 0.35)",
                "0 0px 65px rgba(255, 255,255, 0.2)"
                ]
            }

        },

        
    },



    plugins: [forms, require('flowbite/plugin')],
};
