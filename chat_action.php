<?php

    session_start();
    include 'dbconnect.php';

    
    $username = $_SESSION['username'];
    $chat_message = $_POST['chat_text'];

    echo "user: " . $username . ", message: " . $chat_message;
    header("Location: index.php");

?>
