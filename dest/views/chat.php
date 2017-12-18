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

  echo
  "
  <script type='text/javascript'>
    localStorage.setItem('id_user', '$id_user');
    localStorage.setItem('pseudo_user', '$pseudo_user');
    var notificationsArray = " . json_encode($notifs) . ";
  </script>
  ";

  ?>

  <div class="mobile-wrapper">


    <header>

      <div class="logo">
        logo
      </div>

      <a href="index.php" class="deconnect">deco</a>

    </header>

    <nav>

      <ul class="nav-first">
        <li class="bt bt-nav selected" data-menu-block="friendsList">
          <img class="icon-nav" src="" alt="friend">
          <ul class="nav-second channels private active">
            <li class="input-add">
              <form id="addFriend" method="post" action="index.php?action=chat&param=addFriend">
                <input type="text" name="pseudo">
                <button type="submit" name="button">Valider</button>
                <?php if (isset($message_validate_friend)): ?>
                  <p class="error"><?php echo $message_validate_friend; ?></p>
                <?php endif; ?>
              </form>
            </li>
            <?php foreach ($channels_private as $channel) : ?>
              <li class="channel <?= $channel->type ?>" data-name="<?= $channel->slug ?>"><?= $channel->name ?></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="bt bt-nav" data-menu-block="publicList">
          <img class="icon-nav" src="" alt="public">
          <ul class="nav-second channels public">
            <li class="input-add">
              <form id="addChannel" method="post" action="index.php?action=chat&param=addChannel">
                <input type="text" name="channelName">
                <button type="submit" name="button">envoie salon</button>
                <?php if (isset($message_validate_channel)): ?>
                  <p class="error"><?php echo $message_validate_channel; ?></p>
                <?php endif; ?>
              </form>
            </li>
            <?php foreach ($channels_public as $channel) : ?>
              <li class="channel <?= $channel->type ?>" data-name="<?= $channel->slug ?>"><?= $channel->name ?></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="bt bt-nav bt-notification" data-menu-block="notifList">
          <img class="icon-nav" src="" alt="notifs">
          <div class="number bt-round">
            <p></p>
          </div>
          <ul class="nav-second" id="notifications">
            <notif-item
                v-for="notif in notifs"
                v-bind:notif="notif"
                v-bind:key="notif.id"
              ></notif-item>
          </ul>
        </li>
      </ul>
    </nav>




    <!-- CHAT SALONS -->
    <?php foreach ($channels_public as $channel) : ?>
      <?php $channel->get_section() ?>
    <?php endforeach; ?>

    <?php foreach ($channels_private as $channel) : ?>
      <?php $channel->get_section() ?>
    <?php endforeach; ?>




  </div>




  <form id="addFriend" method="post" action="index.php?action=chat&param=addFriend">
    <input type="text" name="pseudo">
    <button type="submit" name="button">Valider</button>
    <?php if (isset($message_validate_friend)): ?>
      <p class="error"><?php echo $message_validate_friend; ?></p>
    <?php endif; ?>
  </form>






  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" integrity="sha384-aBL3Lzi6c9LNDGvpHkZrrm3ZVsIwohDD7CDozL0pk8FwCrfmV7H9w8j3L7ikEv6h" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX" crossorigin="anonymous"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script src="http://localhost:8888/ECVDigital/Workshop/dest/lib/jquery.ajax.min.js"></script>
  <script src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>


</body>
</html>
