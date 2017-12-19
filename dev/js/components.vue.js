Vue.component('message-item', {
  props: ['message'],
  template: '<li v-bind:data-id-message="message.idMessage" v-bind:data-id-channel="message.idChannel" v-bind:class="message.class" v-html="message.content"></li>'
})

Vue.component('notif-item', {
  props: ['notif'],
  template: '<li v-bind:id="notif.id"><p>{{notif.pseudo}} veut parler avec vous</p><div class="bt-c"><svg v-on:click="action" class="bt bt-action  " data-action="accepted" v-bind:data-id-user="notif.userId" viewBox="0 0 100 100"><path fill="#fdc67a" d="M50,2A48,48,0,1,0,98,50,48.05,48.05,0,0,0,50,2Z"/><path fill="#780e3b" d="M72.62,30.31,44.25,62.23,27.15,48.56a1.85,1.85,0,0,0-2.31,2.88L43.31,66.21A1.85,1.85,0,0,0,45.84,66L75.38,32.76a1.85,1.85,0,0,0-2.76-2.45Z"/></svg><svg v-on:click="action" class="bt bt-action  " data-action="refused" v-bind:data-id-user="notif.userId" viewBox="0 0 100 100"><path fill="#fdc67a" d="M50,1.19A48.81,48.81,0,1,0,98.81,50,48.87,48.87,0,0,0,50,1.19Z"/><path fill="#780e3b" d="M68.22,31.78a1.88,1.88,0,0,0-2.65,0L50,47.35,34.43,31.78a1.88,1.88,0,0,0-2.65,2.65L47.35,50,31.78,65.57a1.88,1.88,0,1,0,2.65,2.65L50,52.65,65.57,68.22a1.88,1.88,0,0,0,2.65-2.65L52.65,50,68.22,34.43A1.88,1.88,0,0,0,68.22,31.78Z"/></svg></div></li>',
  methods: {
    action: function (event) {
      let userPseudoRequest = event.currentTarget.getAttribute('data-id-user')
      let action = event.currentTarget.getAttribute('data-action')
      let parentId = event.currentTarget.parentNode.getAttribute('id')
      window.socket.emit('notification.response', {action: action, idUserReceiver: window.localStorage.getItem('id_user'), idUserSend: userPseudoRequest, id: parentId})
    }
  }
})
