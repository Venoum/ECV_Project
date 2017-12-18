<?php
  var_dump($message_error_register);
  var_dump($message_error_register2);

?>







<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil</title>

    <!-- <link rel="stylesheet" href="http://localhost/ECVDigital/Workshop/dest/assets/css/all.css"> -->
    <link rel="stylesheet" href="http://localhost/ECV_Project/dest/assets/css/all.css">
</head>
<body id="chat">

  <form id="addFriend" method="post" action="index.php?action=chat&param=addFriend">
    <input type="text" name="pseudo">
    <button type="submit" name="button">Valider</button>
  </form>

  <form id="addChannel" method="post" action="index.php?action=chat&param=addChannel">
    <input type="text" name="channelName">
    <button type="submit" name="button">envoie salon</button>
  </form>

  <section>
    <ul id="messages"></ul>

    <form id="socket">
      <input id="m" autocomplete="off" /><button>Send</button>
    </form>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script>

  $(function () {


    var socket = io.connect('http://localhost:8080');
    var user = null;


    // ajouter le message de connexion

    $('#socket').submit(function(){
      socket.emit('chat.message', $('#m').val())
      $('#m').val('')
      // return false : eviter d'envoyer vraiment le message via le formulaire
      return false;
    });

    // ajoute message
    socket.on('chat.message', function(msg){
      $('#messages').append($('<li>').text(msg));
    });

  });
  </script>

</body>
</html>