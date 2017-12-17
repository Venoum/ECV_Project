class Homepage {
  constructor () {
    console.log('HOMEPAGE')
    const t = this

    t.channels = document.getElementsByClassName('channel')
    t.userId = window.localStorage.getItem('id_user')
    t.userPseudo = window.localStorage.getItem('pseudo_user')
    window.socket = io.connect('http://localhost:8080')
    t.burger = document.querySelectorAll('.burger-c')[0]
    t.channelList = document.querySelectorAll('.channels-c')[0]
    t.btNotifs = document.querySelectorAll('.bt-notification')[0]
    t.btNotifsActions = document.querySelectorAll('#notifications .bt')
    t.notifContainer = document.querySelectorAll('.notifications-c')[0]

    t.notificationsArray = notificationsArray

    t.notifsList = new Vue({
      el: '#notifications',
      data: {
        notifs: []
      }
    })
    console.log(t.notificationsArray)
    t.init()
  }

  init () {
    console.log('homepage init')
    const t = this

    // message de connexion
    t.userConnected()

    // initialisation des channels
    t.startChannels()

    // watcher ouverture containers
    t.watchersStyle()

    // lance la partie server
    t.fromServerSide()

    // set notifs
    t.setNotifs()
    // afficher le profil
    // se déconnecter
  }

  watchersStyle () {
    const t = this

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

    // watcher channel menu
    t.burger.addEventListener('click', function () {
      if (t.channelList.classList.contains('active')) t.channelList.classList.remove('active')
      else t.channelList.classList.add('active')
      if (t.notifContainer.classList.contains('active')) t.notifContainer.classList.remove('active')
    })

    // watcher notifs menu
    t.btNotifs.addEventListener('click', function () {
      if (t.notifContainer.classList.contains('active')) t.notifContainer.classList.remove('active')
      else t.notifContainer.classList.add('active')
      if (t.channelList.classList.contains('active')) t.channelList.classList.remove('active')
    })

    // watcher button notifs
    Object.keys(t.btNotifsActions).map(function (key) {
      t.btNotifsActions[key].addEventListener('click', function () {
        let userPseudoRequest = this.getAttribute('data-user-pseudo')
        let action = this.getAttribute('data-action')
        let parentId = this.parentNode.getAttribute('id')
        window.socket.emit('notification.response', {action: action, idUserReceiver: t.userId, idUserSend: userPseudoRequest, id: parentId})
      })
    })


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

    t.channelList.classList.remove('active')
  }

  userConnected () {
    const t = this

    window.socket.emit('user.connect', t.userPseudo)
  }

  fromServerSide () {
    const t = this

    window.socket.on('notification.response', function (id) {
      console.log('reponse reçue', id)
    })
  }

  setNotifs () {
    const t = this

    console.log('in set notif', t.notificationsArray.length)

    for (let i = 0; i < t.notificationsArray.length; i++) {
      console.log(i)
      t.notifsList.notif.push({id: t.notificationsArray[i].id, pseudo: t.notificationsArray[i].pseudo, userId: t.notificationsArray[i].id_user})
    }
  }
}
