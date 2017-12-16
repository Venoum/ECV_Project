<?php



    if ($statut_login) {
      setcookie('id_user', $id_user);
      setcookie('pseudo_user', $pseudo);
      header('Location: index.php?action=chat');
    }

    else
      header("Location: index.php?message=$message_error_login&action=login_form");
