<?php
    include 'dbconnect.php';

    $id = $_GET['id_user'];

    $sql = "DELETE FROM chat_message WHERE user_id='$id'"; // deleting user messages
    if ($link->query($sql) === TRUE)
    {
      $sql2 = "DELETE FROM chat_user WHERE id_user='$id'"; // deleting user
      if ($link->query($sql2) === TRUE)
        header("Location: adminpanel.php");
      else echo "ERROR: " . $sql2 . "<br>" . $link->error;
    }
    else echo "ERROR: " . $sql . "<br>" . $link->error;

?>
