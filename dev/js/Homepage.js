class Homepage {
  constructor () {
    console.log('HOMEPAGE')
    const t = this

    t.channels = document.getElementsByClassName('channel')

    t.init()
  }

  init () {
    console.log('in init')
    const t = this

    // watcher click de mes channels
    Object.keys(t.channels).map(function (key) {
      t.channels[key].addEventListener('click', function () {
        let channelName = this.getAttribute('data-name')
        new Channel(channelName)
      })
    })

    // afficher le profil

    // se déconnecter
  }
}
