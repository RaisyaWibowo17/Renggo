/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                display: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                sans: ['"Inter"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                brand: {
                    50: '#EAF4FE',
                    100: '#D7EAFD',
                    200: '#AFD5FB',
                    300: '#7FBAF6',
                    400: '#4C97ED',
                    500: '#2E76DA',
                    600: '#1F5CB8',
                    700: '#194B96',
                    800: '#153C77',
                    900: '#102F5C',
                    950: '#0B2144',
                },
                sky: {
                    50: '#F3F9FF',
                    100: '#E8F3FE',
                },
                accent: {
                    amber: '#F5A524',
                    pink: '#EC5C8D',
                    green: '#22B07D',
                    purple: '#8B6BEF',
                },
            },
            boxShadow: {
                glass: '0 8px 32px -8px rgba(16, 47, 92, 0.18)',
                'glass-lg': '0 20px 45px -12px rgba(16, 47, 92, 0.28)',
                card: '0 4px 20px -4px rgba(16, 47, 92, 0.12)',
            },
            borderRadius: {
                '2xl': '1.25rem',
                '3xl': '1.75rem',
                '4xl': '2.25rem',
            },
            backdropBlur: {
                xs: '2px',
            },
        },
    },
    plugins: [],
};
