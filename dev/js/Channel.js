class Channel {
  constructor (name) {
    const t = this

    t.name = name
    t.section = document.getElementById(t.name)
    t.sectionConnected = document.querySelector('#' + t.name + '.conected')
    t.formElement = document.querySelector('#' + t.name + ' form')
    t.messages = document.getElementById(t.name + 'Message')
    t.buttons = document.querySelectorAll('#' + t.name + ' form .message-button')
    t.inputFiles = document.querySelectorAll('#' + t.name + ' form .hidden input')
    t.inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c')

    t.userId = window.localStorage.getItem('id_user')
    t.userPseudo = window.localStorage.getItem('pseudo_user')

    t.arrowBack = document.querySelectorAll('section .container-title .back')

    t.ajaxUrl = 'http://localhost:8888/ECVDigital/Workshop/dest/controller/AjaxRequests.php'
    // lance init
    t.init()
  }

  init () {
    const t = this

    // rejoint la room
    console.log('emit', t.name)
    window.socket.emit('join.channel', {id: t.userId, room: t.name})
    // fonctions liées
    t.fromServerSide()
    t.watchers()

    // charge les derniers messages
    t.loadMessage()
  }

  watchers () {
    const t = this
    t.form = new Vue({
      el: t.formElement,
      methods: {
        sendMessage: t.sendMessage.bind(t)
      }
    })

    t.messageList = new Vue({
      el: '#' + t.name + 'Message',
      data: {
        messages: []
      }
    })

    t.loadMessages = new Vue({
      el: '#' + t.name + ' .more-messages',
      methods: {
        loadMessages: t.loadMessage.bind(t)
      }
    })

    // boutons du formulaire envoi message
    Object.keys(t.buttons).map(function (key) {
      t.buttons[key].addEventListener('click', function () {
        var buttonName = this.getAttribute('data-button')
        document.querySelector('#' + t.name + ' .' + buttonName).click()
      })
    })

    // arrow back channel
    Object.keys(t.arrowBack).map(function (key) {
      t.arrowBack[key].addEventListener('click', function () {
        // remove class selected reviens au menu
        let sectionSelected = document.querySelectorAll('section.selected')[0]
        console.log(sectionSelected)
        sectionSelected.classList.remove('selected')
      })
    })

    //
    // NE PAS EFFACER AJOUT PHOTO
    // TODO : envoi photo + canvas
    //
    // // input
    // Object.keys(t.inputFiles).map(function (key) {
    //   t.inputFiles[key].addEventListener('change', function () {
    //     console.log('in change', this)
    //     if (this.files && this.files[0]) {
    //       let inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c')
    //       let img = document.createElement('img')
    //       let div = document.createElement('div')
    //       div.classList.add('image')
    //       div.classList.add('bt-c')
    //       let edit = document.createElement('p')
    //       let editTxt = document.createTextNode('E')
    //       edit.classList.add('bt')
    //       edit.classList.add('bt-ico-fill')
    //       edit.classList.add('bt-bot-right')
    //       edit.appendChild(editTxt)
    //
    //       var reader = new FileReader()
    //       reader.onload = function (e) {
    //         img.setAttribute('src', e.target.result)
    //         img.classList.add('preview')
    //       }
    //       reader.readAsDataURL(this.files[0])
    //
    //       div.append(img)
    //       div.append(edit)
    //
    //       inputPreviewContainer.append(div)
    //     }
    //   })
    // })
  }

  sendMessage (e) {
    e.preventDefault()
    const t = this

    let input = document.getElementById(t.name + 'Input')
    let value = input.value

    window.socket.emit('chat.message', {msg: value, room: t.name, id: t.userId})
    input.value = ''

    return false
  }

  fromServerSide () {
    const t = this

    // affiche le message envoyé pour tous les users
    window.socket.on('chat.message', function (data) {
      if (data.room === t.name) {
        let classMessage = null
        if (data.id === t.userId) {
          classMessage = 'sent'
        } else {
          classMessage = 'received'
        }

        let pseudo = null
        if (data.pseudo === t.userPseudo) {
          pseudo = 'vous :'
        } else {
          pseudo = data.pseudo + ' :'
        }

        t.addMessage({pseudo: pseudo, messageContent: data.msg, messageId: data.idMessage, class: classMessage})
      }
    })
    // affiche le message de connexion
    window.socket.on('user.connect', function (data) {
      if (data.room === t.name && data.id !== t.userId) {
        let classMessage = 'new'
        let pseudo = data.pseudo

        t.messageList.messages.push({ content: '<p>' + pseudo + ' est connecté</p>', class: classMessage })
      }
    })
  }

  addMessage (data) {
    const t = this

    let content = '<p class="pseudo"> ' + data.pseudo + ' </p><div class="bubble">' + data.messageContent + '</div>'
    let idChannel = t.getChannelName()
    t.messageList.messages.push({ content: content, class: data.class, idMessage: data.idMessage, idChannel: idChannel })
  }

  loadMessage () {
    const t = this

    console.log('in load')

    let channelId = t.getChannelName()

    let dataToSend = {
      nbMessagesLoad: 10,
      idChannel: channelId
    }

    let firstMessage = document.querySelectorAll('#' + t.name + ' li:first-child')
    if (firstMessage.length) {
      let firstMessageId = firstMessage[0].getAttribute('data-id-message')
      dataToSend.idLastMessage = Number(firstMessageId)
    }

    $.ajax({
      url: t.ajaxUrl + '?action=load_more',
      type: 'POST',
      data: dataToSend,
      success: function (data) {
        let response = JSON.parse(data)
        console.log(response.status, t.name)
        if (response.status === 'ok') {
          let messages = response.content
          for (var message of messages) {
            let className = (message.user === t.userPseudo) ? 'sent' : 'received'
            let pseudo = (message.user === t.userPseudo) ? 'vous' : message.user
            let content = '<p class="pseudo">' + pseudo + ' : </p>' + message.content
            t.messageList.messages.unshift({ content: content, class: className, idMessage: message.id, idChannel: channelId })
          }
        }
        if ((response.status === 'ok' && !response.more) || response.status === 'vide') {
          let buttonMessage = document.querySelectorAll('#' + t.name + ' .more-messages')
          buttonMessage[0].style.display = 'none'
        }
      },
      error: function (err) {
        console.log(err)
      }
    })
  }

  getChannelName () {
    const t = this
    return Number(t.name.replace('channel', ''))
  }
}
