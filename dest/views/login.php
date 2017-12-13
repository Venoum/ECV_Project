<?php


    if ($statut_login)
      header('Location: index.php?action=chat');
    else
      header('Location: index.php?action=login_form&message=' + $message_error_login);
