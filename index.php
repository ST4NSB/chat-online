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
    $_SESSION['currentpg'] = "home";
    $isUserLogged = True;
    if($isUserLogged)
      include "loggednavbar.php";
    else include "navbar.php";
    include "footer.html";
  ?>

  <main class="main__content">
    <form class="form__chat">
      <div class="chatbox">

        <div class="chatlogs">

          <div class="chat friend">
            <p class="chat-message">12:40 [Michael] <br> hi</p>
          </div>

          <div class="chat self">
            <p class="chat-message">12:48 [Me] <br> hi</p>
          </div>

        </div>


        <div class="chat-form">
          <textarea disabled id="mytxt" placeholder="Login to access the chat"></textarea>
          <button disabled id="sendbtn" type="button">SEND</button>
        </div>

      </div>
    </form>
  </main>


</body>

</html>
