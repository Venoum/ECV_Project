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

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var app = (0, _express2.default)();
var http = _http2.default.Server(app);
var io = (0, _socket2.default)(http);

app.use(_bodyParser2.default.json());
app.use(_bodyParser2.default.urlencoded({
  extented: true
}));

io.on('connection', function (socket) {

  // ajout d'un utilisateur
  socket.on('user.connect', function (pseudo) {
    socket.username = pseudo;
    socket.broadcast.emit('user.connect', pseudo);
    socket.emit('login.chat', pseudo);
  });

  // quand on envoi un message
  socket.on('chat.message', function (msg) {
    socket.emit('chat.message', msg, socket.username);
  });

  // quand se deconnecte
  socket.on('disconnect', function () {
    console.log('a usr is disconnected');
  });
});

http.listen(8080, function () {
  return console.log('Example app listening on port 8080!');
});