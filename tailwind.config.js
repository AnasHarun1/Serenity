import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    // 1. AKTIFKAN DARK MODE
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                // 2. GANTI FONT KE 'Plus Jakarta Sans' (Agar sesuai desain mewah)
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palet diambil dari Referensi User (Vibrant Earth)
                sage: {
                    50: '#f2f7f2',
                    100: '#e1ebe1',
                    200: '#c5d9c5',
                    300: '#9ebf9e',
                    400: '#95B365', // Olive Green (Reference)
                    500: '#759448',
                    600: '#5c7538',
                    700: '#4a5e2d',
                    800: '#3d4d27',
                    900: '#334023',
                    950: '#1a2612',
                },
                terracotta: {
                    50: '#fff5f0',
                    100: '#ffe8de',
                    200: '#ffd3bf',
                    300: '#ffb599',
                    400: '#FF8A5C', // Vibrant Orange/Salmon (Reference)
                    500: '#f05e35',
                    600: '#db441d',
                    700: '#b53215',
                    800: '#942b14',
                    900: '#7a2614',
                    950: '#4a1208',
                },
                beige: {
                    50: '#fbfbf9',
                    100: '#f7f7f3',
                    200: '#f0f0e6',
                    300: '#e6e6d1',
                    400: '#d9d9b8',
                    500: '#FAFAF5', // Warm White (Reference Background)
                    600: '#d1d1c7',
                    700: '#a8a89f',
                    800: '#85857e',
                    900: '#42423e',
                    950: '#262624',
                },
                earth: {
                    50: '#f6f4f2',
                    100: '#ebe6e1',
                    200: '#d6cec5',
                    300: '#beafa3',
                    400: '#a38f82',
                    500: '#8a766a',
                    600: '#6e5e55',
                    700: '#544741',
                    800: '#362214', // Deep Brown (Reference Text/Dark BG)
                    900: '#2b1b10',
                    950: '#1a0f08',
                },
            },
            // 3. Tambahan Animasi (Agar build assets mendukung animasi blob kita)
            animation: {
                blob: "blob 7s infinite",
                "fade-in": "fadeIn 0.5s ease-out forwards",
            },
            keyframes: {
                blob: {
                    "0%": { transform: "translate(0px, 0px) scale(1)" },
                    "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                    "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                    "100%": { transform: "translate(0px, 0px) scale(1)" },
                },
                fadeIn: {
                    "0%": { opacity: "0", transform: "translateY(10px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
            },
        },
    },

    plugins: [forms],
};
