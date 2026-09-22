/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './inc/**/*.php',
        './template-parts/**/*.php',
        './assets/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                'brand-blue': '#155ca8',
                'header-gray': '#eef1f3',
                'ink': '#22262a',
            },
            maxWidth: {
                'site': '90rem',
            },
            screens: {
                'lg': '67.5rem',
            },
        },
    },
    plugins: [],
};
