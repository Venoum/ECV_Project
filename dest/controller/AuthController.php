<?php



if($action === 'login_form'){

  $welcome_message = 'Bienvenue connectez - vous';
  $login_form = create_form('bonjour');

}


if($action === 'login'){

  // de base on set la valeur à faux
  $statut_login = false;
  $message_error_login = 'Merci de remplir les champs';

  if ( !empty($_POST['pseudo']) && !empty($_POST['password']) )
  {

    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $request = "SELECT us_mdp, us_id FROM users WHERE us_pseudo = '$pseudo'";
    $resultRequest = myFetchAllAssoc($request);

    $id_user = false;

    foreach ( $resultRequest as $user) {
      $mdp = $user['us_mdp'];
      if ( password_verify($password, $mdp) )
      {
        $id_user = $user['us_id'];
      }
    }

    if ($id_user)
    {
      $statut_login = true;
    }
    else
    {
      $message_error_login = 'Pas d\'utilisateur trouvé.';
    }

  }

}




if($action === 'register_form'){

  $welcome_message = 'Bienvenue connectez - vous';

}





if($action === 'register'){

  // de base on set la valeur à faux
  $statut_register = false;
  $var = 'faux';

  // verification
  if ( !empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) )
  {
    if ($_POST['pseudo'] === '')
    {
      $var = 'vide';
    }
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $request = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_mdp`) VALUES ('$pseudo', '$mail', '$password')";

    $resultRequest = myQuery($request);

    if ($resultRequest)
    {
      $statut_register = true;
      $message_account_created = 'Votre compte a bien été créée. Veuillez valider votre addresse mail pour l\'utiliser';
    }
    else
      $message_error_register = 'Problème de connexion bdd';

  }
  else {
    $message_error_register = 'Veuillez renseigner tous les champs';
  }

}
