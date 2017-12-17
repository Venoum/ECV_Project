Vue.component('message-item', {
  props: ['message'],
  template: '<li v-bind:data-id-message="message.idMessage" v-bind:data-id-channel="message.idChannel" v-bind:class="message.class" v-html="message.content"></li>'
})

Vue.component('notif-item', {
  props: ['notif'],
  template: '<li v-bind:id="notif.id"><p>{{notif.pseudo}} veut parler avec vous</p><span class="bt bt-add bt-round" data-action="accepted" v-bind:data-id-user="notif.userId">Y</span><span class="bt bt-add bt-round" data-action="refused" v-bind:data-id-user="notif.userId">N</span></li>'
})
