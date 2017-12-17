Vue.component('message-item', {
  props: ['message'],
  template: '<li v-bind:data-id-message="message.idMessage" v-bind:data-id-channel="message.idChannel" v-bind:class="message.class" v-html="message.content"></li>'
})

Vue.component('notif-item', {
  props: ['notif'],
  template: '<li v-bind:id="notif.id"><p>{{notif.pseudo}} veut parler avec vous</p><span v-on:click="action" class="bt bt-action bt-round" data-action="accepted" v-bind:data-id-user="notif.userId">Y</span><span v-on:click="action" class="bt bt-action bt-round" data-action="refused" v-bind:data-id-user="notif.userId">N</span></li>',
  methods: {
    action: function (event) {
      let userPseudoRequest = event.currentTarget.getAttribute('data-id-user')
      let action = event.currentTarget.getAttribute('data-action')
      let parentId = event.currentTarget.parentNode.getAttribute('id')
      console.log('in action', userPseudoRequest, action, parentId)
      window.socket.emit('notification.response', {action: action, idUserReceiver: window.localStorage.getItem('id_user'), idUserSend: userPseudoRequest, id: parentId})
    }
  }
})
