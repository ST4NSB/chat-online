<?php
    session_start();
    include 'dbconnect.php';

    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $rank = $_POST['edit_rank'];
    $password = $_POST['edit_password'];
    $password  = md5($password);

    $old_username = "";
    $sql = "SELECT username FROM chat_user";
    if ($result = mysqli_query($link, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          if(strpos($fullUrl, $row['username']) == true)
            $old_username = $row['username'];
        }
      }
    }

    $sql2 = "UPDATE chat_user SET username='$username', email='$email', chat_rank='$rank', password='$password' WHERE username='$old_username'";
    if ($link->query($sql2) === TRUE)
    {
      //echo "New record edited successfully";
      if($_SESSION['username'] == $old_username)
        $_SESSION['username'] = $username;
      header("Location: adminpanel.php?useredited");
    }
    else
      echo "ERROR 9: " . $sql2 . "<br>" . $link->error;

  // Inchidere conexiune
  mysqli_close($link);


?>
