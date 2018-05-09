<?php
  session_start();
  $_SESSION['currentpg'] = "register";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/registerstyle.css">
</head>

<body>

  <?php
    include "navbar.php";
    include "footer.html";
  ?>

  <main class="main__register">
    <form class="form__register">
      <div class="register__window">

        <div class="register__topside"></div>
        <div class="register__content">

          <h1>REGISTER</h1>
          <div class="register__failmessage"></div>
          <div class="register__inputs">
            <input placeholder="Create a username.." id="username" name="username" type="text" maxlength="30" required>
            <input placeholder="Type your e-mail address.." id="email" name="email" type="email" maxlength="30" required>
            <input id="password" name="password" type="password" placeholder="Create a password.." maxlength="30" required>
            <input id="passwordconf" name="passwordconf" type="password" placeholder="Confirm password.." maxlength="30" required>
          </div>
          <div class="register__button">
            <button type="submit">Sign up</button>
          </div>
        </div>

      </div>
    </form>
  </main>

</body>
