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
    var notificationsArray = " . json_encode($notifs) . ";
  </script>
  ";

  ?>


  <header>

    <div class="burger-c bt">
      <svg>
        <rect width="50px" height="4px" fill="white" x="0" y="10"></rect>
        <rect width="50px" height="4px" fill="white" x="0" y="23px"></rect>
        <rect width="50px" height="4px" fill="white" x="0" y="36px"></rect>
      </svg>
    </div>

    <div class="logo">
      logo
    </div>

    <div class="bt bt-notification">
      <div class="icon"></div>
      <div class="number bt-round">
        <p></p>
      </div>
    </div>
  </header>


  <!-- MENU CHANNELS -->
  <!-- TODO : spliter amis et salons public voir php trier tableau -->
  <nav class="channels-c">
    <ul class="channels public">
      <?php foreach ($channels_public as $channel) : ?>
        <li class="channel <?= $channel->type ?>" data-name="<?= $channel->slug ?>"><?= $channel->name ?></li>
      <?php endforeach; ?>
    </ul>
    <ul class="channels private">
      <?php foreach ($channels_private as $channel) : ?>
        <li class="channel <?= $channel->type ?>" data-name="<?= $channel->slug ?>"><?= $channel->name ?></li>
      <?php endforeach; ?>
    </ul>
  </nav>


  <!-- NOTIFICATIONS -->
  <div class="notifications-c">
    <ul id="notifications">
      <notif-item
          v-for="notif in notifs"
          v-bind:notif="notif"
          v-bind:key="notif.id"
        ></notif-item>
    </ul>
  </div>

  <?php foreach ($notifs as $notif) :?>
    <!-- <li id="<?php echo $notif['id'] ?>">
      <p><?php echo $notif['pseudo'] ?> veut être votre ami</p>
      <span class="bt bt-add bt-round" data-action="accepted" data-user-pseudo="<?php echo $notif['id_user'] ?>">Y</span>
      <span class="bt bt-remove bt-round" data-action="refused" data-user-pseudo="<?php echo $notif['id_user'] ?>">N</span>
    </li> -->
  <?php endforeach; ?>


  <!-- CHAT SALONS -->
  <?php foreach ($channels_public as $channel) : ?>
    <?php $channel->get_section() ?>
  <?php endforeach; ?>

  <?php foreach ($channels_private as $channel) : ?>
    <?php $channel->get_section() ?>
  <?php endforeach; ?>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" integrity="sha384-aBL3Lzi6c9LNDGvpHkZrrm3ZVsIwohDD7CDozL0pk8FwCrfmV7H9w8j3L7ikEv6h" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX" crossorigin="anonymous"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://192.168.1.50:8080/socket.io/socket.io.js"></script>
  <script src="http://192.168.1.50:8888/ECVDigital/Workshop/dest/lib/jquery.ajax.min.js"></script>
  <script src="http://192.168.1.50:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>


</body>
</html>
