<!doctype html>
<html>
  <head>
    <title>Socket.IO chat</title>
    <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font: 13px Helvetica, Arial; }
      form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
      form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
      form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages li { padding: 5px 10px; }
      #messages li:nth-child(odd) { background: #eee; }
    </style>
  </head>
  <body>

    <ul id="messages"></ul>

    <form>
      <input id="m" autocomplete="off" /><button>Send</button>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


    <script src="http://localhost:8080/socket.io/socket.io.js"></script>

    <script>

    $(function () {


      var socket = io.connect('http://localhost:8080');
      var user = null;

      console.log(socket);

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