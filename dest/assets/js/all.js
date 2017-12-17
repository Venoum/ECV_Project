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
    t.formElement = document.querySelector('#' + t.name + ' form');
    t.messages = document.getElementById(t.name + 'Message');
    t.buttons = document.querySelectorAll('#' + t.name + ' form .message-button');
    t.inputFiles = document.querySelectorAll('#' + t.name + ' form .hidden input');
    t.inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c');

    t.userId = window.localStorage.getItem('id_user');
    t.userPseudo = window.localStorage.getItem('pseudo_user');

    t.ajaxUrl = 'http://localhost:8888/ECVDigital/Workshop/dest/controller/AjaxRequests.php';
    // lance init
    t.init();
  }

  _createClass(Channel, [{
    key: 'init',
    value: function init() {
      var t = this;

      // rejoint la room
      console.log('emit', t.name);
      window.socket.emit('join.channel', { id: t.userId, room: t.name });
      // fonctions liées
      t.fromServerSide();
      t.watchers();

      // charge les denriers messages
      t.loadMessage();
    }
  }, {
    key: 'watchers',
    value: function watchers() {
      var t = this;
      t.form = new Vue({
        el: t.formElement,
        methods: {
          sendMessage: t.sendMessage.bind(t)
        }
      });

      t.messageList = new Vue({
        el: '#' + t.name + 'Message',
        data: {
          messages: []
        }
      });

      t.loadMessages = new Vue({
        el: '#' + t.name + ' .more-messages',
        methods: {
          loadMessages: t.loadMessage.bind(t)
        }
      });

      // boutons du formulaire
      Object.keys(t.buttons).map(function (key) {
        t.buttons[key].addEventListener('click', function () {
          var buttonName = this.getAttribute('data-button');
          document.querySelector('#' + t.name + ' .' + buttonName).click();
        });
      });

      //
      // NE PAS EFFACER AJOUT PHOTO
      // TODO : envoi photo + canvas
      //
      // // input
      // Object.keys(t.inputFiles).map(function (key) {
      //   t.inputFiles[key].addEventListener('change', function () {
      //     console.log('in change', this)
      //     if (this.files && this.files[0]) {
      //       let inputPreviewContainer = document.querySelector('#' + t.name + ' form .message-c .images-c')
      //       let img = document.createElement('img')
      //       let div = document.createElement('div')
      //       div.classList.add('image')
      //       div.classList.add('bt-c')
      //       let edit = document.createElement('p')
      //       let editTxt = document.createTextNode('E')
      //       edit.classList.add('bt')
      //       edit.classList.add('bt-ico-fill')
      //       edit.classList.add('bt-bot-right')
      //       edit.appendChild(editTxt)
      //
      //       var reader = new FileReader()
      //       reader.onload = function (e) {
      //         img.setAttribute('src', e.target.result)
      //         img.classList.add('preview')
      //       }
      //       reader.readAsDataURL(this.files[0])
      //
      //       div.append(img)
      //       div.append(edit)
      //
      //       inputPreviewContainer.append(div)
      //     }
      //   })
      // })
    }
  }, {
    key: 'sendMessage',
    value: function sendMessage(e) {
      e.preventDefault();
      var t = this;

      var input = document.getElementById(t.name + 'Input');
      var value = input.value;

      window.socket.emit('chat.message', { msg: value, room: t.name, id: t.userId });
      input.value = '';

      return false;
    }
  }, {
    key: 'fromServerSide',
    value: function fromServerSide() {
      var t = this;

      // affiche le message envoyé pour tous les users
      window.socket.on('chat.message', function (data) {
        if (data.room === t.name) {
          var classMessage = null;
          if (data.id === t.userId) {
            classMessage = 'sent';
          } else {
            classMessage = 'received';
          }

          var pseudo = null;
          if (data.pseudo === t.userPseudo) {
            pseudo = 'vous :';
          } else {
            pseudo = data.pseudo + ' :';
          }

          t.addMessage({ pseudo: pseudo, messageContent: data.msg, messageId: data.idMessage, class: classMessage });
        }
      });
      // affiche le message de connexion
      window.socket.on('user.connect', function (data) {
        if (data.room === t.name && data.id !== t.userId) {
          var classMessage = 'new';
          var pseudo = data.pseudo;

          t.messageList.messages.push({ content: '<p>' + pseudo + ' est connecté</p>', class: classMessage });
        }
      });
    }
  }, {
    key: 'addMessage',
    value: function addMessage(data) {
      var t = this;

      var content = '<p class="pseudo">' + data.pseudo + ' : </p>' + data.messageContent;
      var idChannel = t.getChannelName();
      t.messageList.messages.push({ content: content, class: data.class, idMessage: data.idMessage, idChannel: idChannel });
    }
  }, {
    key: 'loadMessage',
    value: function loadMessage() {
      var t = this;

      console.log('in load');

      var channelId = t.getChannelName();

      var dataToSend = {
        nbMessagesLoad: 10,
        idChannel: channelId
      };

      var firstMessage = document.querySelectorAll('#' + t.name + ' li:first-child');
      if (firstMessage.length) {
        var firstMessageId = firstMessage[0].getAttribute('data-id-message');
        dataToSend.idLastMessage = Number(firstMessageId);
      }

      $.ajax({
        url: t.ajaxUrl + '?action=load_more',
        type: 'POST',
        data: dataToSend,
        success: function success(data) {
          var response = JSON.parse(data);
          console.log(response.status, t.name);
          if (response.status === 'ok') {
            var messages = response.content;
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
              for (var _iterator = messages[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var message = _step.value;

                var className = message.user === t.userPseudo ? 'sent' : 'received';
                var pseudo = message.user === t.userPseudo ? 'vous' : message.user;
                var content = '<p class="pseudo">' + pseudo + ' : </p>' + message.content;
                t.messageList.messages.unshift({ content: content, class: className, idMessage: message.id, idChannel: channelId });
              }
            } catch (err) {
              _didIteratorError = true;
              _iteratorError = err;
            } finally {
              try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                  _iterator.return();
                }
              } finally {
                if (_didIteratorError) {
                  throw _iteratorError;
                }
              }
            }
          }
          if (response.status === 'ok' && !response.more || response.status === 'vide') {
            var buttonMessage = document.querySelectorAll('#' + t.name + ' .more-messages');
            buttonMessage[0].style.display = 'none';
          }
        },
        error: function error(err) {
          console.log(err);
        }
      });
    }
  }, {
    key: 'getChannelName',
    value: function getChannelName() {
      var t = this;
      return Number(t.name.replace('channel', ''));
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
    t.userId = window.localStorage.getItem('id_user');
    t.userPseudo = window.localStorage.getItem('pseudo_user');
    window.socket = io.connect('http://localhost:8080');
    t.burger = document.querySelectorAll('.burger-c')[0];
    t.channelList = document.querySelectorAll('.channels-c')[0];
    t.btNotifs = document.querySelectorAll('.bt-notification')[0];
    t.btNotifsActions = document.querySelectorAll('#notifications .bt');
    t.notifContainer = document.querySelectorAll('.notifications-c')[0];

    t.notificationsArray = notificationsArray;

    t.notifsList = new Vue({
      el: '#notifications',
      data: {
        notifs: []
      }
    });
    console.log(t.notificationsArray);
    t.init();
  }

  _createClass(Homepage, [{
    key: 'init',
    value: function init() {
      console.log('homepage init');
      var t = this;

      // message de connexion
      t.userConnected();

      // initialisation des channels
      t.startChannels();

      // watcher ouverture containers
      t.watchersStyle();

      // lance la partie server
      t.fromServerSide();

      // set notifs
      t.setNotifs();
      // afficher le profil
      // se déconnecter
    }
  }, {
    key: 'watchersStyle',
    value: function watchersStyle() {
      var t = this;

      // watcher click de mes channels
      Object.keys(t.channels).map(function (key) {
        t.channels[key].addEventListener('click', function () {
          // enleve les class
          Object.keys(t.channels).map(function (key) {
            t.channels[key].classList.remove('selected');
          });
          this.classList.add('selected');
          t.name = this.getAttribute('data-name');
          t.openChat();
        });
      });

      // watcher channel menu
      t.burger.addEventListener('click', function () {
        if (t.channelList.classList.contains('active')) t.channelList.classList.remove('active');else t.channelList.classList.add('active');
        if (t.notifContainer.classList.contains('active')) t.notifContainer.classList.remove('active');
      });

      // watcher notifs menu
      t.btNotifs.addEventListener('click', function () {
        if (t.notifContainer.classList.contains('active')) t.notifContainer.classList.remove('active');else t.notifContainer.classList.add('active');
        if (t.channelList.classList.contains('active')) t.channelList.classList.remove('active');
      });

      // watcher button notifs
      Object.keys(t.btNotifsActions).map(function (key) {
        t.btNotifsActions[key].addEventListener('click', function () {
          var userPseudoRequest = this.getAttribute('data-user-pseudo');
          var action = this.getAttribute('data-action');
          var parentId = this.parentNode.getAttribute('id');
          window.socket.emit('notification.response', { action: action, idUserReceiver: t.userId, idUserSend: userPseudoRequest, id: parentId });
        });
      });
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

      t.channelList.classList.remove('active');
    }
  }, {
    key: 'userConnected',
    value: function userConnected() {
      var t = this;

      window.socket.emit('user.connect', t.userPseudo);
    }
  }, {
    key: 'fromServerSide',
    value: function fromServerSide() {
      var t = this;

      window.socket.on('notification.response', function (id) {
        console.log('reponse reçue', id);
      });
    }
  }, {
    key: 'setNotifs',
    value: function setNotifs() {
      var t = this;

      console.log('in set notif', t.notificationsArray.length);

      for (var i = 0; i < t.notificationsArray.length; i++) {
        console.log(i);
        t.notifsList.notif.push({ id: t.notificationsArray[i].id, pseudo: t.notificationsArray[i].pseudo, userId: t.notificationsArray[i].id_user });
      }
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
'use strict';

Vue.component('message-item', {
  props: ['message'],
  template: '<li v-bind:data-id-message="message.idMessage" v-bind:data-id-channel="message.idChannel" v-bind:class="message.class" v-html="message.content"></li>'
});

Vue.component('notif-item', {
  props: ['notif'],
  template: '<li v-bind:id="notif.id"><p>{{notif.pseudo}} veut parler avec vous</p><span class="bt bt-add bt-round" data-action="accepted" v-bind:data-id-user="notif.userId">Y</span><span class="bt bt-add bt-round" data-action="refused" v-bind:data-id-user="notif.userId">N</span></li>'
});