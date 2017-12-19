import express from 'express'
import path from 'path'
import bodyParser from 'body-parser'
import httpBase from 'http'
import ioBase from 'socket.io'
import remarkable from 'remarkable'
import mysql from 'mysql'
import escapeStringRegexp from 'escape-string-regexp'

const app = express()
const http = httpBase.Server(app)
const io = ioBase(http)
const md = new remarkable()

const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'ecvchat',
  port: '8889'
})

con.connect(function (err) {
  if (err) console.log(err)
  else console.log('Connected Mysql')
})

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({
  extented: true
}))

io.on('connection', function (socket) {
  console.log('connect id :', socket.id)

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo
    console.log('user', socket.username)

    // ajout identifiant mysql
    let sql = 'UPDATE users SET us_socket_id = "' + socket.id + '" WHERE us_pseudo = "' + socket.username + '"'
    con.query(sql, function (err, result) {
      // TODO : envoyer message erreur côté client
      if (err) console.log(err)
    })
  })

  // message de connection
  socket.on('join.channel', function (data) {
    socket.join(data.room)
    console.log('data', data)
    socket.broadcast.emit('user.connect', {id: data.id, room: data.room, pseudo: socket.username})
  })

  // quand on envoi un message
  socket.on('chat.message', function (data) {
    console.log(socket.rooms)
    let msg = md.render(data.msg)
    let room = socket.rooms[data.room]

    // push bdd
    let idChannel = Number(data.room.replace('channel', ''))
    let date = new Date()
    let todayHour = date.getHours()
    let todayMinutes = date.getMinutes()
    let message = '<div class=\'bubble\'>' + msg + '</div>'
    let sql = 'INSERT INTO messages (msg_id_channel, msg_id_user, msg_content, msg_date) VALUES ("' + idChannel + '", "' + data.id + '", "' + message + '", "' + (todayHour + ' : ' + todayMinutes) + '")'
    con.query(sql, function (err, result) {
      // TODO : envoyer message erreur côté client
      if (err) console.log(err)
      // si ok on envoie le message
      else {
        io.to(room).emit('chat.message', {msg: msg, pseudo: socket.username, room: data.room, id: data.id, idMessage: result.insertId})
      }
    })
  })

  // reponse à une notification
  socket.on('notification.response', function (data) {
    let sql = 'UPDATE friends SET fr_status = "' + data.action + '" WHERE fr_id_user_send = "' + data.idUserSend + '" AND fr_id_user_receiver = "' + data.idUserReceiver + '"'
    con.query(sql, function (err, result) {
      // TODO : envoyer message erreur côté client
      if (err) console.log(err)
      // si ok on envoie le message
      else {
        io.to(socket.id).emit('notification.response', data.id)
      }
    })
  })

  // quand se deconnecte
  socket.on('disconnect', function () {
    // effacer le socket
    let sql = 'UPDATE users SET us_socket_id = 0 WHERE us_pseudo = "' + socket.username + '"'
    con.query(sql, function (err, result) {
      // TODO : envoyer message erreur côté client
      if (err) console.log(err)
      else console.log('user déconnecté')
    })
  })
})

http.listen(8080, () => console.log('Example app listening on port 8080!'))
