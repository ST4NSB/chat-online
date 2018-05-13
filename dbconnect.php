<?php
  $host="localhost";
  $user="root";
  $pass="";
  $db="mychat";

  $link = mysqli_connect($host, $user, $pass, $db);
  if ($link->connect_error) {
      die("ERROR: Connection failed: " . $link->connect_error);
  }

?>
