<?php



  if ($statut_register)
    header('Location: index.php?action=chat');
  else
    header('Location: index.php?action=register_form&message=' + $message_error_register);
