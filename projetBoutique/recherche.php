<?php
require("header.php");

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

// Vérifier si une requête de recherche a été soumise
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];

    // Requête SQL modifiée pour la recherche
    $stmt = $conn->prepare("SELECT * FROM produits WHERE nom LIKE :search_query OR description LIKE :search_query");
    $stmt->bindValue(':search_query', "%$search_query%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats de la recherche
    echo "<h2>Résultats de la recherche pour : $search_query</h2>";

    if (!empty($results)) {
        foreach ($results as $row) {
            // Affiche boite pour chaque produit
            echo '<div class="carte">';
            echo '<h2>' . $row['nom'] . '</h2>';
            echo '<div class="img"><img src="' . $row['image'] . '"/></div>';
            echo '<p>Prix : ' . $row['prix'] . '</p>';
            // Bouton "Détails" en tant que lien vers la page produit
            echo '<a href="pageProduit.php?id=' . $row['id_produit'] . '" class="details-btn">Détails</a>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucun résultat trouvé pour la recherche : ' . $search_query . '</p>';
    }
}

?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="recherche.css" />
        <title>Lamazon</title>
    </head>
</html>

<?php
require("footer.php");
?>