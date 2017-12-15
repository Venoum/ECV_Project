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

io.on('connection', function (socket) {
  console.log('connect id :', socket.id)

  socket.on('join.channel', function (name) {
    console.log(name)
    socket.join(name)
  })

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo
    socket.broadcast.emit('user.connect', pseudo)
    socket.emit('login.chat', pseudo)
  })

  // quand on envoi un message
  socket.on('chat.message', function (data) {
    console.log('msg', data.msg)
    io.to(data.room).emit('chat.message', data.msg)
  })

  // quand se deconnecte
  socket.on('disconnect', () => {
    console.log('a usr is disconnected')
  })
})

http.listen(8080, () => console.log('Example app listening on port 8080!'))
