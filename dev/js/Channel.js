class Channel {
  constructor (name) {
    const t = this

    t.name = name
    t.section = document.getElementById(t.name)
    t.sectionConnected = document.querySelector('#' + t.name + '.conected')
    t.form = document.querySelector('#' + t.name + ' form')
    t.messages = document.querySelector('#' + t.name + ' .messages')
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
    // watcher du form
    t.form.addEventListener('submit', function (e) {
      e.preventDefault()
      t.sendMessage()
    })

    // t.form = new Vue({
    //   el: t.formElement,
    //   methods: {
    //     sendMessage: t.sendMessage.bind(t)
    //   }
    // })

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

  sendMessage () {
    const t = this

    let input = t.form.querySelector('.message')
    let value = input.value

    window.socket.emit('chat.message', {msg: value, room: t.name, pseudo: t.userPseudo, id: t.userId})
    input.value = ''

    return false
  }

  fromServerSide () {
    const t = this

    // affiche le message envoyé pour tous les users
    window.socket.on('chat.message', function (data) {
      console.log('ok')
      if (data.room === t.name) {
        let li = document.createElement('li')
        if (data.id === t.userId) {
          li.classList.add('sent')
        } else {
          li.classList.add('received')
        }

        let p = document.createElement('p')
        let pseudo = null
        if (data.pseudo === t.userPseudo) {
          pseudo = document.createTextNode('vous avez dit :')
        } else {
          pseudo = document.createTextNode(data.pseudo + ' a dit :')
        }
        p.classList.add('pseudo')
        p.appendChild(pseudo)
        li.appendChild(p)
        li.innerHTML += data.msg

        t.messages.appendChild(li)
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
