const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    variants: {
        extend: {
            opacity: ['disabled'],
            display: ['responsive', 'group-hover', 'group-focus'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-named-groups')
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                darkblue: '#001943',
                lightblue: '#09347D',
                lighterblue: '#2051A5',
                lightgray: '#fafafa'
            },
        },

        /**
         * https://github.com/ErickTamayo/tailwindcss-named-groups
         * Group names difened on headers
         */
        namedGroups: ['management', 'sales', 'route', 'bus', 'groups', 'configuration', 'accounts', 'closure', 'reportsale']
    },
};
