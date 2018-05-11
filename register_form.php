<?php
  session_start();
  include "dbconnect.php";

  // primire date
  $userName = $_POST['reg_username'];
  $eMail = $_POST['reg_email'];
  $chatRank = 1;
  $userPass = $_POST['reg_password'];
  $userconfPass = $_POST['reg_passwordconf'];

  $continue = True;

  if (strpos($userName, '\'') !== false || strpos($userName, '\n') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, '<') !== false || strpos($userName, '>') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, 'SELECT') !== false || strpos($userName, 'select') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, 'INSERT') !== false || strpos($userName, 'insert') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, 'UPDATE') !== false || strpos($userName, 'update') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, 'DELETE') !== false || strpos($userName, 'delete') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userName, 'DROP') !== false || strpos($userName, 'drop') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }

  if (strpos($userPass, '\'') !== false || strpos($userPass, '\n') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, '<') !== false || strpos($userPass, '>') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, 'SELECT') !== false || strpos($userPass, 'select') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, 'INSERT') !== false || strpos($userPass, 'insert') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, 'UPDATE') !== false || strpos($userPass, 'update') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, 'DELETE') !== false || strpos($userPass, 'delete') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }
  if (strpos($userPass, 'DROP') !== false || strpos($userPass, 'drop') !== false) {
    $continue = False;
    header("Location: register.php?un_error");
  }


  // sa nu fie gol
  if (!strlen(trim($chat_message))) {
    $isMessage = False;
  }

  // verificare daca parola e la fel ca in confirm pass
  if($userPass != $userconfPass)
  {
    $continue = False;
    header("Location: register.php?pass_error");
  }

  // verificare daca parola e mai mare de 7 caractere
  $pwsize = strlen($userPass);
  if($pwsize < 7)
  {
    $continue = False;
    header("Location: register.php?passlow_error");
  }

  // nu lasa spatiu intre nume si parola
  if ($userName == trim($userName) && strpos($userName, ' ') !== false) {
    $continue = False;
    header("Location: register.php?space_error");
  }
  if ($userPass == trim($userPass) && strpos($userPass, ' ') !== false) {
    $continue = False;
    header("Location: register.php?space_error");
  }

  // verificare daca username e mai mic de 5 caractere
  $usersize = strlen($userName);
  if($usersize < 5)
  {
    $continue = False;
    header("Location: register.php?userlow_error");
  }

  // verificare prima litera sa inceapa cu o litera
  if (!ctype_alpha(substr($userName,0,1))) {
    $continue = False;
    header("Location: register.php?nruser_error");
  }

  // verificare daca username-ul e diferit
  $query = "SELECT * FROM chat_user WHERE username = '".$userName."'";
  $result = mysqli_query($link, $query);
  if(mysqli_num_rows($result) >= 1)
  {
    $continue = False;
    header("Location: register.php?exuser_error");
  }

  if($continue) {
    // transmitere username
    $_SESSION['username'] = $userName;
    $_SESSION['rank'] = $chatRank;

    // criptare parola
    $password  = md5($userPass);

    // Inserare date in database
    $sql = "INSERT INTO chat_user (username, email, chat_rank, password) VALUES ('$userName', '$eMail', '$chatRank', '$password')";
    if ($link->query($sql) === TRUE)
    {
      //echo "New record created successfully";
      $_SESSION['$isUserLogged'] = True;
      header("Location: index.php");
    }
    else
      echo "ERROR 2: " . $sql . "<br>" . $link->error;
  }

  // Inchidere conexiune
  mysqli_close($link);
?>
