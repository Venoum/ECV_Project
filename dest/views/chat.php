<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/css/all.css">

    <script src="https://unpkg.com/vue"></script>
</head>
<body id="chat">



  <?php

  $id_user = strval($_COOKIE['id_user']);
  $id_pseudo = strval($_COOKIE['pseudo_user']);

  echo
  "
  <script type='text/javascript'>
    localStorage.setItem('id_user', '$id_user');
    localStorage.setItem('pseudo_user', '$id_pseudo');
  </script>
  ";
  ?>




  <ul id="channels">
    <li class="channel" data-name="channel1">Channel 1</li>
    <li class="channel" data-name="channel2">Channel 2</li>
    <li class="channel" data-name="channel3">Channel 3</li>
  </ul>



  <section class="window-chat" id="channel1">

    <h6 class="channel-name">channel 1</h6>

    <ul class="messages" id="channel1Message">
      <message-item
          v-for="message in messages"
          v-bind:message="message"
          v-bind:key="message.id"
        ></message-item>
    </ul>

    <form v-on:submit="sendMessage">

      <div class="message-c">

        <div class="images-c">
        </div>

        <textarea class="message" id='channel1Input' autocomplete="off" ></textarea>

        <div class="message-button" data-button="buttonCamera">
          <p>camera</p>
        </div>

        <div class="message-button" data-button="buttonImport">
          <p>upload</p>
        </div>
      </div>

      <button>Send</button>

      <div class="hidden">
        <input type="file" accept="image/*" class="buttonImport"/>
        <input type="file" accept="image/*" capture="camera" class="buttonCamera"/>
      </div>

    </form>

  </section>



  <section class="window-chat" id="channel2">

    <h6 class="channel-name">channel 2</h6>

    <ul class="messages" id="channel2Message">
      <message-item
          v-for="message in messages"
          v-bind:message="message"
          v-bind:key="message.id"
        ></message-item>
    </ul>

    <form v-on:submit="sendMessage">

      <div class="images-c">
      </div>

      <div class="message-c">
        <textarea class="message" id='channel2Input' autocomplete="off" ></textarea>
      </div>

      <div class="message-button" data-button="buttonCamera">
        <p>camera</p>
      </div>
      <div class="message-button" data-button="buttonImport">
        <p>upload</p>
      </div>

      <button>Send</button>

      <div class="hidden">
        <input type="file" accept="image/*" class="buttonImport"/>
        <input type="file" accept="image/*" capture="camera" class="buttonCamera"/>
      </div>

    </form>

  </section>



  <section class="window-chat" id="channel3">

    <h6 class="channel-name" id="channel3Message">channel 3</h6>

    <ul class="messages">
      <message-item
          v-for="message in messages"
          v-bind:message="message"
          v-bind:key="message.id"
        ></message-item>
    </ul>

    <form v-on:submit="sendMessage">

      <div class="images-c">
      </div>

      <div class="message-c">
        <textarea class="message" id='channel3Input' autocomplete="off"></textarea>
      </div>

      <div class="message-button" data-button="buttonCamera">
        <p>camera</p>
      </div>
      <div class="message-button" data-button="buttonImport">
        <p>upload</p>
      </div>

      <button>Send</button>

      <div class="hidden">
        <input type="file" accept="image/*" class="buttonImport"/>
        <input type="file" accept="image/*" capture="camera" class="buttonCamera"/>
      </div>

    </form>


  </section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script type="text/javascript" src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>


</body>
</html>
