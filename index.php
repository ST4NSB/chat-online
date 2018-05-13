<?php
  session_start();
  if(!isset($_SESSION['$isUserLogged']))
    $_SESSION['$isUserLogged'] = False;
  if(!isset($_SESSION['username']))
    $_SESSION['username'] = "none";

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

        <div id="chatData" class="chatlogs">

          <?php
            include 'dbconnect.php';

            $sql = 'SELECT id_message, user_message, message_time, user_id FROM chat_message ORDER BY id_message ASC';
            if ($result = mysqli_query($link, $sql)) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  $msgtime = $row['message_time'];
                  $thismsg = $row['user_message'];
                  $iduser = $row['user_id'];
                  $sqlc = "SELECT username FROM chat_user WHERE id_user='$iduser'";
                  if ($result2 = mysqli_query($link, $sqlc)) {
                    if (mysqli_num_rows($result2) > 0) {
                      while ($row = mysqli_fetch_array($result2)) {
                        if($row['username'] === $_SESSION['username']) {
                          echo '<div class="chat self">';
                            echo '<p class="chat-message"> <span class="selfchatname">' . $row['username'] . '<span class="space"></span> (' . $msgtime . ')</span><br>' . $thismsg . '</p>';
                          echo '</div>';
                        }
                        else {
                          echo '<div class="chat friend">';
                            echo '<p class="chat-message"> <span class="friendchatname">' . $row['username'] . '<span class="space"></span> (' . $msgtime . ')</span><br>' . $thismsg . '</p>';
                          echo '</div>';
                        }
                      }
                    }
                  }
                  else echo 'ERROR 5: Could not able to execute ' . $sql . mysqli_error($link);
              }
              // Eliberare rezultat
              mysqli_free_result($result);
            }
          }
          else echo 'ERROR 6: Could not able to execute ' . $sql . mysqli_error($link);

          // Inchidere conexiune
          mysqli_close($link);
        ?>

        <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(strpos($fullUrl, "info_error") == true)
            {
                echo '<script>
                  window.alert("Can\'t type this kind of thing in chat!");
                </script>';
            }
         ?>

        </div>


        <div id="inputArea" class="chat-form">
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


  <script>
    // scrollul in josul paginii
    var objDiv = document.getElementById("chatData");
    objDiv.scrollTop = objDiv.scrollHeight;

    // mesaj trimis la enter

    document.getElementById('inputArea').addEventListener("keyup", function(event) {
      event.preventDefault();
      // 13 - enter code
      if (event.keyCode === 13) {
          document.getElementById("sendbtn").click();
      }
    });

  </script>

</body>

</html>
