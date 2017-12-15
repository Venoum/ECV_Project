class Channel {
  constructor (name) {
    console.log('CHANNEL :', name)
    const t = this

    t.name = name
    t.section = document.getElementById(t.name)
    t.sectionConnected = document.querySelector('#' + t.name + '.conected')
    t.form = document.querySelector('#' + t.name + ' form')
    t.messages = document.querySelector('#' + t.name + ' .messages')

    // lance les fonctions
    t.init()
  }

  init () {
    console.log('in chanel init')
    const t = this

    // reception server
    t.fromServerSide()

    // watcher du form
    t.form.addEventListener('submit', function (e) {
      e.preventDefault()
      t.sendMessage()
    })

    // rejoind la room
    socket.emit('join.channel', t.name)
  }

  sendMessage () {
    const t = this

    let input = t.form.children[0]
    let value = input.value

    socket.emit('chat.message', {msg: value, room: t.name})
    input.value = ''
  }

  fromServerSide () {
    const t = this
    // affiche le message envoyé
    socket.on('chat.message', function (data) {
      let li = document.createElement('li')
      let p = document.createElement('p')
      let pseudo = document.createTextNode(data.pseudo + ' à dit :')
      p.classList.add('pseudo')
      p.appendChild(pseudo)
      li.appendChild(p)
      li.innerHTML += data.msg

      t.messages.appendChild(li)
    })
    // affiche le message de connexion
    socket.on('user.connect', function (msg) {
      let li = document.createElement('li')
      let p = document.createElement('p')
      let text = document.createTextNode(msg)
      p.classList.add('connect')
      p.appendChild(text)
      li.appendChild(p)

      t.messages.appendChild(li)
    })
  }
}
