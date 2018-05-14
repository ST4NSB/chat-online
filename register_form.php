<?php
  session_start();
  include "dbconnect.php";


  $userName = filter_input(INPUT_POST, 'reg_username', FILTER_SANITIZE_STRING);
  $eMail = filter_input(INPUT_POST, 'reg_email', FILTER_SANITIZE_EMAIL);
  $chatRank = 1;
  $userPass = filter_input(INPUT_POST, 'reg_password', FILTER_SANITIZE_STRING);
  $userconfPass = filter_input(INPUT_POST, 'reg_passwordconf', FILTER_SANITIZE_STRING);

  $continue = True;

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

  // verificare daca username e mai mic de 5 caractere
  $usersize = strlen($userName);
  if($usersize < 5)
  {
    $continue = False;
    header("Location: register.php?userlow_error");
  }

  // verificare primul caracter sa inceapa cu o litera
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
      echo "ERROR: " . $sql . "<br>" . $link->error;
  }

  // Inchidere conexiune
  mysqli_close($link);
?>
