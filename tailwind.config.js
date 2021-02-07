module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            typography: {
                DEFAULT: {
                    css: {
                        'pre code': {
                            backgroundColor: 'transparent',
                        },
                    },
                },
            },
            colors: {
                orange: {
                    100: '#fffaf0',
                    200: '#feebc8',
                    300: '#fbd38d',
                    400: '#f6ad55',
                    500: '#ed8936',
                    600: '#dd6b20',
                    700: '#c05621',
                    800: '#9c4221',
                    900: '#7b341e',
                },
            },
            minHeight: {
                64: '16rem',
                96: '24rem'
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
