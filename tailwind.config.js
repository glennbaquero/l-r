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

    corePlugins: {
        outline: false
    },

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
            backgroundImage: theme => ({
                'driver': "url('/icons/driver.png')",
                'seat_sold': "url('/icons/seat_sold.png')",
                'seat_selected': "url('/icons/seat_selected.png')",
                'seat_reserve': "url('/icons/seat_reserve.png')",
                'seat_available': "url('/icons/seat_available.png')",
                'seat_double_sold': "url('/icons/seat_double_sold.png')",
                'restroom': "url('/icons/restroom.png')",
                'pwd_signage': "url('/icons/pwd_signage.png')",
                'cabin': "url('/icons/cabin.png')",
                'conductor': "url('/icons/conductor.png')",
            })
        },

        /**
         * https://github.com/ErickTamayo/tailwindcss-named-groups
         * Group names difened on headers
         */
        namedGroups: ['management', 'sales', 'route', 'bus', 'groups', 'configuration', 'account', 'closure', 'reportsale', 'passenger', 'route', 'billing']
    },
};
