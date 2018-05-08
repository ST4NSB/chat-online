<?php
  $isActive = $_SESSION['currentpg'];
  $username = "user1";
?>

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/navbarlogged.css">
</head>

<body>
  <header class="header">
    <img class="header__logo" src="assets/images/headerlogo.png" alt="Logo">
    <nav class="nav">
      <ul class="nav__wrapper">
        <li class="nav__item"><a href="index.php" <?php if($isActive === "home") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>Home</a></li>
        <li class="nav__item"><a href="about.php" <?php if($isActive === "about") echo 'class="nav__link active"'; else echo 'class="nav__link"'; ?>>About</a></li>

        <li id="timeofday" class="nav__item__logged"></li>
      </ul>
  </header>

  <script>
    // client side clock
    var time = new Date();
    var hour = time.getHours();
    console.log("Your actual hour is: " + hour);
    var jsusername = '<?php echo $username;?>';
    var createspan = document.createElement('span');
    createspan.className = "myusername";
    createspan.innerHTML = jsusername;

    var message = "";
    if((hour >= 22 && hour <= 24) || (hour >= 1 && hour <= 6) )
      message = "Good night, ";
    if(hour >= 7 && hour <= 12)
      message = "Good morning, ";
    if(hour >= 13 && hour <= 18)
      message = "Good afternoon, ";
    if(hour >= 19 && hour <= 21)
      message = "Good evening, ";

    document.getElementById('timeofday').innerHTML = message;
    document.getElementById('timeofday').appendChild(createspan);
  </script>

</body>
