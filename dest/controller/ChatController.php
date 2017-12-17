<?php


if ($action === 'chat')
{
  // renvoyer l'ID
  $id_user = strval($_COOKIE['id_user']);
  $pseudo_user = strval($_COOKIE['pseudo_user']);
  $message = 'bienvenue';
  $channels = [];
  $notifs = [];

  // récupère les channels public
  $request_channels_public =
  "SELECT channels.ch_name, channels.ch_type, channels.ch_id
  FROM channels
  WHERE ch_type = 'public'";
  $result_channels_public = myFetchAllAssoc($request_channels_public);


  foreach ($result_channels_public as $channel_public) {
    $new_channel = new Channel($channel_public['ch_type'], $channel_public['ch_name'], $channel_public['ch_id']);
    $channels[] = $new_channel;
  }


  // récupère les channels prives
  $request_channels_private =
  "SELECT channels.ch_name, channels.ch_type, channels.ch_id
  FROM channels
  INNER JOIN members ON members.mb_id_channel = channels.ch_id AND members.mb_id_user = $id_user AND channels.ch_type = 'private'";
  $result_channels_private = myFetchAllAssoc($request_channels_private);

  foreach ($result_channels_private as $channel_private) {
    $new_channel = new Channel($channel_private['ch_type'], $channel_private['ch_name'], $channel_private['ch_id']);
    $channels[] = $new_channel;
  }



  // // récupère les amis
  // $request_friends =
  // " SELECT users.us_pseudo
  // FROM users
  // INNER JOIN friends ON
  // ( friends.fr_id_user_send = users.us_id
  // AND friends.fr_id_user_receiver = $id_user
  // AND fr_status = 'accepted' )
  // OR
  // ( friends.fr_id_user_receiver = users.us_id
  // AND friends.fr_id_user_send = $id_user
  // AND fr_status = 'accepted' ) ";
  // $result_friends = myFetchAllAssoc($request_friends);
  //
  // foreach ($result_friends as $friend_name) {
  //   $name_channel = null;
  //   $compare = strcasecmp($friend_name['us_pseudo'], $pseudo_user);
  //   if ($compare > 0)
  //     $name_channel = $pseudo_user.$friend_name['us_pseudo'];
  //   else
  //     $name_channel = $friend_name['us_pseudo'].$pseudo_user;
  //
  //   $new_channel = new Channel('private', $friend_name['us_pseudo'], $name_channel);
  //   $friends[] = $new_channel;
  // }


  // récupère les notifications
  $request_notifs = "SELECT us_pseudo
  FROM users
  INNER JOIN friends ON fr_id_user_receiver = $id_user AND fr_status= 'pending' AND fr_id_user_send = us_id";
  $result_notifs = myFetchAllAssoc($request_notifs);

  foreach ($result_notifs as $notif) {
    $notifs[] = $notif['us_pseudo'];
  }
  $nbr_notifs = count($notifs);


}
