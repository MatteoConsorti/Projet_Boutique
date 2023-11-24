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

    // Vérification des critères du mot de passe
    if (strlen($password) < 8) {
        $showError = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $showError = "Le mot de passe doit contenir au moins une lettre majuscule.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $showError = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif ($password != $cpassword) {
        $showError = "Les mots de passe ne correspondent pas.";
    } else {
        try {
            // Requête SQL pour vérifier si le nom d'utilisateur existe déjà
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // ... (le reste de votre code pour vérifier l'existence de l'utilisateur)
            
            if (!$result) {
                // Le mot de passe respecte les critères, procédez à l'insertion dans la base de données
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
                $exists = "Nom d'utilisateur non disponible";
            }
        } catch (PDOException $e) {
            die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="Inscription.css">
 
    <!-- Ajoutez ici d'autres liens CSS ou scripts si nécessaire -->

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
    include ('header.php')
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
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="password">
        <div class="input-group-append" style="margin-left:2%">
            <img src="images/oeil.png" id="togglePassword" style="cursor: pointer; width: 30px; height: 40px;">
        </div>
    </div>
    <progress id="password-strength" max="100" value="0"></progress>
    <!-- Ajoutez l'élément p pour le commentaire de force du mot de passe ici -->
    <p id="password-comment"></p>
</div>







            <div class="form-group">
                <label for="cpassword">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" >

                <small id="emailHelp" class="form-text text-muted">
                    ⚠ Soyez attentif à utiliser les 2 mêmes mots de passe
                </small>
            </div>

            <button type="submit" class="btn btn-primary">
                Valider !
            </button>

            
        </form>

        <p style="padding-top: 3% "></p><button  style="margin-left: 40%" type="submit" class="btn btn-primary"><a href="connexion.php" style="color: white">
                Vous avez déja un compte ? <br>Connectez-vous pour procédez au paiement</a>
            </button>
    </div>

  
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>

<!-- Votre fichier JavaScript pour la manipulation du DOM -->
<script src="Inscription.js"></script>

<!-- Votre script utilisant le DOM -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // Votre logique pour basculer entre le type de champ de mot de passe
            // ...
        });
    });
</script>
</body>
</html>