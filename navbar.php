<?php
  $isActive = $_SESSION['currentpg'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>navigation bar</title>
  <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
</head>

<body>
  <header class="header">
    <img class="header__logo" src="assets/images/headerlogo.png" alt="Logo">
    <nav class="nav">
      <ul class="nav__wrapper">
        <li class="nav__item"><a href="index.php" <?php if($isActive === "home") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>Home</a></li>
        <li class="nav__item"><a href="about.php" <?php if($isActive === "about") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>About</a></li>

        <li class="nav__item"><a href="register.php" <?php if($isActive === "register") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>Register</a></li>
        <li class="nav__item"><a href="login.php" <?php if($isActive === "login") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>Login</a></li>
      </ul>
    </nav>
  </header>
</body>
</html>
