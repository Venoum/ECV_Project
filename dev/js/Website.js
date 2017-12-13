class Website {
  constructor () {
    const t = this

    t.homepage = document.getElementById('chat')
  }

  init () {
    const t = this
    console.log('website init')

    // pour la page d'accueil
    if (t.homepage) new Homepage()
  }
}

const website = new Website()
website.init()
