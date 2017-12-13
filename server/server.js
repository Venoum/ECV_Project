import express from 'express'
import path from 'path'
import bodyParser from 'body-parser'
import httpBase from 'http'
import ioBase from 'socket.io'

const app = express()
const http = httpBase.Server(app)
const io = ioBase(http)

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({
  extented: true
}))

console.log(io)

io.on('connection', function (socket) {

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo
    socket.broadcast.emit('user.connect', pseudo)
    socket.emit('login.chat', pseudo)
  })

  // quand on envoi un message
  socket.on('chat.message', function (msg) {
    socket.emit('chat.message', msg, socket.username)
  })

  // quand se deconnecte
  socket.on('disconnect', () => {
    console.log('a usr is disconnected')
  })
})

http.listen(8080, () => console.log('Example app listening on port 8080!'))
