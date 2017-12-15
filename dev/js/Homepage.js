class Homepage {
  constructor () {
    console.log('HOMEPAGE')
    const t = this

    t.channels = document.getElementsByClassName('channel')

    t.init()
  }

  init () {
    console.log('homepage init')
    const t = this

    // initialisation des channels
    t.startChannels()

    // watcher click de mes channels
    Object.keys(t.channels).map(function (key) {
      t.channels[key].addEventListener('click', function () {
        t.name = this.getAttribute('data-name')
        t.openChat()
      })
    })

    // afficher le profil

    // se déconnecter
  }

  startChannels () {
    const t = this
    // watcher click de mes channels
    Object.keys(t.channels).map(function (key) {
      let channelName = t.channels[key].getAttribute('data-name')
      new Channel(channelName)
    })
  }

  openChat () {
    const t = this

    let channelsNav = document.querySelectorAll('[data-name]')
    let channelsWindow = document.querySelectorAll('.window-chat')

    channelsNav.forEach(function (element) {
      element.classList.remove('selected')
    })

    channelsWindow.forEach(function (element) {
      element.classList.remove('selected')
    })

    let channelCurrent = document.querySelector('[data-name = ' + t.name + ']')
    channelCurrent.classList.add('selected')
    let windowCurrent = document.getElementById(t.name)
    windowCurrent.classList.add('selected')

  }
}
