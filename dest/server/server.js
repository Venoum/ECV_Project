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

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var app = (0, _express2.default)();
var http = _http2.default.Server(app);
var io = (0, _socket2.default)(http);
var md = new _remarkable2.default();

app.use(_bodyParser2.default.json());
app.use(_bodyParser2.default.urlencoded({
  extented: true
}));

io.on('connection', function (socket) {
  console.log('connect id :', socket.id);

  socket.on('join.channel', function (name) {
    socket.join(name);
    console.log('join: ' + name);
  });

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo;
    for (var room in socket.rooms) {
      var message = pseudo + ' a rejoint la conversation';
      socket.broadcast.to(room).emit('user.connect', message);
    }
  });

  // quand on envoi un message
  socket.on('chat.message', function (data) {
    var msg = md.render(data.msg);
    console.log(socket.rooms[data.room]);
    io.to(socket.rooms[data.room]).emit('chat.message', { msg: msg, pseudo: socket.username, room: data.room, id: data.id });
  });

  // quand se deconnecte
  socket.on('disconnect', function () {
    console.log('user non connecté - A FAIRE !!');
  });
});

http.listen(8080, function () {
  return console.log('Example app listening on port 8080!');
});