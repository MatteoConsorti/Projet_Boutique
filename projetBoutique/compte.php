<?php 
session_start();
$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file which makes the Database Connection.
    include 'connexionBDD/connexionBDD.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
   

    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $num = $stmt->rowCount();

    
    if ($num > 0) {
        $exists = true;
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES (:username, :password, current_timestamp())";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            $result = $stmt->execute();

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<link rel="stylesheet" href="compte.css">
<body>
   <script src="compte.js"></script>
<body>
  <div class="container-shadow">
  </div>
  <div class="container">
    <div class="wrap">
      <div class="headings">
        <a id="sign-in" href="#" class="active"><span>Log In</span></a>
        <a id="sign-up" href="#"><span>Sign up</span></a>
      </div>
      <div id="sign-in-form">

      <form method="post">
            <?php
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your account is now created and you can login. 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span> 
                        </button> 
                      </div>';
            }

            if ($showError) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . $showError . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span> 
                        </button> 
                      </div>';
            }

            if ($exists) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . $exists . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span> 
                        </button>
                      </div>';
            }
            ?>
        
          <label for="username">Identifiant</label>
          <input id="username" type="text" name="username">
          <label for="password">Mot de passe</label>
          <input id="password" type="password" name="password">
          <i id="show-pw" class="fa fa-eye"></i>
          <input id="remember" type="checkbox">
          <label for="remember" id="rlabel">Resté connecté</label>
          <input type="submit" name="submit" value="Se Connecter ">
        </form>

        <footer>
          <div class="hr"></div>
          <div class="fp"><a href="">Mot de passe Oublié ?</a></div>
        </footer>
      </div>
      <div id="sign-up-form">
        <form>
          <label for="username">Identifiant</label>
          <input type="text" name="username">
          <label for="password">Mot de passe</label>
          <input id="password" type="password" name="password">
          <label for="password0">Confirmer le mot de passe</label>
          <input id="password0" type="password" name="password0">
          <input type="submit" name="submit" value="Create Account">
        </form>
      </div>
    </div>
  </div>
</body> 

</html>