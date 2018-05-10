<?php
    session_start();
    include 'dbconnect.php';

    $userName = $_POST['log_username'];
    $passWord = $_POST['log_password'];

    $sql = "SELECT * FROM chat_user WHERE username='$userName' and password='$passWord'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $_SESSION['$isUserLogged'] = True;
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
      }}
    else header("Location:login.php?log_error");
 ?>
