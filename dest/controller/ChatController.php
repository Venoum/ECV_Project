<?php


if ($action === 'chat')
{
  // renvoyer l'ID
  $id_user = strval($_COOKIE['id_user']);
  $pseudo_user = strval($_COOKIE['pseudo_user']);
  $message = 'bienvenue';
  $channels_public = [];
  $channels_private = [];

  $notifs = [];

  // récupère les channels public
  $request_channels_public =
  "SELECT channels.ch_name, channels.ch_type, channels.ch_id
  FROM channels
  WHERE ch_type = 'public'";
  $result_channels_public = myFetchAllAssoc($request_channels_public);


  foreach ($result_channels_public as $channel_public) {
    $new_channel = new Channel($channel_public['ch_type'], $channel_public['ch_name'], $channel_public['ch_id']);
    $channels_public[] = $new_channel;
  }


  // récupère les channels prives
  $request_channels_private =
  "SELECT channels.ch_name, channels.ch_type, channels.ch_id
  FROM channels
  INNER JOIN members ON members.mb_id_channel = channels.ch_id AND members.mb_id_user = $id_user AND channels.ch_type = 'private'";
  $result_channels_private = myFetchAllAssoc($request_channels_private);

  foreach ($result_channels_private as $channel_private) {
    $new_channel = new Channel($channel_private['ch_type'], $channel_private['ch_name'], $channel_private['ch_id']);
    $channels_private[] = $new_channel;
  }



  // récupère les notifications
  $request_notifs = "SELECT us_pseudo, us_id, fr_id
  FROM users
  INNER JOIN friends ON fr_id_user_receiver = $id_user AND fr_status= 'pending' AND fr_id_user_send = us_id";
  $result_notifs = myFetchAllAssoc($request_notifs);

  foreach ($result_notifs as $notif) {
    $notifs[] = array('id_user' => $notif['us_id'], 'pseudo' => $notif['us_pseudo'], 'id' => $notif['fr_id']);
  }
  $nbr_notifs = count($notifs);


}
