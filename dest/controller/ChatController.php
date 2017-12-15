<?php


if ($action === 'chat')
{
  // renvoyer l'ID
  $request = "SELECT fr_id_user_send FROM friends WHERE fr_id_user_send = '$pseudo'";
  
  // $flag = 'false';
  $b = $_GET['b'];
  $message_error_register ='bb';
  $statut_register =false;

  if ( isset($_POST['pseudo']))
  {
  	//pour le message register faire un switch avec plusieurs error message et final master error message qui rendvoit le bon message
  	//rajouter des conditions selon le cas expl: si pas de user break if

  	//user doesnt exist

    $pseudo = $_POST['pseudo'];
    var_dump($pseudo);
    $request = "SELECT us_pdeudo FROM users WHERE us_pseudo = '$pseudo'";


    $result = myQuery($request);
    var_dump($result);
    if ($request)
    	$statut_register = true;
  		//
    else
      	$message_error_register = 'L\'utilisateur n\'existe pas';

    //already a friend
    //TODO get id from sender and receiver

    $request2 = "SELECT fr_id_user_send FROM friends WHERE fr_id_user_send = '$id' AND fr_id_user_receiver = '$id2'";
    myQuery($request2);
    if ($request2)
    	$statut_register_friend = true;

  	//request send
  	//TODO get id from sender and receiver

    $request2 = "INSERT INTO friends (`fr_id_user_send`, `fr_id_user_receiver`, `fr_status`) VALUES ('$id', '$id2', 'Sent')";
    myQuery($request2);
    if ($request2)
    	$statut_register_friend = true;
    else
    	$message_error_register = 'Problème de connexion bdd';
  }
  else {
  	$message_error_register = 'manque un champs';
  }
}