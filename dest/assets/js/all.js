'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Channel = function () {
  function Channel(name) {
    _classCallCheck(this, Channel);

    console.log('CHANNEL :', name);
    var t = this;

    t.name = name;
    t.section = document.getElementById(t.name);
    t.sectionConnected = document.querySelector('#' + t.name + '.conected');
    t.form = document.querySelector('#' + t.name + ' form');
    t.messages = document.querySelector('#' + t.name + ' .messages');
    t.socket = io.connect('http://localhost:8080');

    // lance les fonctions
    t.init();
  }

  _createClass(Channel, [{
    key: 'init',
    value: function init() {
      console.log('in chanel init');
      var t = this;

      // reception server
      t.fromServerSide();

      // watcher du form
      t.form.addEventListener('submit', function (e) {
        e.preventDefault();
        t.sendMessage();
      });

      // rejoind la room
      t.socket.emit('join.channel', t.name);
    }
  }, {
    key: 'sendMessage',
    value: function sendMessage() {
      var t = this;

      var input = t.form.children[0];
      var value = input.value;

      t.socket.emit('chat.message', { msg: value, room: t.name });
      input.value = '';
    }
  }, {
    key: 'fromServerSide',
    value: function fromServerSide() {
      var t = this;
      // affiche le message
      t.socket.on('chat.message', function (msg) {
        var li = document.createElement('li');
        var p = document.createElement('p');
        var value = document.createTextNode(msg);

        p.appendChild(value);
        li.appendChild(p);

        t.messages.appendChild(li);
      });
    }
  }]);

  return Channel;
}();
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Homepage = function () {
  function Homepage() {
    _classCallCheck(this, Homepage);

    console.log('HOMEPAGE');
    var t = this;

    t.channels = document.getElementsByClassName('channel');

    t.init();
  }

  _createClass(Homepage, [{
    key: 'init',
    value: function init() {
      console.log('homepage init');
      var t = this;

      // initialisation des channels
      t.startChannels();

      // watcher click de mes channels
      Object.keys(t.channels).map(function (key) {
        t.channels[key].addEventListener('click', function () {
          t.name = this.getAttribute('data-name');
          t.openChat();
        });
      });

      // afficher le profil

      // se déconnecter
    }
  }, {
    key: 'startChannels',
    value: function startChannels() {
      var t = this;
      // watcher click de mes channels
      Object.keys(t.channels).map(function (key) {
        var channelName = t.channels[key].getAttribute('data-name');
        new Channel(channelName);
      });
    }
  }, {
    key: 'openChat',
    value: function openChat() {
      var t = this;

      var channelsNav = document.querySelectorAll('[data-name]');
      var channelsWindow = document.querySelectorAll('.window-chat');

      channelsNav.forEach(function (element) {
        element.classList.remove('selected');
      });

      channelsWindow.forEach(function (element) {
        element.classList.remove('selected');
      });

      var channelCurrent = document.querySelector('[data-name = ' + t.name + ']');
      channelCurrent.classList.add('selected');
      var windowCurrent = document.getElementById(t.name);
      windowCurrent.classList.add('selected');
    }
  }]);

  return Homepage;
}();
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Website = function () {
  function Website() {
    _classCallCheck(this, Website);

    var t = this;

    t.homepage = document.getElementById('chat');
    t.channels = document.getElementsByClassName('channel');
  }

  _createClass(Website, [{
    key: 'init',
    value: function init() {
      var t = this;
      console.log('website init');

      // pour la page d'accueil
      if (t.homepage) new Homepage();
    }
  }]);

  return Website;
}();
'use strict';

var socket = 'a';

// créer la classe
var website = new Website();
website.init();