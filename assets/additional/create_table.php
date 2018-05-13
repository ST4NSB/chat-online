<?php
  include 'dbconnect.php';

  // Creaza tabela
  $sql1 = 'CREATE TABLE chat_user(
    id_user INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
    username VARCHAR(30),
    email VARCHAR(30),
    chat_rank INT,
    password VARCHAR(100)
  )';

  $sql2 = 'CREATE TABLE chat_message(
    id_message INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
    user_message VARCHAR(100),
    message_time TIME,
    user_id INT
  )';

  if (mysqli_query($link, $sql1)) {
    echo 'Table chat_user created successfully.';
  } else {
    echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);
  }

  if (mysqli_query($link, $sql2)) {
    echo 'Table chat_message created successfully.';
  } else {
    echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);
  }

  // Inchidere conexiune
  mysqli_close($link);

?>
