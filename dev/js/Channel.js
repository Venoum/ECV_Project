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

    // lance init
    t.init()
  }

  init () {
    const t = this
    // fonctions liées
    t.fromServerSide()
    t.watchers()

    // rejoint la room
    window.socket.emit('join.channel', t.name)
  }

  watchers () {
    const t = this
    // // watcher du form
    // t.form.addEventListener('submit', function (e) {
    //   e.preventDefault()
    //   t.sendMessage()
    // })

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

    // boutons du formulaire
    Object.keys(t.buttons).map(function (key) {
      t.buttons[key].addEventListener('click', function () {
        var buttonName = this.getAttribute('data-button')
        document.querySelector('#' + t.name + ' .' + buttonName).click()
      })
    })

    // input
    Object.keys(t.inputFiles).map(function (key) {
      t.inputFiles[key].addEventListener('change', function () {
        console.log('in change', this)
        if (this.files && this.files[0]) {
          let inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c')
          let img = document.createElement('img')
          let div = document.createElement('div')
          div.classList.add('image')
          div.classList.add('bt-c')
          let edit = document.createElement('p')
          let editTxt = document.createTextNode('E')
          edit.classList.add('bt')
          edit.classList.add('bt-ico-fill')
          edit.classList.add('bt-bot-right')
          edit.appendChild(editTxt)

          var reader = new FileReader()
          reader.onload = function (e) {
            img.setAttribute('src', e.target.result)
            img.classList.add('preview')
          }
          reader.readAsDataURL(this.files[0])

          div.append(img)
          div.append(edit)

          inputPreviewContainer.append(div)
        }
      })
    })
  }

  sendMessage (e) {
    e.preventDefault()
    const t = this

    let input = document.getElementById(t.name + 'Input')
    let value = input.value

    window.socket.emit('chat.message', {msg: value, room: t.name, pseudo: t.userPseudo, id: t.userId})
    input.value = ''

    return false
  }

  fromServerSide () {
    const t = this

    // affiche le message envoyé pour tous les users
    window.socket.on('chat.message', function (data) {
      if (data.room === t.name) {
        // let li = document.createElement('li')
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

        t.messageList.messages.push({ content: '<p class="pseudo">' + pseudo + '</p>' + data.msg, class: classMessage })
      }
    })
    // affiche le message de connexion
    window.socket.on('user.connect', function (msg) {
      let li = document.createElement('li')
      li.classList.add('new')
      let p = document.createElement('p')
      let text = document.createTextNode(msg)
      p.classList.add('connect')
      p.appendChild(text)
      li.appendChild(p)
      t.messages.appendChild(li)
    })
  }
}
