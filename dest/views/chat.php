<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil</title>

    <link rel="stylesheet" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/css/all.css">
</head>
<body id="chat">

  <ul id="channels">
    <li class="channel" data-name="channel-1">Channel 1</li>
    <li class="channel" data-name="channel-2">Channel 2</li>
    <li class="channel" data-name="channel-3">Channel 3</li>
  </ul>

  <section class="window-chat" id="channel-1">

    <h6 class="channel-name">channel 1</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>

  <section class="window-chat" id="channel-2">

    <h6 class="channel-name">channel 2</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>

  <section class="window-chat" id="channel-3">

    <h6 class="channel-name">channel 3</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script type="text/javascript" src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>


  <script>

  // $(function () {

    // var socket = io.connect('http://localhost:8080');
    // var user = null;

    // ajouter le message de connexion

    // $('form').submit(function(){
    //
    //
    //   socket.emit('chat.message', $('#m').val())
    //   $('#m').val('')
    //
    //   // return false : éviter d'envoyer vraiment le message via le formulaire
    //   return false;
    // });

    // // ajoute message
    // socket.on('chat.message', function(msg){
    //   $('#messages').append($('<li>').text(msg));
    // });
  //
  // });
  </script>


</body>
</html>
