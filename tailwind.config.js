const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');
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
        require('tailwindcss-named-groups'),
        plugin(function ({ addUtilities }) {
          addUtilities({
            '.bg-overlay': {
              'background': 'linear-gradient(var(--overlay-angle, 270deg), var(--overlay-colors)), var(--overlay-image)',
              'background-position': 'right',
              'background-repeat': 'no-repeat',
            },
          });
        }),
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
                'pwd_signage': "url('/icons/pwd_signage.png')",
                'login_bg': "url('/login_bg_image.jpg')",

                // image fron fronteras
                'sold_seat': "url('/icons/sold_seat.png')",
                'used_seat': "url('/icons/used_seat.png')",
                'tv': "url('/icons/tv.png')",
                'tv2': "url('/icons/tv2.png')",
                'toprightcorne1r': "url('/icons/toprightcorne1r.png')",
                'topleftcorner1': "url('/icons/topleftcorner1.png')",
                'soldagent_seat_green': "url('/icons/soldagent_seat_green.png')",
                'soldagent_seat_green': "url('/icons/soldagent_seat_green.png')",
                'soldagent_seat_yellow': "url('/icons/soldagent_seat_yellow.png')",
                'semi_occupied': "url('/icons/semi_occupied.png')",
                'selected_seat': "url('/icons/selected_seat.png')",
                'reserved_border_seat': "url('/icons/reserved_border_seat.png')",
                'reserved_seat': "url('/icons/reserved_seat.png')",
                'noboarded_seat': "url('/icons/noboarded_seat.png')",
                'inspector': "url('/icons/inspector.png')",
                'fixed_seat': "url('/icons/fixed_seat.png')",
                'expired_seat': "url('/icons/expired_seat.png')",
                'empty_space': "url('/icons/empty_space.png')",
                'ladders': "url('/icons/ladders.png')",
                'handicap': "url('/icons/handicap.png')",
                'codriver': "url('/icons/codriver.png')",
                'busmright1': "url('/icons/busmright1.png')",
                'busmleft': "url('/icons/busmleft.png')",
                'busmleft1': "url('/icons/busmleft1.png')",
                'busfront': "url('/icons/busfront.png')",
                'busfront1': "url('/icons/busfront1.png')",
                'bus5': "url('/icons/bus5.png')",
                'bus51': "url('/icons/bus51.png')",
                'bus41': "url('/icons/bus41.png')",
                'bottomrightcorner1': "url('/icons/bottomrightcorner1.png')",
                'bottomleftcorner1': "url('/icons/bottomleftcorner1.png')",
                'boarded_seat_redcoach': "url('/icons/boarded_seat_redcoach.png')",
                'boarded_seat': "url('/icons/boarded_seat.png')",
                'bar': "url('/icons/bar.png')",
                'bathroom': "url('/icons/bathroom.png')",
                'seatterrace': "url('/icons/seatterrace.png')",
                'seat': "url('/icons/seat.png')",
                'badseat': "url('/icons/badseat.png')",
                'main_driver': "url('/icons/main_driver.png')",
                'cabin': "url('/icons/cabin.png')",

            })
        },

        /**
         * https://github.com/ErickTamayo/tailwindcss-named-groups
         * Group names difened on headers
         */
        namedGroups: ['management', 'sales', 'route', 'bus', 'groups', 'configuration', 'account', 'closure', 'reportsale', 'passenger', 'route', 'billing']
    },
};
