const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                display: ['MuseoModerno', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'turquoise': 'rgb(79, 209, 197)',
                'deepgreen': 'rgba(9,114,102,255)',
                'cleomagenta': 'rgb(219,65,99)',
                'offblack': 'rgb(71,78,100)',
                'colman': 'rgb(215,163,53)',
                'github': '#6e5494',
                'linkedIn': '#0072b1',
                'neongreen': '#00FF00',
                'neonred': '#FD1C03',
                'neonpurple': '#CC00FF',
                'darkpurple': '#6E0DD0',
                'neonblue': '#0062FF'
            },
            height: {
                "01": "5px",
            },
            width: {
                "w-50-rem": "50rem",
            },
            fontSize: {
                "display": "80px",
                "mobile-display": "60px",
            },
            inset: {
                '1/10': '10%'
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
