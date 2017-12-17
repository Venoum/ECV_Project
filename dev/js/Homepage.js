class Homepage {
  constructor () {
    console.log('HOMEPAGE')
    const t = this

    t.channels = document.getElementsByClassName('channel')
    t.userPseudo = window.localStorage.getItem('pseudo_user')
    window.socket = io.connect('http://localhost:8080')
    t.burger = document.querySelectorAll('.burger-c')[0]
    t.nav = document.querySelectorAll('nav')[0]

    t.init()
  }

  init () {
    console.log('homepage init')
    const t = this

    // message de connexion
    t.userConnected()

    // initialisation des channels
    t.startChannels()

    // watcher menu
    t.burger.addEventListener('click', function () {
      if (t.nav.classList.contains('active')) t.nav.classList.remove('active')
      else t.nav.classList.add('active')
    })

    // watcher click de mes channels
    Object.keys(t.channels).map(function (key) {
      t.channels[key].addEventListener('click', function () {
        // enleve les class
        Object.keys(t.channels).map(function (key) {
          t.channels[key].classList.remove('selected')
        })
        this.classList.add('selected')
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

    t.nav.classList.remove('active')
  }

  userConnected () {
    const t = this

    window.socket.emit('user.connect', t.userPseudo)
  }
}
