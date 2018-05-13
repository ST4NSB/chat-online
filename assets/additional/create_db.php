<?php

  include 'dbconnect.php';

  // Creaza baza de date
  $sql = 'CREATE DATABASE mychat';

  if (mysqli_query($link, $sql)) {
    echo 'Database created successfully';
  } else {
    echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);
  }

  // Inchidere conexiune
  mysqli_close($link);

?>
