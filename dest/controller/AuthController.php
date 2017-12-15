<?php



if($action === 'login_form'){

  $welcome_message = 'Bienvenue connectez - vous';

}



if($action === 'login'){

  // de base on set la valeur à faux
  $statut_login = false;
  $message_error_login = 'message erreur login';

  if ( isset($_POST['pseudo']) && isset($_POST['password']) )
  {
    // TODO verification
    $statut_login = true;
    //TODO pass id from user to chat controller
  }


}


if($action === 'register_form'){

  $welcome_message = 'Bienvenue connectez - vous';

}



if($action === 'register'){

  // verification
  if ( isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']) )
  {
    //TODO pass id from user to chat controller
    
    // de base on set la valeur à faux
    $statut_register = false;


    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $request = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_mdp`) VALUES ('$pseudo', '$mail', '$password')";

    myQuery($request);

    if ($request)
      $statut_register = true;
    else
      $message_error_register = 'Problème de connexion bdd';

  }
  else {
    $message_error_register = 'manque un champs';
  }

}
