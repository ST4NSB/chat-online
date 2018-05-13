<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit User - Online Chat</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" type="text/css" href="assets/css/adminpanelstyle.css">
</head>

<body>
  <?php
      include 'dbconnect.php';
      $username = "";
      $mail = "";
      $crank = "";
      $sql = "SELECT username FROM chat_user";
      if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(strpos($fullUrl, $row['username']) == true)
              $username = $row['username'];
          }
        }
      }

      $sql = "SELECT * from chat_user WHERE username='$username'";
      if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            $mail = $row['email'];
            $crank = $row['chat_rank'];
          }
        }
      }
      // Inchidere conexiune
      mysqli_close($link);
   ?>
  <main class="ap__main">
    <h1>User Edit</h1>
    <h2><?php echo $username; ?></h2>
    <?php echo '<form action="admpupdate_form.php?' . $username . '" method="post">' ?>
      <input placeholder="Username" name="edit_username" type="text" maxlength="30" required value="<?php echo $username; ?>">
      <input placeholder="e-mail" name="edit_email" type="email" maxlength="30" required value="<?php echo $mail; ?>">
      <label for="edit_rank">Rank: </label>
      <select id="selrank" name="edit_rank">
        <option value="1">User</option>
        <option value="2">Admin</option>
      </select>
      <input placeholder="Password" name="edit_password" type="password" maxlength="30" required>
      <button class="ap__links" type="submit">Submit</button>
      <a href="adminpanel.php" class="ap__links">Back</a>
    </form>
  </main>

  <script>
    document.getElementById("selrank").value = <?php echo $crank; ?>;
  </script>

</body>
