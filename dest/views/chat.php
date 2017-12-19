<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kattus | Chat</title>

    <link rel="stylesheet" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/css/all.css">
    <link rel="icon" type="image/png" href="http://localhost:8888/ECVDigital/Workshop/dest/assets/img/kattus-logo.png" />
    <script src="https://unpkg.com/vue"></script>
</head>
<body id="chat">


  <?php

  echo
  "
  <script type='text/javascript'>
    localStorage.setItem('id_user', '$id_user');
    localStorage.setItem('pseudo_user', '$pseudo_user');
    var notificationsArray = " . json_encode($notifs) . ";
  </script>
  ";

  $flag_channel = false;
  $flag_friends = false;


  if (!empty($message_error_friend) || !empty($message_validate_friend))
  {
    $flag_friends = true;
  }

  if (!empty($message_error_channel) || !empty($message_validate_channel))
  {
    $flag_channel = true;
  }

  ?>

  <div class="mobile-wrapper">


    <header>

      <div class="logo">
        <svg
        id="Calque_1"
        data-name="Calque 1"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 277.67 99.67">
        <defs><style>.cls-1,.cls-2{fill:#fff
          ;}.cls-1{stroke:#fff;stroke-miterlimit:10;stroke-width:0.75px;}</style></defs><title>logo3</title>
        <path class="cls-1" d="M265.32,62.42A7.45,7.45,0,0,0,272.76,55v-8.6a5.33,5.33,0,1,0-10.67,0v5.37h-2.32V27.29a9.55,9.55,0,1,0-19.09,0V40.5h-2.46V31.88a5.37,5.37,0,1,0-10.74,0V43.74a7.5,7.5,0,0,0,7.5,7.5h5.7V79.68H221.27a1.12,1.12,0,0,0,0,2.25h50.37a1.12,1.12,0,0,0,0-2.25H259.77V62.42Zm-6.67-2.25a1.12,1.12,0,0,0-1.12,1.12V79.68h-14.6V50.12A1.12,1.12,0,0,0,241.81,49H235a5.25,5.25,0,0,1-5.25-5.25V31.88a3.13,3.13,0,1,1,6.25,0v9.73a1.12,1.12,0,0,0,1.12,1.12h4.7a1.12,1.12,0,0,0,1.12-1.12V27.29a7.3,7.3,0,1,1,14.6,0V52.88A1.12,1.12,0,0,0,258.65,54h4.56a1.12,1.12,0,0,0,1.12-1.12V46.38a3.09,3.09,0,1,1,6.18,0V55a5.2,5.2,0,0,1-5.19,5.19Z"/>
        <path class="cls-2" d="M4.91,79.52V22.08a1.63,1.63,0,0,1,.6-1.29A2.17,2.17,0,0,1,7,20.28a2.3,2.3,0,0,1,1.55.51,1.63,1.63,0,0,1,.6,1.29V60.62L31.29,41.2a1.41,1.41,0,0,1,1-.43,2.52,2.52,0,0,1,1.55.52,1.89,1.89,0,0,1,.09,2.83L20.63,55.72,36.1,78.4a1.8,1.8,0,0,1,.26.94,2.11,2.11,0,0,1-.64,1.46,2,2,0,0,1-1.5.69,1.75,1.75,0,0,1-1.46-.86L17.62,58.47l-8.5,7.39V79.52a1.75,1.75,0,0,1-.65,1.29,2.14,2.14,0,0,1-1.5.6,2.07,2.07,0,0,1-1.46-.56A1.76,1.76,0,0,1,4.91,79.52Z"/>
        <path class="cls-2" d="M40.31,70.58q0-6.44,5.11-9t14.91-2.54H65V56.84a14.75,14.75,0,0,0-2.71-8.89q-2.71-3.74-8.12-3.74a15.44,15.44,0,0,0-6.1,1.2q-2.84,1.2-2.92,1.2a1.58,1.58,0,0,1-1.38-.77,2.79,2.79,0,0,1-.51-1.55q0-1.46,3.57-2.71a22.65,22.65,0,0,1,7.52-1.25Q62,40.34,65.57,45a18.78,18.78,0,0,1,3.61,11.81V79.52a1.76,1.76,0,0,1-.6,1.33,2.19,2.19,0,0,1-2.92,0,1.75,1.75,0,0,1-.6-1.33V75.4q-5.67,6.53-12.89,6.53A12.54,12.54,0,0,1,43.62,79Q40.31,76.17,40.31,70.58Zm4.21-.17a7.18,7.18,0,0,0,2.28,5.8,8.91,8.91,0,0,0,6,1.93A13,13,0,0,0,61.06,75Q65,71.87,65,68.87V62.51H60.76a61.65,61.65,0,0,0-6.19.26,28,28,0,0,0-5,1,7.11,7.11,0,0,0-3.78,2.41A6.77,6.77,0,0,0,44.52,70.41Z"/><path class="cls-2" d="M80,69.12V23a1.58,1.58,0,0,1,.65-1.29,2.21,2.21,0,0,1,1.42-.51,2.33,2.33,0,0,1,1.5.51A1.58,1.58,0,0,1,84.21,23V40.86H95.64a1.47,1.47,0,0,1,1.16.56,2,2,0,0,1,.47,1.33A1.79,1.79,0,0,1,96.76,44a1.51,1.51,0,0,1-1.12.56H84.21V69.12q0,4.55,2,6.44t6.87,1.89h2.15a1.91,1.91,0,0,1,2,2,2,2,0,0,1-.56,1.38,1.86,1.86,0,0,1-1.42.6H93.06Q80,81.41,80,69.12Z"/>
        <path class="cls-2" d="M128.54,66.2V42.66a1.64,1.64,0,0,1,.65-1.25,2.23,2.23,0,0,1,1.5-.56,2.13,2.13,0,0,1,1.42.56,1.63,1.63,0,0,1,.64,1.25V66.2a11.55,11.55,0,0,0,3.39,8.21,11,11,0,0,0,16.24,0,11.55,11.55,0,0,0,3.4-8.21V42.57a1.51,1.51,0,0,1,.64-1.2,2.33,2.33,0,0,1,1.5-.52,2.17,2.17,0,0,1,1.46.52,1.55,1.55,0,0,1,.6,1.2V66.2a15.92,15.92,0,0,1-15.72,15.72,15,15,0,0,1-11.08-4.73A15.22,15.22,0,0,1,128.54,66.2Z"/>
        <path class="cls-2" d="M168.33,76.08a2.23,2.23,0,0,1,.47-1.33,1.34,1.34,0,0,1,1.07-.64,2,2,0,0,1,1.38.6l2,1.37a13.22,13.22,0,0,0,3.18,1.38,15.75,15.75,0,0,0,4.81.69q4.81,0,7.13-1.85a5.82,5.82,0,0,0,2.32-4.77,7,7,0,0,0-2.19-5.44,13.67,13.67,0,0,0-5.3-2.93l-6.32-1.91A12.08,12.08,0,0,1,171.46,58a8.76,8.76,0,0,1-2.19-6.27,11.06,11.06,0,0,1,3.31-7.9q3.3-3.43,9.75-3.44a22.18,22.18,0,0,1,7.52,1.25q3.48,1.25,3.48,2.62a2.43,2.43,0,0,1-.6,1.46,1.67,1.67,0,0,1-1.29.77q-.09,0-3-1.16a16.16,16.16,0,0,0-6-1.16q-4.64,0-6.92,2.32a7.2,7.2,0,0,0-2.28,5.15,5.35,5.35,0,0,0,2.19,4.55,17.24,17.24,0,0,0,5.35,2.59l6.36,1.93a11.06,11.06,0,0,1,5.39,3.6,10.63,10.63,0,0,1,2.19,7,9.49,9.49,0,0,1-3.52,7.82q-3.52,2.83-9.88,2.83A19.94,19.94,0,0,1,172.06,80Q168.33,78.06,168.33,76.08Z"/>
        <path class="cls-2" d="M108.61,81.41h-2.15a1.86,1.86,0,0,1-1.42-.6,2,2,0,0,1-.56-1.38,1.91,1.91,0,0,1,2-2h2.15q4.9,0,6.87-1.89t2-6.44V44.55H106a1.51,1.51,0,0,1-1.12-.56,1.79,1.79,0,0,1-.52-1.25,2,2,0,0,1,.47-1.33,1.47,1.47,0,0,1,1.16-.56h11.43V23a1.59,1.59,0,0,1,.64-1.29,2.33,2.33,0,0,1,1.5-.51,2.22,2.22,0,0,1,1.42.51,1.59,1.59,0,0,1,.64,1.29V69.12Q121.67,81.41,108.61,81.41Z"/>
        </svg>
      </div>

    </header>

    <nav>

      <ul class="nav-first">


        <li class="bt bt-nav <?php if ($flag_friends) echo 'selected' ?>">

          <div class="icon-nav">
            <svg
              viewBox="0 0 100 100">
              <path class="cls-1" d="M50,53.9A19.68,19.68,0,0,0,69.66,34.24v-4.5a19.66,19.66,0,0,0-39.31,0v4.5A19.68,19.68,0,0,0,50,53.9ZM33.64,29.74a16.36,16.36,0,0,1,32.72,0v4.5a16.36,16.36,0,0,1-32.72,0Z"/>
              <path class="cls-1" d="M68,59.75H64.23a1.64,1.64,0,0,0-1.4.78C59.67,65.67,55,68.61,50,68.61s-9.67-2.94-12.82-8.07a1.64,1.64,0,0,0-1.4-.78H32c-8.51,0-15.11,8.07-15.11,15v9.75a5.41,5.41,0,0,0,5.4,5.4H77.78a5.39,5.39,0,0,0,5.38-5.38V74.76A15.49,15.49,0,0,0,79,64.93,14.66,14.66,0,0,0,68,59.75ZM79.86,86.62H20.14V74.76C20.14,70.79,24.31,63,32,63h2.87l.86,1.14c3.75,5,8.83,7.72,14.32,7.72s10.58-2.74,14.32-7.72L65.18,63H68c7.64,0,11.82,7.74,11.82,11.71Z"/>
            </svg>
          </div>

          <ul class="nav-second channels private <?php if ($flag_friends) echo 'active' ?>">
            <li class="form-add">
              <?php if (isset($message_error_friend)): ?>
                <p class="error" role="alert"><?php echo $message_error_friend; ?></p>
              <?php endif; ?>
              <?php if (isset($message_validate_friend)): ?>
                <p class="validate" role="alert"><?php echo $message_validate_friend; ?></p>
              <?php endif; ?>
              <form id="addFriend" method="post" action="index.php?action=chat&param=addFriend">
                <input type="text" name="pseudo" placeholder="ajouter un ami ici">
                <div class="bt-submit ico-plus" data-form="addFriend">
                  <svg
                    viewBox="0 0 100 100">
                    <circle r="40" cx="50" cy="50" fill="#fdc67a"></circle>
                    <path fill="#780E3B" d="M73.08,48.15H51.85V27.85a1.85,1.85,0,0,0-3.69,0V48.15H26.92a1.85,1.85,0,0,0,0,3.69H48.15V74a1.85,1.85,0,1,0,3.69,0V51.85H73.08a1.85,1.85,0,0,0,0-3.69Z"/>
                  </svg>
                </div>
                <button type="submit" name="button" class="hidden">Valider</button>
              </form>
            </li>
            <?php foreach ($channels_private as $channel) : ?>
              <?php $channel->get_list()?>
            <?php endforeach; ?>
          </ul>
        </li>


        <li class="bt bt-nav <?php if ($flag_channel) echo 'selected' ?>">
          <div class="icon-nav">
            <svg viewBox="0 0 100 100">
              <path fill="#FFF" d="M50,86.27a7.63,7.63,0,0,0,7.62-7.62V77.11a7.62,7.62,0,1,0-15.24,0v1.55A7.63,7.63,0,0,0,50,86.27Zm-4.77-9.17a4.77,4.77,0,1,1,9.54,0v1.55a4.77,4.77,0,0,1-9.54,0Z"/>
              <path fill="#FFF" d="M56.21,86.57H54.89a1.43,1.43,0,0,0-1.21.68A4.45,4.45,0,0,1,50,89.62a4.45,4.45,0,0,1-3.68-2.37,1.43,1.43,0,0,0-1.21-.68H43.79a6.37,6.37,0,0,0-6.06,6v3.35a2.72,2.72,0,0,0,2.72,2.72H59.56A2.71,2.71,0,0,0,62.27,96V92.59a6.2,6.2,0,0,0-1.65-4A5.89,5.89,0,0,0,56.21,86.57Zm3.21,9.24H40.58V92.59a3.53,3.53,0,0,1,3.21-3.17h.56l0,0a6.75,6.75,0,0,0,11.22,0l0,0h.56a3.53,3.53,0,0,1,3.21,3.17Z"/>
              <path fill="#FFF" d="M50,18.12a7.63,7.63,0,0,0,7.62-7.62V9A7.62,7.62,0,1,0,42.38,9V10.5A7.63,7.63,0,0,0,50,18.12ZM45.23,9a4.77,4.77,0,0,1,9.54,0V10.5a4.77,4.77,0,0,1-9.54,0Z"/>
              <path fill="#FFF" d="M56.21,18.42H54.89a1.43,1.43,0,0,0-1.21.68A4.45,4.45,0,0,1,50,21.47a4.45,4.45,0,0,1-3.68-2.37,1.43,1.43,0,0,0-1.21-.68H43.79a6.36,6.36,0,0,0-6.06,6V27.8a2.72,2.72,0,0,0,2.72,2.72H59.56a2.71,2.71,0,0,0,2.71-2.71V24.44a6.2,6.2,0,0,0-1.65-4A5.89,5.89,0,0,0,56.21,18.42Zm3.21,9.24H40.58V24.44a3.53,3.53,0,0,1,3.21-3.17h.56l0,0a6.75,6.75,0,0,0,11.22,0l0,0h.56a3.53,3.53,0,0,1,3.21,3.17Z"/>
              <path fill="#FFF" d="M87.17,52.2a7.63,7.63,0,0,0,7.62-7.62V43a7.62,7.62,0,1,0-15.24,0v1.55A7.63,7.63,0,0,0,87.17,52.2ZM82.4,43a4.77,4.77,0,1,1,9.54,0v1.55a4.77,4.77,0,1,1-9.54,0Z"/>
              <path fill="#FFF" d="M93.38,52.5H92.07a1.41,1.41,0,0,0-1.21.68,4,4,0,0,1-7.36,0,1.43,1.43,0,0,0-1.21-.68H81a6.37,6.37,0,0,0-6.06,6v3.35a2.72,2.72,0,0,0,2.71,2.72H96.73a2.71,2.71,0,0,0,2.71-2.71V58.52a6.2,6.2,0,0,0-1.65-4A5.89,5.89,0,0,0,93.38,52.5Zm3.21,9.24H77.75V58.52A3.53,3.53,0,0,1,81,55.35h.56l0,0a6.75,6.75,0,0,0,11.22,0l0,0h.56a3.53,3.53,0,0,1,3.21,3.17Z"/>
              <path fill="#FFF" d="M12.83,52.2a7.63,7.63,0,0,0,7.62-7.62V43A7.62,7.62,0,1,0,5.21,43v1.55A7.63,7.63,0,0,0,12.83,52.2ZM8.06,43a4.77,4.77,0,1,1,9.54,0v1.55a4.77,4.77,0,1,1-9.54,0Z"/>
              <path fill="#FFF" d="M25.09,58.52a6.2,6.2,0,0,0-1.65-4A5.89,5.89,0,0,0,19,52.5H17.72a1.43,1.43,0,0,0-1.21.68,4.45,4.45,0,0,1-3.68,2.37,4.45,4.45,0,0,1-3.68-2.37,1.41,1.41,0,0,0-1.21-.68H6.62a6.37,6.37,0,0,0-6.06,6v3.35a2.72,2.72,0,0,0,2.72,2.72H22.38a2.71,2.71,0,0,0,2.71-2.71Zm-2.85,3.22H3.41V58.52a3.53,3.53,0,0,1,3.21-3.17h.56l0,0a7,7,0,0,0,5.61,3,7,7,0,0,0,5.61-3l0,0H19a3.53,3.53,0,0,1,3.21,3.17Z"/>
              <path fill="#FFF" d="M35.36,85.09A37.55,37.55,0,0,1,17.27,68.68,1.42,1.42,0,1,0,14.77,70,40.41,40.41,0,0,0,34.24,87.71a1.42,1.42,0,1,0,1.12-2.62Z"/>
              <path fill="#FFF" d="M84,67.94a1.46,1.46,0,0,0-.4.06,1.42,1.42,0,0,0-.85.68A37.55,37.55,0,0,1,64.64,85.09a1.42,1.42,0,1,0,1.12,2.62A40.4,40.4,0,0,0,85.23,70,1.42,1.42,0,0,0,84,67.94Z"/>
              <path fill="#FFF" d="M61.94,15.43a37.41,37.41,0,0,1,19.93,16A1.42,1.42,0,0,0,84.3,29.9,40.26,40.26,0,0,0,62.85,12.73a1.42,1.42,0,1,0-.91,2.7Z"/>
              <path fill="#FFF" d="M16.92,32.06a1.42,1.42,0,0,0,1.22-.68,37.41,37.41,0,0,1,19.93-16,1.42,1.42,0,1,0-.91-2.7A40.27,40.27,0,0,0,15.7,29.9a1.42,1.42,0,0,0,1.21,2.17Z"/>
            </svg>
          </div>

          <ul class="nav-second channels public <?php if ($flag_channel) echo 'active' ?>">
            <li class="form-add">
              <?php if (isset($message_error_channel)): ?>
                <p class="error" role="alert"><?php echo $message_error_channel; ?></p>
              <?php endif; ?>
              <?php if (isset($message_validate_channel)): ?>
                <p class="valide" role="alert"><?php echo $message_validate_channel; ?></p>
              <?php endif; ?>
              <form id="addChannel" method="post" action="index.php?action=chat&param=addChannel">
                <input type="text" name="channelName" placeholder="ajouter un salon ici">
                <div class="bt-submit ico-plus" data-form="addChannel">
                  <svg
                    viewBox="0 0 100 100">
                    <circle r="40" cx="50" cy="50" fill="#fdc67a"></circle>
                    <path fill="#780E3B" d="M73.08,48.15H51.85V27.85a1.85,1.85,0,0,0-3.69,0V48.15H26.92a1.85,1.85,0,0,0,0,3.69H48.15V74a1.85,1.85,0,1,0,3.69,0V51.85H73.08a1.85,1.85,0,0,0,0-3.69Z"/>
                  </svg>
                </div>
                <button type="submit" name="button" class="hidden">Valider</button>
              </form>

            </li>
            <?php foreach ($channels_public as $channel) : ?>
              <?php $channel->get_list()?>
            <?php endforeach; ?>
          </ul>
        </li>


        <li class="bt bt-nav bt-notification">
          <div class="icon-nav">
            <svg viewBox="0 0 100 100">
              <path fill="#fff" d="M49.67.65A49.67,49.67,0,1,0,99.35,50.33,49.67,49.67,0,0,0,49.67.65Zm0,96A46.36,46.36,0,1,1,96,50.33,46.36,46.36,0,0,1,49.67,96.69Z"/>
              <path fill="#fff" d="M74.53,61a6.11,6.11,0,0,0-4.67-2.35c-1-.4-3.63-1.66-3.63-3.31V40.39A16.56,16.56,0,0,0,54.64,24.63V22.18a5,5,0,0,0-9.93,0V24.6a16.46,16.46,0,0,0-11.59,15.8v14.9c0,1-.94,1.82-1.74,2.35a10.34,10.34,0,0,1-1.87,1c-3.73.17-6.31,3.18-6.31,7.45v2.47a5,5,0,0,0,5,5H41.41a8.28,8.28,0,0,0,16.56,0H71.22a5,5,0,0,0,5-5V66.06A8.13,8.13,0,0,0,74.53,61ZM48,22.18a1.66,1.66,0,1,1,3.31,0v1.66H48V22.18Zm1.66,56.3a5,5,0,0,1-5-5h9.93A5,5,0,0,1,49.67,78.47Zm23.18-9.93A1.66,1.66,0,0,1,71.2,70.2H28.15a1.66,1.66,0,0,1-1.66-1.66V66.06c0-2,.88-4.14,3.31-4.14a1.66,1.66,0,0,0,.53-.08,13.44,13.44,0,0,0,2.88-1.44,6.13,6.13,0,0,0,3.21-5.1V40.39A13.35,13.35,0,0,1,46.71,27.48a13.73,13.73,0,0,1,5.89,0A13.25,13.25,0,0,1,62.92,40.39v14.9c0,4.37,5.48,6.33,6.09,6.54a1.65,1.65,0,0,0,.53.08A2.85,2.85,0,0,1,71.93,63a4.85,4.85,0,0,1,.93,3v2.48Z"/>
            </svg>
          </div>
          <div class="number bt-round">
            <p></p>
          </div>
          <ul class="nav-second" id="notifications">
            <notif-item
                v-for="notif in notifs"
                v-bind:notif="notif"
                v-bind:key="notif.id"
              ></notif-item>
          </ul>
        </li>


        <li class="bt bt-deco">
          <a href="index.php" class="deconnect icon-nav">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 100 100">
              <path class="ico-red" fill="#fff" d="M50,48.69a2.47,2.47,0,0,0,2.46-2.46v-42a2.46,2.46,0,1,0-4.93,0v42A2.47,2.47,0,0,0,50,48.69Z"/>
              <path class="ico-red" fill="#fff" d="M84.37,29A43.48,43.48,0,0,0,62.15,13.64a2.46,2.46,0,1,0-1.39,4.73,38.22,38.22,0,1,1-21.54,0,2.46,2.46,0,1,0-1.39-4.73A43.47,43.47,0,0,0,15.63,29,42.75,42.75,0,0,0,6.85,55a43.15,43.15,0,0,0,86.29,0A42.75,42.75,0,0,0,84.37,29Z"/>
            </svg>
          </a>
        </li>

      </ul>


    </nav>




    <!-- CHAT SALONS -->
    <?php foreach ($channels_public as $channel) : ?>
      <?php $channel->get_section() ?>
    <?php endforeach; ?>

    <?php foreach ($channels_private as $channel) : ?>
      <?php $channel->get_section() ?>
    <?php endforeach; ?>




  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://localhost:8080/socket.io/socket.io.js"></script>
  <script src="http://localhost:8888/ECVDigital/Workshop/dest/lib/jquery.ajax.min.js"></script>
  <script src="http://localhost:8888/ECVDigital/Workshop/dest/assets/js/all.js"></script>


</body>
</html>
