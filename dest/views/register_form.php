<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kattus | Créer un compte</title>
  <link rel="icon" type="image/png" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/img/kattus-logo.png" />
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
            <img src="assets/img/user.png" alt="icone utilisateur">
            <input type="text" aria-required="true" required name="pseudo" placeholder="Votre identifiant">
          </div>
          <div class="mail_form">
            <img src="assets/img/mail.png" alt="icone mail">
            <input type="email" required aria-required="true" name="mail" placeholder="Votre adresse mail">
          </div>
          <div class="mdp_form">
            <img src="assets/img/lock.png" alt="icone mot de passe">
            <input id="password" type="password" required aria-required="true" name="Password" placeholder="Votre mot de passe">
            <span title="Click pour afficher/chacher le mot de passe" class="icon-eye" onclick="showPwd()">
              <img id="pwdimg" src="assets/img/view.png">
            </span>
          </div>
          <div class="mdp_form">
            <img src="assets/img/lock.png" alt="icone mot de passe confirmer">
            <input id="password_confirm" type="password" required aria-required="true" name="password_confirm" placeholder="Confirmez votre mot de passe">
          </div>
          <div class="submit_form">
            <button type="submit" name="button">Créer un compte</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <script src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>
</body>
</html>
