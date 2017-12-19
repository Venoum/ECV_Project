class Homepage {
  constructor () {
    console.log('HOMEPAGE')
    const t = this

    t.channels = document.getElementsByClassName('channel')
    t.userId = window.localStorage.getItem('id_user')
    t.userPseudo = window.localStorage.getItem('pseudo_user')
    window.socket = io.connect('http://localhost:8080')
    t.channelList = document.querySelectorAll('.channels-c')[0]
    t.btNotifs = document.querySelectorAll('.bt-notification')[0]
    t.notifContainer = document.querySelectorAll('.notifications-c')[0]
    t.notificationsArray = notificationsArray
    t.number = document.querySelectorAll('.bt-notification .number p')[0]
    t.btSubmitForm = document.querySelectorAll('.nav-second form .bt-submit')

    t.notifsList = new Vue({
      el: '#notifications',
      data: {
        notifs: []
      }
    })

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

  // watcherButtonsNotif () {
  //   const t = this
  //
  //   console.log('in watch')
  //   let buttons = document.querySelectorAll('#notifications .bt')
  //   console.log(buttons)
  //   // watcher button notifs
  //   Object.keys(buttons).map(function (key) {
  //     buttons[key].addEventListener('click', function () {
  //       let userPseudoRequest = this.getAttribute('data-user-pseudo')
  //       let action = this.getAttribute('data-action')
  //       let parentId = this.parentNode.getAttribute('id')
  //       window.socket.emit('notification.response', {action: action, idUserReceiver: t.userId, idUserSend: userPseudoRequest, id: parentId})
  //     })
  //   })
  // }

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

    // watcher notifs menu
    t.btNotifs.addEventListener('click', function () {
      if (t.notifContainer.classList.contains('active')) t.notifContainer.classList.remove('active')
      else t.notifContainer.classList.add('active')
      if (t.channelList.classList.contains('active')) t.channelList.classList.remove('active')
    })

    // watcher form
    Object.keys(t.btSubmitForm).map(function (key) {
      t.btSubmitForm[key].addEventListener('click', function () {
        let formId = this.getAttribute('data-form')
        let form = document.getElementById(formId)
        let button = form.querySelectorAll('button')[0]
        let inputValue = this.parentNode.querySelectorAll('input')[0].value
        if (inputValue !== '') button.click()
        return false
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
      let index = t.notifsList.notifs.map(function (e) { return e.id }).indexOf('3')
      t.notifsList.notifs.splice(index, 1)

      // reset le nombre de notifs
      t.setNumberNotif()
      //
    })
  }

  setNotifs () {
    const t = this

    for (let i = 0; i < t.notificationsArray.length; i++) {
      t.notifsList.notifs.push({id: t.notificationsArray[i].id, pseudo: t.notificationsArray[i].pseudo, userId: t.notificationsArray[i].id_user})
    }

    // t.buttonsActionNotif = new Vue({
    //   el: '.bt-action',
    //   methods: {
    //     action: function () {
    //       console.log('in action')
    //       let userPseudoRequest = this.getAttribute('data-user-pseudo')
    //       let action = this.getAttribute('data-action')
    //       let parentId = this.parentNode.getAttribute('id')
    //       // window.socket.emit('notification.response', {action: action, idUserReceiver: t.userId, idUserSend: userPseudoRequest, id: parentId})
    //     }
    //   }
    // })

    // t.watcherButtonsNotif()
    t.setNumberNotif()
  }

  setNumberNotif () {
    const t = this

    let number = t.notifsList.notifs.length
    t.number.innerHTML = number
  }
}
