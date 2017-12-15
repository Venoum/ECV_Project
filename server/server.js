import express from 'express'
import path from 'path'
import bodyParser from 'body-parser'
import httpBase from 'http'
import ioBase from 'socket.io'
import remarkable from 'remarkable'

const app = express()
const http = httpBase.Server(app)
const io = ioBase(http)
const md = new remarkable()

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({
  extented: true
}))

io.on('connection', function (socket) {
  console.log('connect id :', socket.id)

  socket.on('join.channel', function (name) {
    console.log(name)
    socket.join(name)
  })

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo
    for (var room in socket.rooms) {
      var message = pseudo + ' a rejoint la conversation'
      socket.broadcast.to(room).emit('user.connect', message)
    }
  })

  // quand on envoi un message
  socket.on('chat.message', function (data) {
    console.log('msg', data.msg)
    let msg = md.render(data.msg)
    io.to(data.room).emit('chat.message', {msg: msg, pseudo: socket.username})
  })

  // quand se deconnecte
  socket.on('disconnect', function () {
    console.log('user non connecté - A FAIRE !!')
  })
})

http.listen(8080, () => console.log('Example app listening on port 8080!'))
