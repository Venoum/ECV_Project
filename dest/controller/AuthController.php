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
    //Nom d'utilisateur
    $request = "SELECT us_pseudo FROM users WHERE us_pseudo = '".$_POST['pseudo']."'";

    $result = myQuery($request);
    var_dump($result);
    if ($request)
      $statut_login = true;
    else
      $message_error_register = 'Nom d\'utilisateur incorrect';

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);;

    //MDP
    $request2 = "SELECT us_mdp FROM users WHERE us_mdp = '$pwd'";

    $result = myQuery($request);
    var_dump($result);
    if ($request)
      $statut_login = true;
    else
      $message_error_register = 'Mot de passe incorrect';

    //TODO pass id from user to chat controller
    //session_start(); -> au début de tout les fichiers php (index, chat, login...)?
    //pass le session id de controller en controller ?
    // $request3 = "SELECT us_id FROM users WHERE us_pseudo = '$_POST['pseudo']'";
    // $_SESSION['us_id'] = $us_id;
  }


}


if($action === 'register_form'){

  $welcome_message = 'Bienvenue connectez - vous';

}



if($action === 'register'){
  $message_error_register = false;
  // verification
  if ( isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']) )
  {
    //TODO pass id from user to chat controller
    
    // de base on set la valeur à faux
    $statut_register = false;


    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //already a user
    $requestCheckUserName = "SELECT us_pseudo FROM users WHERE us_pseudo = '$pseudo' ";
    $result = myFetchAssoc($requestCheckUserName);
    if ($result) {
      $message_error_register = 'Ce nom est déjà pris';
    } else {
      $statut_register_userName = true;
    }

    // if (isset($statut_register_userName)) {
    //   $requestAddUser = "INSERT INTO users (`us_pseudo`, `us_mail`, `us_mdp`) VALUES ('$pseudo', '$mail', '$password')";
    //   $result2 = myQuery($requestAddUser);
    //   if (!$result2)
    //     $message_error_register = 'Problème de connexion bdd';
    // }

  }
  else {
    $message_error_register = 'manque un champs';
  }

}
