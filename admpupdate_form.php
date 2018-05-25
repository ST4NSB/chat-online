<?php
    session_start();
    include 'dbconnect.php';

    $id = $_POST['id_user'];
    $username = filter_input(INPUT_POST, 'edit_username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'edit_email', FILTER_SANITIZE_EMAIL);
    $rank = filter_input(INPUT_POST, 'edit_rank', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'edit_password', FILTER_SANITIZE_STRING);
    //$password  = md5($password);

    $old_username = "";
    $sql = "SELECT username FROM chat_user WHERE id_user='$id'";
    if ($result = mysqli_query($link, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $old_username = $row['username'];
        }
      }
    }


    $sql2 = "UPDATE chat_user SET username='$username', email='$email', chat_rank='$rank', password='$password' WHERE id_user='$id'";
    if ($link->query($sql2) === TRUE)
    {
      //echo "New record edited successfully";
      if($_SESSION['username'] == $old_username)
        $_SESSION['username'] = $username;
      header("Location: adminpanel.php?useredited");
    }
    else
      echo "ERROR: " . $sql2 . "<br>" . $link->error;

  // Inchidere conexiune
  mysqli_close($link);


?>
