<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>
</head>
<body>
    <div>

      <h1><?= $welcome_message ?></h1>

      <form method="post" action="index.php?action=login">
        <input type="text" name="pseudo">
        <input type="password" name="password">
        <button type="submit" name="button">se connecter</button>
      </form>

      <a href="index.php?action=register_form">se créer un compte</a>

    </div>
</body>
</html>
