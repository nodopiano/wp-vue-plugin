const path = require('path')

module.exports = {
  css: {
    extract: true
  },
  pages: {
    app: {
      entry: 'src/resources/js/app/main.js',
      template: 'public/index.html',
      title: 'Javascript principale',
      filename: 'app.html'
    },
    admin: {
      entry: 'src/resources/js/admin/main.js',
      template: 'public/index.html',
      title: 'Javascript admin',
      filename: 'admin.html'
    }
  },
  chainWebpack: config => {
    config.resolve.alias.set('@', path.join(__dirname, 'src/resources/'))
    config.resolve.alias.set('@js', path.join(__dirname, 'src/resources/js/'))
    config.resolve.alias.set('@assets', path.join(__dirname, 'src/resources/assets/'))
    config.resolve.alias.set('~', path.join(__dirname, 'src/resources/'))
    config.resolve.alias.set('~js', path.join(__dirname, 'src/resources/js/'))
    config.resolve.alias.set('~assets', path.join(__dirname, 'src/resources/assets/'))
  }
}

