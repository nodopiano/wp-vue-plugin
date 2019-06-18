module.exports = {
  css: {
    extract: true
  },
  pages: {
    app: {
      entry: 'src/resources/app/main.js',
      template: 'public/index.html',
      title: 'Javascript principale',
      filename: 'app.html'
    },
    admin: {
      entry: 'src/resources/admin/main.js',
      template: 'public/index.html',
      title: 'Javascript admin',
      filename: 'admin.html'
    }
  }
}

