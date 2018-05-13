<?php


    include 'dbconnect.php';

    $username = $_POST['cu_username'];
    $email = $_POST['cu_email'];
    $rank = $_POST['cu_rank'];
    $password = $_POST['cu_password'];
    $password  = md5($password);

    $sql = "INSERT INTO chat_user (username, email, chat_rank, password) VALUES ('$username', '$email', '$rank', '$password')";
    if ($link->query($sql) === TRUE)
    {
      //echo "New record created successfully";
      header("Location: adminpanel.php?usercreated");
    }
    else
      echo "ERROR 8: " . $sql . "<br>" . $link->error;

  // Inchidere conexiune
  mysqli_close($link);

?>
