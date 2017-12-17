<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="http://192.168.1.50:8888/ECVDigital/Workshop/dest/assets/css/all.css">

    <script src="https://unpkg.com/vue"></script>
</head>
<body id="chat">


  <?php

  echo
  "
  <script type='text/javascript'>
    localStorage.setItem('id_user', '$id_user');
    localStorage.setItem('pseudo_user', '$pseudo_user');
  </script>
  ";

  ?>

  <?php
  // TODO : affichage / acceptation des notifications
  ?>
  <p><?= $nbr_notifs ?></p>

  <div class="burger-c">
    <svg>
      <rect width="100%" height="2px" fill="black"></rect>
      <rect width="100%" height="2px" fill="black"></rect>
      <rect width="100%" height="2px" fill="black"></rect>
    </svg>
  </div>


  <nav>
    <!-- MENU CHANNELS -->
    <ul id="channels">
      <?php foreach ($channels as $channel) : ?>
        <li class="channel <?= $channel->type ?>" data-name="<?= $channel->slug ?>"><?= $channel->name ?></li>
      <?php endforeach; ?>
    </ul>
  </nav>



  <!-- CHAT SALONS -->
  <?php foreach ($channels as $channel) : ?>

    <section class="window-chat <?= $channel->type ?>" id="<?= $channel->slug ?>">

      <h6 class="channel-name"><?= $channel->name ?></h6>

      <div class="bt more-messages" v-on:click="loadMessages">
        <p>+ de messages</p>
      </div>

      <div class="container-messages">
        <ul class="messages" id="<?= $channel->slug ?>Message">
          <message-item
              v-for="message in messages"
              v-bind:message="message"
              v-bind:key="message.id"
            ></message-item>
        </ul>
      </div>

      <form v-on:submit="sendMessage">

        <div class="message-c">

          <div class="images-c">
          </div>

          <textarea class="message" id='<?= $channel->slug ?>Input' autocomplete="off" ></textarea>

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

  <?php endforeach; ?>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" integrity="sha384-aBL3Lzi6c9LNDGvpHkZrrm3ZVsIwohDD7CDozL0pk8FwCrfmV7H9w8j3L7ikEv6h" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX" crossorigin="anonymous"></script> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://192.168.1.50:8080/socket.io/socket.io.js"></script>
  <script src="http://192.168.1.50:8888/ECVDigital/Workshop/dest/lib/jquery.ajax.min.js"></script>
  <script src="http://192.168.1.50:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>

</body>
</html>
