// tailwind.config.js

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // Standard Laravel view path
        './resources/**/*.blade.php', 
        
        // Standard Laravel JS path
        './resources/**/*.js',
        
        // Add any other files that contain Tailwind classes
    ],
    theme: {
        extend: {
            // Your custom theme settings, including the font
            fontFamily: {
                sans: ['"Instrument Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};