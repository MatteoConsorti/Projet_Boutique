<?php 
session_start();
$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file which makes the Database Connection.
    include 'connectdb.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $num = $stmt->rowCount();

    // This sql query is used to check if the username is already present
    // or not in our Database
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link rel="stylesheet" href="compte.css">
</head>
<body>
    <!-- afficher le nombre de produits dans le panier -->
    <a href="panier.php" class="link">Panier<span><?= array_sum($_SESSION['panier']) ?></span></a>
    <section class="products_list">
        <!-- Votre liste de produits ici -->
    </section>

    <div class="container my-4">
        <h1 class="text-center">Inscrivez-Vous ici !</h1> 
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
            
            <div class="form-group"> 
                <label for="username">Nom d'utilisateur</label> 
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">    
            </div>
    
            <div class="form-group"> 
                <label for="password">Mot de passe</label> 
                <input type="password" class="form-control" id="password" name="password"> 
            </div>
    
            <div class="form-group"> 
                <label for="cpassword">Confirmez le mot de passe</label> 
                <input type="password" class="form-control" id="cpassword" name="cpassword">
    
                <small id="emailHelp" class="form-text text-muted">
                    ⚠ Soyez attentif à utiliser les 2 mêmes mots de passe 
                </small> 
            </div>      
    
            <button type="submit" class="btn btn-primary">Valider !</button> 

        </form>

        <!-- Bouton de redirection vers paiement.php -->
        <?php
        if ($showAlert) {
            echo '<a href="paiement.php" class="btn btn-success">Paiement</a>';
        }
        ?>

        <button><a href="index.php">Retourner à l'Accueil</a></button>
    </div>


</body>
</html>
