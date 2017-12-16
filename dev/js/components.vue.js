Vue.component('message-item', {
  props: ['message'],
  template: '<li v-bind:class="message.class" v-html="message.content"></li>'
})
