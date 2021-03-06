const plugin = require('tailwindcss/plugin')

module.exports = {
  important: true,
  theme: {
    screens: {
      'md': '640px',
      'lg': '768px',
      'xl': '1024px'
    },

    extend: {
      boxShadow: {
        light: '0 0 15px 0 rgba(255, 255, 255, .1)'
      }
    },
  },

  variants: {
    textColor: ['responsive', 'hover', 'focus', 'important', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'important', 'group-hover'],
    borderWidth: ['responsive', 'important'],
  },

  plugins: [
    plugin(function ({ addVariant }) {
      addVariant('important', ({ container }) => {
        container.walkRules(rule => {
          rule.selector = `.\\!${rule.selector.slice(1)}`
          rule.walkDecls(decl => {
            decl.important = true
          })
        })
      })
    })
  ],
}
