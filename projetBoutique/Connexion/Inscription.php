<?php
$showAlert = false;
$showError = false;
$exists = false;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    try {
        // Requête SQL pour vérifier si le nom d'utilisateur existe déjà
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            if ($password == $cpassword && $exists == false) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Requête SQL pour insérer un nouvel utilisateur
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hash);
                $stmt->execute();

                if ($stmt) {
                    $showAlert = true;
                }
            } else {
                $showError = "Passwords do not match";
            }
        } else {
            $exists = "Username not available";
        }
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}
?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

    <?php

    if ($showAlert) {

        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">

            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> ';
    }

    if ($showError) {

        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> ' . $showError . '

       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span> 
       </button> 
     </div> ';
    }

    if ($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">

        <strong>Error!</strong> ' . $exists . '
        <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button>
       </div> ';
    }

    ?>

    <div style="border: solid 3px #00ced1; padding-bottom: 5%" class="container my-4 ">

        <h1 class="text-center">Inscrivez-Vous ici !</h1>
        <form action="Inscription.php" method="post">

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

            <button type="submit" class="btn btn-primary">
                Valider !
            </button>

            <button><a href="https://buy.stripe.com/00g9D17oB5AEcBq003">Paiement</a></button>
        </form>

        <p style="padding-top: 3% "></p><button  style="margin-left: 40%" type="submit" class="btn btn-primary"><a href="connexion.php" style="color: white">
                Vous avez déja un compte ?</a>
            </button>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>
</html>
