<?php
  include "dbconnect.php";

  // primire date
  $userName = $_POST['username'];
  $eMail = $_POST['email'];
  $chatRank = 1;
  $userPass = $_POST['password'];
  $userconfPass = $_POST['passwordconf'];

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

  // criptare parola
  $password  = md5($userPass);

  // Inserare date in database
  if($continue) {
    $sql = "INSERT INTO chat_user (username, email, chat_rank, password) VALUES ('$userName', '$eMail', '$chatRank', '$password')";
    if ($link->query($sql) === TRUE)
      echo "New record created successfully";
    else
      echo "ERROR 2: " . $sql . "<br>" . $link->error;
    $link->close();
  }
?>
