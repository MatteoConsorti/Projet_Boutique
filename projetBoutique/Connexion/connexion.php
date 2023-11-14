<?php
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



session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les clés "username" et "password" existent dans $_POST
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? ");
        $stmt->execute([$username]);

        $user = $stmt->fetch();

        $controle =  password_verify($_POST["password"], $user['password']);;


        if ($controle) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_username"] = $user["username"];
            // Ajoute ici la redirection vers la page de tableau de bord ou autre
            echo 'Vous êtes connecté ';?>
            <a href="../index.php"><button>Revenir à la page d'accueil</button></a>
            <a href="https://buy.stripe.com/00g9D17oB5AEcBq003"><button>Procéder au paiement</button></a>
        <?php   
        } else {
            $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Veuillez fournir un nom d'utilisateur et un mot de passe.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <h2 style="text-align: center">Connexion</h2>
    
    <?php if(isset($erreur)) { ?>
        <p style="color:red;"><?php echo $erreur; ?></p>
    <?php } ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- convertir certains caractères spéciaux en entités HTML. Cela est fait afin d'éviter l'exécution involontaire de code HTML ou JavaScript malveillant -->
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Se Connecter">
        

    </form>
</body>


</html>
