<?php

    session_start();
    include 'dbconnect.php';
    date_default_timezone_set("Europe/Bucharest"); // USAGE: date("H:i:s"); - H - hour(24), i - minutes, s - seconds

    $chat_message = $_POST['chat_text'];
    $message_time = date("H:i:s");
    $username = $_SESSION['username'];

    $isMessage = True;

    // verificare mesaj



    // trimitere mesaj in baza de date
    if($isMessage) {
      $sql = "INSERT INTO chat_message (user_message, message_time, user) VALUES ('$chat_message', '$message_time', '$username')";
      if ($link->query($sql) === TRUE)
      {
        echo "New message record created successfully";
        //header("Location: index.php");
      }
      else
        echo "ERROR 4: " . $sql . "<br>" . $link->error;
    }

    // Inchidere conexiune
    mysqli_close($link);
?>
