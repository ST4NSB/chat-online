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
    <form class="form__chat" action="chat_action.php" method="get">
      <div class="chatbox">

        <div id="chatData" class="chatlogs">

          <?php
            include 'dbconnect.php';

            $sql = 'SELECT m.id_message , m.user_message, m.message_time, m.user_id, u.username FROM chat_message m LEFT JOIN chat_user u ON m.user_id = u.id_user ORDER BY m.id_message ASC';
            if ($result = mysqli_query($link, $sql)) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  $msgtime = $row['message_time'];
                  $thismsg = $row['user_message'];
                  $usermsg = $row['username'];
                  if($usermsg === $_SESSION['username']) {
                    echo '<div class="chat self">';
                      echo '<p class="chat-message"> <span class="selfchatname">' . $usermsg . '<span class="space"></span> (' . $msgtime . ')</span><br>' . $thismsg . '</p>';
                    echo '</div>';
                  }
                  else {
                    echo '<div class="chat friend">';
                      echo '<p class="chat-message"> <span class="friendchatname">' . $usermsg . '<span class="space"></span> (' . $msgtime . ')</span><br>' . $thismsg . '</p>';
                    echo '</div>';
                  }
                }
              // Eliberare rezultat
              mysqli_free_result($result);
            }
          }
          else echo 'ERROR: Could not able to execute ' . $sql . mysqli_error($link);

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

    // setare focus pe txt box
    document.getElementById("chat_text").focus();

    // scrollul in josul paginii
    var objDiv = document.getElementById("chatData");
    objDiv.scrollTop = objDiv.scrollHeight;

    // mesaj trimis la enter
    document.getElementById('inputArea').addEventListener("keyup", function(event) {
      event.preventDefault();
      // 13 - enter code
      if (event.keyCode === 13) {
          document.getElementById("sendbtn").click(); // sau focus()
      }
    });

  </script>

</body>

</html>
