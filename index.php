<?php
  session_start();
  if(!isset($_SESSION['$isUserLogged']))
    $_SESSION['$isUserLogged'] = False;
  $_SESSION['currentpg'] = "home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/formstyle.css">
</head>

<body>
  <?php
    if($_SESSION['$isUserLogged'])
      include "loggednavbar.php";
    else include "navbar.php";
    include "footer.html";
  ?>

  <main class="main__content">
    <form class="form__chat" action="chat_action.php" method="post">
      <div class="chatbox">

        <div class="chatlogs">

          <!--
          <div class="chat friend">
            <p class="chat-message">12:40 [Michael] <br> hi</p>
          </div>

          <div class="chat self">
            <p class="chat-message">12:48 [Me] <br> hi</p>
          </div> -->

          <?php
            include 'dbconnect.php';

            $sql_order = "SELECT * FROM chat_message ORDER BY id_message;";
            $result = $link->query($sql_order);

            $sql = 'SELECT user_message, message_time, user FROM chat_message';
            if ($result = mysqli_query($link, $sql)) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  echo $row['user_message'] . '<br>';
                  echo $row['message_time'] . '<br>';
                  echo $row['user'] . '<br>';
              }
              // Eliberare rezultat
              mysqli_free_result($result);
            } else {
              echo 'No records matching your query were found.';
            }
          } else {
            echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);
          }



            // Inchidere conexiune
            mysqli_close($link);
          ?>

        </div>


        <div class="chat-form">
          <textarea maxlength="100" required
          <?php
            if(!$_SESSION['$isUserLogged']) {
              echo 'disabled placeholder="Login to access the chat"';
            }
            else {
              echo 'placeholder="Type your message here.."';
            }?> type="text" id="chat_text" name="chat_text"></textarea>
          <button <?php if(!$_SESSION['$isUserLogged']) echo "disabled"; ?> id="sendbtn" type="submit">SEND</button>
        </div>

      </div>
    </form>
  </main>


</body>

</html>
