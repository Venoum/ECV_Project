<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Créer un compte</title>
  <link rel="stylesheet" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/css/all.css">
</head>
<body>
  <div class="mobile-wrapper connect">
    <h1>Kattus</h1>
    <div class="container_connect">
      <div class="backdrop2"></div>
      <form method="post" action="index.php?action=register">
        <fieldset>
          <?php if (isset($_GET['message'])): ?>
            <p class="error"><?php echo $_GET['message']; ?></p>
          <?php endif; ?>
          <div class="user_form">
            <img src="assets/img/user.png" alt="">
            <input type="text" required name="pseudo" placeholder="Pseudo">
          </div>
          <div class="mail_form">
            <img src="assets/img/mail.png" alt="">
            <input type="email" required name="mail" placeholder="Email">
          </div>
          <div class="mdp_form">
            <img src="assets/img/lock.png" alt="">
            <input id="password" type="password" required name="password" placeholder="Password">
            <span title="Click pour afficher/chacher le mot de passe" class="icon-eye" onclick="showPwd()">
              <img id="pwdimg" src="assets/img/view.png">
            </span>
          </div>
          <div class="mdp_form">
            <img src="assets/img/lock.png" alt="">
            <input id="password_confirm" type="password" required name="password_confirm" placeholder="Confirm password">
          </div>
          <div class="submit_form">
            <button type="submit" name="button">Créer un compte</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <script src="http://localhost/ECV_Project/dest/assets/js/all.js"></script>
</body>
</html>
