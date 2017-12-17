<?php

require_once('../models/dbtools.php');

if (!empty($_GET['action']))
{


  if ( $_GET['action'] === 'load_more' )
  {

    $id_channel = $_POST['idChannel'];
    $id_nb_messages = $_POST['nbMessagesLoad'];
    if (!empty( $_POST['idLastMessage'])) $id_last_message = $_POST['idLastMessage'];

    $request = "SELECT * FROM messages WHERE msg_id_channel =  $id_channel " ;
    if (!empty( $_POST['idLastMessage'])) $request .= "AND msg_id < $id_last_message" ;
    $request .= "ORDER BY msg_id DESC LIMIT $id_nb_messages ";

    // echo $request;

    $result = myFetchAllAssoc($request);

    if (count($result) > 0) {
      $more_messages = count($result) < 10;
      $messages = [];
      foreach ($result as $message) {
        $new_message = [
          'id' => $message['msg_id'],
          'content' => $message['msg_content'],
          'user' => $message['msg_id_user']
        ];
        $messages[] = $new_message;
      }

      $response = array('status' => 'ok', 'content' => $messages, 'more' => $more_messages, 'request' => $request);
      echo json_encode($response);
    }
    else if (count($result) === 0){
      $response = array('status' => $request);
      echo json_encode($response);
    }
    else {
      $response = array('status' => 'erreur', 'message' => 'Erreur de connexion à la base de données veuillez recommencer');
      echo json_encode($response);
    }



  }


}
