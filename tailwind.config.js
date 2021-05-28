const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: 'media',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.rose,
                neutral: colors.gray,
                dark: colors.gray,
            },
            typography: (theme) => ({
                dark: {
                    css: [
                        {
                            color: theme('colors.neutral.300'),
                            '[class~="lead"]': {
                                color: theme('colors.neutral.300'),
                            },
                            a: {
                                color: theme('colors.primary.500'),
                                '&:hover': {
                                    color: theme('colors.primary.600'),
                                },
                            },
                            strong: {
                                color: theme('colors.neutral.300'),
                            },
                            'ol > li::before': {
                                color: theme('colors.neutral.300'),
                            },
                            'ul > li::before': {
                                backgroundColor: theme('colors.neutral.500'),
                            },
                            hr: {
                                borderColor: theme('colors.neutral.400'),
                            },
                            blockquote: {
                                color: theme('colors.neutral.200'),
                                borderLeftColor: theme('colors.neutral.500'),
                            },
                            h1: {
                                color: theme('colors.neutral.400'),
                            },
                            h2: {
                                color: theme('colors.neutral.300'),
                            },
                            h3: {
                                color: theme('colors.neutral.500'),
                            },
                            h4: {
                                color: theme('colors.neutral.500'),
                            },
                            'figure figcaption': {
                                color: theme('colors.neutral.400'),
                            },
                            code: {
                                color: theme('colors.primary.200'),
                                backgroundColor: theme('colors.neutral.700'),
                            },
                            'a code': {
                                color: theme('colors.primary.200'),
                            },
                            'code::before': {
                                content: '""'
                            },
                            'code::after': {
                                content: '""'
                            },
                            thead: {
                                color: theme('colors.primary.500'),
                                borderBottomColor: theme('colors.neutral.400'),
                            },
                            'tbody tr': {
                                borderBottomColor: theme('colors.neutral.600'),
                            },
                        },
                    ],
                },
            }),
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            typography: ['dark'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
