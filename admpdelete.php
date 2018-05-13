<?php
    include 'dbconnect.php';

    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $sql = 'SELECT username FROM chat_user';
    if ($result = mysqli_query($link, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $usern = $row['username'];
          if(strpos($fullUrl, $usern) == true) {
            $sql = "DELETE FROM chat_user WHERE username='$usern'";
            if ($link->query($sql) === TRUE)
            {
              //echo "Deleted successfully";
              header("Location: adminpanel.php");
            }
            else { echo "ERROR 7: " . $sql . "<br>" . $link->error; }
          }
        }
      }
    }

?>
