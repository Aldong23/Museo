import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        extend: {
            colors: {
                clr: {
                  midnight:"hsl(var(--color-midnight) / <alpha-value>)",
                  midnight1:"hsl(var(--color-midnight-1) / <alpha-value>)",
                  crimson: "hsl(var(--color-crimson) / <alpha-value>)",
                  crimson1: "hsl(var(--color-crimson-1) / <alpha-value>)",
                },
                bg: {
                  primary: "hsl(var(--color-bg-0) / <alpha-value>)",
                  secondary: "hsl(var(--color-bg-1) / <alpha-value>)",
                  tertiary: "hsl(var(--color-bg-2) / <alpha-value>)",
                },
        
                txt: {
                  primary:"hsl(var(--color-txt-primary) / <alpha-value>)",
                  secondary:"hsl(var(--color-txt-secondary) / <alpha-value>)",
                  tertiary:"hsl(var(--color-txt-tertiary) / <alpha-value>)",
                  hvr:"var(--color-txt-hvr)",
                },
        
                brdr: {
                  primary: "hsl(var(--color-border-primary) / <alpha-value>)",
                  secondary: "hsl(var(--color-border-secondary) / <alpha-value>)",
                },
        
                btn: {
                  yellow: "hsl(var(--color-btn-yellow) / <alpha-value>)",
                  hyellow: "hsl(var(--color-btn-hyellow) / <alpha-value>)",
                  red: "hsl(var(--color-btn-red) / <alpha-value>)",
                  hred: "hsl(var(--color-btn-hred) / <alpha-value>)",
                  blue: "hsl(var(--color-btn-blue) / <alpha-value>)",
                  hblue: "hsl(var(--color-btn-hblue) / <alpha-value>)",
                  green: "hsl(var(--color-btn-green) / <alpha-value>)",
                  hgreen: "hsl(var(--color-btn-hgreen) / <alpha-value>)",
                  orange: "hsl(var(--color-btn-orange) / <alpha-value>)",
                  horange: "hsl(var(--color-btn-horange) / <alpha-value>)",
                  vio: "hsl(var(--color-btn-purple) / <alpha-value>)",
                  hvio: "hsl(var(--color-btn-hpurple) / <alpha-value>)",
                }
              },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                montserrat: ['montserrat'],
            },
        },
    },
    plugins: [
      require('flowbite/plugin')
    ],
};
