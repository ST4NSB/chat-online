<?php

    session_start();
    include 'dbconnect.php';
    date_default_timezone_set("Europe/Bucharest"); // USAGE: date("H:i:s"); - H - hour(24), i - minutes, s - seconds

    $chat_message = $_POST['chat_text'];
    $message_time = date("H:i:s");
    $username = $_SESSION['username'];
    $userRank = $_SESSION['rank'];

    $isMessage = True;

    // verificare mesaj
    if (strpos($chat_message, '\'') !== false || strpos($chat_message, '\n') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, '<') !== false || strpos($chat_message, '>') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, 'SELECT') !== false || strpos($chat_message, 'select') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, 'INSERT') !== false || strpos($chat_message, 'insert') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, 'UPDATE') !== false || strpos($chat_message, 'update') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, 'DELETE') !== false || strpos($chat_message, 'delete') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    if (strpos($chat_message, 'DROP') !== false || strpos($chat_message, 'drop') !== false) {
      $isMessage = False;
      header("Location: index.php?info_error");
    }
    // sa nu fie gol
    if (!strlen(trim($chat_message))) {
      $isMessage = False;
    }


    // comenzi care incep cu bara '/'
    if(substr($chat_message,0,1) === "/") {
      $chat_message = trim($chat_message);
      $msgsize = strlen($chat_message) - 1;
      $command = substr($chat_message, 1, $msgsize);
      // commands
      if(strcmp($command, "about") == 0) {
          $isMessage = False;
          header("Location: about.php");
      }
      if(strcmp($command, "logout") == 0) {
          $isMessage = False;
          header("Location: logout.php");
      }
    }


    // trimitere mesaj in baza de date
    if($isMessage) {
      $sql = "INSERT INTO chat_message (user_message, message_time, user) VALUES ('$chat_message', '$message_time', '$username')";
      if ($link->query($sql) === TRUE)
      {
      //  echo "New message record created successfully";
        header("Location: index.php");
      }
      else
        echo "ERROR 4: " . $sql . "<br>" . $link->error;
    }

    // Inchidere conexiune
    mysqli_close($link);
?>
