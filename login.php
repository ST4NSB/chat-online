<?php
  session_start();
  $_SESSION['currentpg'] = "login";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/loginstyle.css">
</head>

<body>

  <?php
    include "navbar.php";
    include "footer.html";
  ?>

  <main class="main__login">
    <form class="form__login" action="login_form.php" method="post">
      <div class="login__window">

        <div class="login__topside"></div>
        <div class="login__content">

          <h1>LOG IN</h1>
          <div class="login__failmessage">
            <?php
              $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              if(strpos($fullUrl, "log_error") == true)
              {
                  echo 'Username or password is not correct!';
              }
              if(strpos($fullUrl, "pas_error") == true)
              {
                  echo 'Your password is not correct!';
              }
            ?>
          </div>
          <div class="login__username">
            <label for="username">Username</label>
            <input id="log_username" name="log_username" type="text" maxlength="30" required>
          </div>
          <div class="login__password">
            <label for="password">Password</label>
            <input id="log_password" name="log_password" type="password" maxlength="30" required>
          </div>
          <div class="login__registermsg">
            Don't have an account? <a class="login__link" href="register.php">REGISTER</a>
          </div>
          <div class="login__button">
            <button type="submit">Login</button>
          </div>
        </div>

      </div>
    </form>
  </main>

</body>

</html>
