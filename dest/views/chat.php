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
    <li class="channel" data-name="channel1">Channel 1</li>
    <li class="channel" data-name="channel2">Channel 2</li>
    <li class="channel" data-name="channel3">Channel 3</li>
  </ul>

  <section class="window-chat" id="channel1">

    <h6 class="channel-name">channel 1</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>

  <section class="window-chat" id="channel2">

    <h6 class="channel-name">channel 2</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>

  <section class="window-chat" id="channel3">

    <h6 class="channel-name">channel 3</h6>

    <ul class="messages"></ul>

    <form>
      <input class="message" autocomplete="off" /><button>Send</button>
    </form>

  </section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script type="text/javascript" src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>

</body>
</html>
