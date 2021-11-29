module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false,
  theme: {
    extend: {
      margin:{
        'min-100': '-100%'
      },
      height:{
        '550': '550px',
        '600': '600px',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
