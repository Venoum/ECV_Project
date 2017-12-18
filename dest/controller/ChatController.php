<?php


if ($action === 'chat')
{
  $message_error_register = false;
  $message_error_register2 = false;

  //addFriend Action
  if (isset($_POST['pseudo']) and isset($_GET['param']) and $_GET['param'] === 'addFriend')
  {
  	//user doesnt exist
    $pseudo = $_POST['pseudo'];
    //get receiver and user info
    $requestReceiverID = "SELECT us_id FROM users WHERE us_pseudo = '$pseudo'";
    $receiverID = myFetchAssoc($requestReceiverID);
    // $requestUserName = "SELECT us_pseudo FROM users WHERE us_id = $id";
    // $userName['us_pseudo'] = myFetchAssoc($requestUserName);

    $requestCheckUser = "SELECT us_pseudo FROM users WHERE us_pseudo = '$pseudo'";
    $result = myFetchAssoc($requestCheckUser);
    if ($result)
    {
    	$statut_register_user = true;
    }
    else
    {
      $message_error_register = 'L\'utilisateur n\'existe pas';
    }

    //already a friend
    if (isset($statut_register_user)) {
      $requestCheckFriend = "SELECT fr_id_user_send FROM friends WHERE fr_id_user_send = 31 AND fr_id_user_receiver = ".$receiverID['us_id']."";
      $result2 = myFetchAssoc($requestCheckFriend);
      if ($result2){
        $message_error_register = 'Vous êtes déjà amis avec '.$pseudo;

        //if already request and status : refused
        $requestAddFriendStatus = "SELECT fr_status FROM friends WHERE fr_id_user_send = 31 AND fr_id_user_receiver = ".$receiverID['us_id']."";
        $result3 = myFetchAssoc($requestAddFriendStatus);
        if ($result3['fr_status'] === 'refused') {
          $message_error_register = 'Erreur : '.$pseudo.' ne souhaite pas devenir votre amis';
        }
      }
      else {
        $statut_register_friend = true;
      }

      //send request
      if (isset($statut_register_friend)) {
        $requestAddFriend = "INSERT INTO friends (`fr_id_user_send`, `fr_id_user_receiver`, `fr_status`) VALUES (31, ".$receiverID['us_id'].", 'pending')";
        $result4 = myQuery($requestAddFriend);
        if (!$result4){
          $message_error_register = 'Problème de connexion base de donnée';
        } 
        else {

          //create channel
          $datePrivate = date("d.m.y"); ;
          $requestAddChannel = "INSERT INTO channels (`ch_name`, `ch_type`, `ch_created`) VALUES ('".$userName['us_pseudo']." ".$pseudo."', 'private', '".$datePrivate."')";
          $result5 = myQuery($requestAddChannel);
          if (!$result5){
            $message_error_register = 'Problème de connexion base de donnée';
          }
        }
      }
    }
  }
  else {
  	$message_error_register = 'manque un champs : Ajout Amis';
  }

  //addChannel Action
  if (isset($_POST['channelName']) and isset($_GET['param']) and $_GET['param'] === 'addChannel')
  {
    $channelName = $_POST['channelName'];
    //channel already exist
    $requestCheckChannel = "SELECT ch_name FROM channels WHERE ch_name = '$channelName' ";
    $result6 = myFetchAssoc($requestCheckChannel);
    if (!$result6)
    {
      $statut_register_channel = true;
      echo "string";
    }
    else
    {
      $message_error_register = 'Le salon $channelName existe déjà';
    }

    if (isset($statut_register_channel)){
      $datePublic = date("d.m.y"); ;
      $requestAddChannelPublic = "INSERT INTO channels (`ch_name`, `ch_type`, `ch_created`) VALUES ('".$channelName."', 'public', '".$datePublic."')";
      $result7 = myQuery($requestAddChannelPublic);
      if (!$result7){
        $message_error_register = 'Problème de connexion base de donnée';
      }
    }
  }
  else {
    $message_error_register2 = 'manque un champs : Ajout Salon';
  }
}