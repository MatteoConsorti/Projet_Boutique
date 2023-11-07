<?php
// Assurez-vous d'avoir inclus le fichier d'en-tête approprié
require("header.php");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}

// Vérifier si l'ID du produit est défini dans l'URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Requête SQL pour récupérer les détails du produit
    $stmt = $conn->prepare("SELECT * FROM produits WHERE id_produit = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le produit existe
    if ($produit) {
        echo '<div class="container">';
        echo '<div class="carte">';
        echo '<h2>' . $produit['nom'] . '</h2>';
        echo '<div class="img"><img src="' . $produit['image'] . '"/></div>';
        echo '<p>Prix : ' . $produit['prix'] . '</p>';
        echo '<p>Description : ' . $produit['description'] . '</p>';
        echo '<form action="testPanier.php" method="POST"><button name="bouton">Ajouter au panier</button></form>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Le produit demandé n\'existe pas.</p>';
    }
} else {
    echo '<p>Aucun ID de produit spécifié.</p>';
}

// Fermer la connexion à la base de données
$conn = null;
?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="pageProduit.css" />
        <title>Lamazon produit</title>
    </head>
</html>

<?php
require("footer.php");
?>