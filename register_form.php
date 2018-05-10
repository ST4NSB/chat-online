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

  // verificare prima litera sa inceapa cu o litera
  $userName = trim($userName);
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
    $link->close();
  }
?>
