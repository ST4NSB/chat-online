<head>
  <link rel="stylesheet" type="text/css" href="assets/css/navbarlogged.css">
</head>

<header class="header">
  <img class="header__logo" src="assets/images/headerlogo.png" alt="Logo">
  <nav class="nav">
    <ul class="nav__wrapper">
      <li class="nav__item"><a
        <?php
        if($GLOBALS['currentpage'] == "home")
          echo 'class="active"';
          ?>href="index.html" class="nav__link">Home</a></li>
      <li class="nav__item"><a href="about.html" class="nav__link">About</a></li>
      <li class="nav__item"><a href="users.html" class="nav__link">Users</a></li>

      <li class="nav__item__logged">
        <?php
          $timeofday = "Good night, ";
          echo "$timeofday";
        ?>
        <span class="myusername">
          <?php
            $username = "user1";
            echo "$username";
          ?>
        </span></li>
    </ul>
</header>;
