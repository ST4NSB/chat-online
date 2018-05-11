<?php
    session_start();
    include 'dbconnect.php';

    $userName = $_POST['log_username'];
    $passWord = $_POST['log_password'];
    $hashed_pass = md5($passWord);

    $sql = "SELECT * FROM chat_user WHERE username='$userName' and password='$passWord'"; // verificare parola ne-hashuita
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $_SESSION['$isUserLogged'] = True;
        $_SESSION['username'] = $row['username'];
        $_SESSION['rank'] = $row['chat_rank'];
        header("Location: index.php");
      }
      // Eliberare rezultat
      mysqli_free_result($result);
    }
    else {
      $sql2 = "SELECT * FROM chat_user WHERE username='$userName' and password='$hashed_pass'"; // verificare parola hashuita
      $result2 = $link->query($sql2);
      if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
          $_SESSION['$isUserLogged'] = True;
          $_SESSION['username'] = $row['username'];
          $_SESSION['rank'] = $row['chat_rank'];
          header("Location: index.php");
        }
        // Eliberare rezultat
        mysqli_free_result($result2);
      }
      else header("Location:login.php?log_error");
    }

    // Inchidere conexiune
    mysqli_close($link);

 ?>
