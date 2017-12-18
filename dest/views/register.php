<?php
  var_dump($message_error_register);

  if ($statut_register)
    header("Location: index.php?message=$message_account_created&action=login_form");
  else
    header("Location: index.php?message=$message_error_register&action=register_form");
