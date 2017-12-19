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
    <div>

      <h1><?= $welcome_message ?></h1>

      <?php if (isset($_GET['message'])): ?>
        <p class="error"><?php echo $_GET['message']; ?></p>
      <?php endif; ?>

      <?php echo $login_form ?>

      <form method="post" action="index.php?action=login">
        <input type="text" name="pseudo">
        <input type="password" name="password">
        <button type="submit" name="button">se connecter</button>
      </form>

      <a href="index.php?action=register_form">se créer un compte</a>

    </div>
</body>
</html>
