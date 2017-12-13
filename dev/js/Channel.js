class Channel {
  constructor (name) {
    console.log('CHANNEL')
    const t = this

    t.name = name
    t.section = document.getElementById(t.name)
    t.form = document.querySelector('#' + t.name + ' form')
    t.messages = document.querySelector('#' + t.name + ' .messages')


    // lance la connexion
    t.socket = io.connect('http://localhost:8080')

    // lance les fonctions
    t.init()
  }

  init () {
    console.log('in init')
    const t = this

    // affichage
    t.openChat()

    // reception server
    t.fromServerSide()

    // watcher du form
    t.form.addEventListener('submit', function (e) {
      e.preventDefault()
      t.sendMessage()
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
    t.section.classList.add('selected')
  }

  sendMessage () {
    const t = this

    let input = t.form.children[0]
    let value = input.value

    t.socket.emit('chat.message', value)
    input.value = ''
  }

  fromServerSide () {
    const t = this
    // affiche le message
    t.socket.on('chat.message', function (msg) {
      let li = document.createElement('li')
      let p = document.createElement('p')
      let value = document.createTextNode(msg)

      p.appendChild(value)
      li.appendChild(p)

      t.messages.appendChild(li)
    })
  }
}
