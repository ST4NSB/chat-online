<?php
  session_start();
  session_unset();
  session_destroy();
  $_SESSION['$isUserLogged'] = False;

  header("location: login.php");
  exit();
?>
