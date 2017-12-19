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
    <div class="backdrop-2"></div>
    <h1><?= $welcome_message ?></h1>
    <form method="post" action="index.php?action=register">
      <fieldset>
        <?php if (isset($_GET['message'])): ?>
          <p class="error"><?php echo $_GET['message']; ?></p>
        <?php endif; ?>
        <img src="assets/img/user.png" alt="">
        <input type="text" required name="pseudo" placeholder="Pseudo">
        <img src="assets/img/mail.png" alt="">
        <input type="email" required name="mail" placeholder="Email">
        <img src="assets/img/lock.png" alt="">
        <input type="password" required name="password" placeholder="Password">
        <input type="password" required name="password_confirm" placeholder="Confirm password">
        <button type="submit" name="button">Créer un compte</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
