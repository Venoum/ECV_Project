// créer la classe
const website = new Website()
website.init()



// partie Renaud

// var home = document.getElementById('home')
var friendsList = document.getElementById('friends-list')
var channelsList = document.getElementById('channels-list')
var notifList = document.getElementById('notif-list')
var friendChat = document.getElementById('friends-chat')
// var channelChat = document.getElementById('channel-chat')
var friendHeader = document.getElementById('friends-header')
var menu = document.getElementById('menu')

function goToFriendList () {
  // home.style.display = 'none'
  friendsList.style.display = 'block'
  channelsList.style.display = 'none'
  notifList.style.display = 'none'
}

function goToChannelList () {
  // home.style.display = 'none'
  friendsList.style.display = 'none'
  channelsList.style.display = 'block'
  notifList.style.display = 'none'
}

function goToNotifList () {
  // home.style.display = 'none'
  friendsList.style.display = 'none'
  channelsList.style.display = 'none'
  notifList.style.display = 'block'
}

function goToFriendChat() {
  friendsList.style.display = 'none'
  friendChat.style.display = 'block'
  menu.style.display = 'none'
  friendHeader.style.display = 'block'
}

// function goToChannelChat () {
//
// }

function backToFriendList () {
  friendsList.style.display = 'block'
  friendChat.style.display = 'none'
  menu.style.display = 'block'
  friendHeader.style.display = 'none'
}
