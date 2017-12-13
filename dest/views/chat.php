<?php



  if ($statut_register)
    header('Location: index.php?action=chat');
  else
    header('Location: index.php?action=register_form&message=' + $message_error_register);
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

  <section>
    <button>add</button>
  </section>
  <section>

    <ul id="messages"></ul>

    <form>
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

    $('form').submit(function(){
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
