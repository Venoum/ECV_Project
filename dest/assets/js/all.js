'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Channel = function () {
  function Channel(name) {
    _classCallCheck(this, Channel);

    var t = this;

    t.name = name;
    t.section = document.getElementById(t.name);
    t.sectionConnected = document.querySelector('#' + t.name + '.conected');
    t.form = document.querySelector('#' + t.name + ' form');
    t.messages = document.querySelector('#' + t.name + ' .messages');
    t.buttons = document.querySelectorAll('#' + t.name + ' form .message-button');
    t.inputFiles = document.querySelectorAll('#' + t.name + ' form .hidden input');
    t.inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c');

    t.userId = window.localStorage.getItem('id_user');
    t.userPseudo = window.localStorage.getItem('pseudo_user');

    // lance init
    t.init();
  }

  _createClass(Channel, [{
    key: 'init',
    value: function init() {
      var t = this;
      // fonctions liées
      t.fromServerSide();
      t.watchers();

      // rejoint la room
      window.socket.emit('join.channel', t.name);
    }
  }, {
    key: 'watchers',
    value: function watchers() {
      var t = this;
      // watcher du form
      t.form.addEventListener('submit', function (e) {
        e.preventDefault();
        t.sendMessage();
      });

      // t.form = new Vue({
      //   el: t.formElement,
      //   methods: {
      //     sendMessage: t.sendMessage.bind(t)
      //   }
      // })

      // boutons du formulaire
      Object.keys(t.buttons).map(function (key) {
        t.buttons[key].addEventListener('click', function () {
          var buttonName = this.getAttribute('data-button');
          document.querySelector('#' + t.name + ' .' + buttonName).click();
        });
      });

      // input
      Object.keys(t.inputFiles).map(function (key) {
        t.inputFiles[key].addEventListener('change', function () {
          console.log('in change', this);
          if (this.files && this.files[0]) {
            var inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c');
            var img = document.createElement('img');
            var div = document.createElement('div');
            div.classList.add('image');
            div.classList.add('bt-c');
            var edit = document.createElement('p');
            var editTxt = document.createTextNode('E');
            edit.classList.add('bt');
            edit.classList.add('bt-ico-fill');
            edit.classList.add('bt-bot-right');
            edit.appendChild(editTxt);

            var reader = new FileReader();
            reader.onload = function (e) {
              img.setAttribute('src', e.target.result);
              img.classList.add('preview');
            };
            reader.readAsDataURL(this.files[0]);

            div.append(img);
            div.append(edit);

            inputPreviewContainer.append(div);
          }
        });
      });
    }
  }, {
    key: 'sendMessage',
    value: function sendMessage() {
      var t = this;

      var input = t.form.querySelector('.message');
      var value = input.value;

      window.socket.emit('chat.message', { msg: value, room: t.name, pseudo: t.userPseudo, id: t.userId });
      input.value = '';

      return false;
    }
  }, {
    key: 'fromServerSide',
    value: function fromServerSide() {
      var t = this;

      // affiche le message envoyé pour tous les users
      window.socket.on('chat.message', function (data) {
        console.log('id user', t.userId);
        if (data.room === t.name) {
          var li = document.createElement('li');
          if (data.id === t.userId) {
            li.classList.add('sent');
          } else {
            li.classList.add('received');
          }

          var p = document.createElement('p');
          var pseudo = null;
          if (data.pseudo === t.userPseudo) {
            pseudo = document.createTextNode('vous avez dit :');
          } else {
            pseudo = document.createTextNode(data.pseudo + ' a dit :');
          }
          p.classList.add('pseudo');
          p.appendChild(pseudo);
          li.appendChild(p);
          li.innerHTML += data.msg;

          t.messages.appendChild(li);
        }
      });
      // affiche le message de connexion
      window.socket.on('user.connect', function (msg) {
        var li = document.createElement('li');
        li.classList.add('new');
        var p = document.createElement('p');
        var text = document.createTextNode(msg);
        p.classList.add('connect');
        p.appendChild(text);
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
    t.userPseudo = window.localStorage.getItem('pseudo_user');
    window.socket = io.connect('http://localhost:8080');

    t.init();
  }

  _createClass(Homepage, [{
    key: 'init',
    value: function init() {
      console.log('homepage init');
      var t = this;

      // initialisation des channels
      t.startChannels();

      // message de connexion
      t.userConnected();

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
  }, {
    key: 'userConnected',
    value: function userConnected() {
      var t = this;

      socket.emit('user.connect', t.userPseudo);
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
"use strict";

// créer la classe
var website = new Website();
website.init();