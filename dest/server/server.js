'use strict';

var _express = require('express');

var _express2 = _interopRequireDefault(_express);

var _path = require('path');

var _path2 = _interopRequireDefault(_path);

var _bodyParser = require('body-parser');

var _bodyParser2 = _interopRequireDefault(_bodyParser);

var _http = require('http');

var _http2 = _interopRequireDefault(_http);

var _socket = require('socket.io');

var _socket2 = _interopRequireDefault(_socket);

var _remarkable = require('remarkable');

var _remarkable2 = _interopRequireDefault(_remarkable);

var _mysql = require('mysql');

var _mysql2 = _interopRequireDefault(_mysql);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var app = (0, _express2.default)();
var http = _http2.default.Server(app);
var io = (0, _socket2.default)(http);
var md = new _remarkable2.default();

var con = _mysql2.default.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'ecvchat',
  port: '8889'
});

con.connect(function (err) {
  if (err) console.log(err);else console.log('Connected Mysql');
});

app.use(_bodyParser2.default.json());
app.use(_bodyParser2.default.urlencoded({
  extented: true
}));

io.on('connection', function (socket) {
  console.log('connect id :', socket.id);

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo;
    console.log('user', socket.username);
  });

  // message de connection
  socket.on('join.channel', function (data) {
    socket.join(data.room);
    console.log('data', data);
    socket.broadcast.emit('user.connect', { id: data.id, room: data.room, pseudo: socket.username });
  });

  // quand on envoi un message
  socket.on('chat.message', function (data) {
    console.log(socket.rooms);
    var msg = md.render(data.msg);
    var room = socket.rooms[data.room];

    // push bdd
    var idChannel = Number(data.room.replace('channel', ''));
    // faire la date comme il faut
    var date = new Date();
    var todayHour = date.getHours();
    var todayMinutes = date.getMinutes();
    var sql = "INSERT INTO messages (msg_id_channel, msg_id_user, msg_content, msg_date) VALUES ('" + idChannel + "', '" + data.id + "', '" + msg + "', '" + (todayHour + ':' + todayMinutes) + "')";
    con.query(sql, function (err, result) {
      console.log('requet sql');
      // TODO : envoyer message erreur côté client
      if (err) console.log(err);
      // si ok on envoie le message
      else {
          console.log('pas derreur', room);
          io.to(room).emit('chat.message', { msg: msg, pseudo: socket.username, room: data.room, id: data.id, idMessage: result.insertId });
        }
    });
  });

  // quand se deconnecte
  socket.on('disconnect', function () {
    console.log('user non connecté - A FAIRE !!');
  });
});

http.listen(8080, function () {
  return console.log('Example app listening on port 8080!');
});