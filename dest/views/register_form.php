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

  <?php if (isset($_GET['message'])): ?>
    <p class="error"><?php echo $_GET['message']; ?></p>
  <?php endif; ?>

  <form method="post" action="index.php?action=register">
    <input type="text" name="pseudo" value="">
    <input type="email" name="mail" value="">
    <input type="password" name="password" value="">
    <input type="password" name="password_confirm" value="">
    <button type="submit" name="button">Se créer un compte</button>
  </form>


</body>
</html>
