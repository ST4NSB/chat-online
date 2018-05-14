<?php


    include 'dbconnect.php';

    $username = filter_input(INPUT_POST, 'cu_username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'cu_email', FILTER_SANITIZE_EMAIL);
    $rank = filter_input(INPUT_POST, 'cu_rank', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'cu_password', FILTER_SANITIZE_STRING);
    $password  = md5($password);

    $sql = "INSERT INTO chat_user (username, email, chat_rank, password) VALUES ('$username', '$email', '$rank', '$password')";
    if ($link->query($sql) === TRUE)
    {
      //echo "New record created successfully";
      header("Location: adminpanel.php?usercreated");
    }
    else
      echo "ERROR: " . $sql . "<br>" . $link->error;

  // Inchidere conexiune
  mysqli_close($link);

?>
