// créer la classe
const website = new Website()
website.init()

function showPwd () {
  let x = document.getElementById('password')
  if (x.type === 'password') {
    x.type = 'text'
  } else {
    x.type = 'password'
  }
}
