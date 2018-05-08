<?php
  session_start();
  $_SESSION['currentpg'] = "about";
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About - Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/aboutstyle.css">
</head>

<body>

  <?php
    if($_SESSION['$isUserLogged'])
      include "loggednavbar.php";
    else include "navbar.php";
    include "footer.html";
  ?>

  <main class="about__main">
      <div class="about__mainwindow">
        <h1>Online Chat - About</h1>
        <ul class="about__text">
          <li>Real time online chat using database and php!</li>
          <li>Made for an university course project!</li>
          <li>Author: <span>Bărbulescu Adrian</span> (personal links in the footer)</li>
        </ul>
        <h2>Chat Commands</h2>
        <ul class="about__text">
          <li>TBA</li>
        </ul>
      </div>
  </main>

</body>
