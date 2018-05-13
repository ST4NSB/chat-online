<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN panel - Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/adminpanelstyle.css">
</head>

<body>
  <main class="ap__main">
    <h1>Users</h1>
    <?php
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          echo '<div class="grid__main">';
          include 'dbconnect.php';
          $sql = 'SELECT * FROM chat_user';
          if ($result = mysqli_query($link, $sql)) {
            $iter = 1;
            if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="grid__item">' . $iter . '.' . $row['username'] . '</div>';
                if($row['chat_rank'] == 1) $urank = "User"; else $urank = "Admin";
                if(strpos($fullUrl, "command") == true) echo '<div class="grid__item">' . $urank . '</div>';
                if(strpos($fullUrl, "command") == true) echo '<div class="grid__item">' . $row['email'] . '</div>';
                if(strpos($fullUrl, "command") != true){
                  echo '<div class="grid__item"><a href="admpupdate.php?' . $row['username'] . '" class="ap__links">Edit</a></div>';
                  if ($_SESSION['username'] != $row['username']) echo '<div class="grid__item"><a href="admpdelete.php?' . $row['username'] . '" class="ap__links">Delete</a></div>'; else echo '<br>';
                }
                $iter++;
              }
            // Eliberare rezultat
            mysqli_free_result($result);
          } else {
            echo 'No users found';
          }
          } else {
          echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);
          }

          // Close connection
          mysqli_close($link);
          echo '</div>';
    ?>
    <div class="major__links">
      <?php if(strpos($fullUrl, "command") != true) echo '<a href="adduser.html" class="ap__links">Add</a>'; ?>
      <a href="index.php" class="ap__links">Back</a>
    </div>
  </main>

</body>
