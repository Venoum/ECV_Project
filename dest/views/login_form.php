<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>

    <link rel="stylesheet" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/css/all.css">

</head>
<body>
    <div class="mobile-wrapper connect">
        <div class="backdrop"></div>
        <h1><?= $welcome_message ?></h1>
        <form method="post" action="index.php?action=login">
          <fieldset>
            <?php if (isset($_GET['message'])): ?>
              <p class="error"><?php echo $_GET['message']; ?></p>
            <?php endif; ?>
            <img src="assets/img/user.png" alt="">
            <input type="text" required name="pseudo" placeholder="Pseudo">
            <img src="assets/img/lock.png" alt="">
            <input type="password" required name="password" placeholder="Password">
            <button type="submit" name="button">Se connecter</button>
          </fieldset>
        </form>
        <a href="index.php?action=register_form">Créer un compte</a>
    </div>
</body>
</html>
