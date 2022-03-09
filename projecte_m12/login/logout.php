<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /projecte_m12/index.html');
?>
