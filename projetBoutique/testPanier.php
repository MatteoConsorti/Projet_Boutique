<?php
include "header.php";

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btque";

try {
    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration de PDO pour qu'il génère des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Id de l'utilisateur à afficher
$userId = 4000;

try {
    // Requête SQL pour récupérer les produits du panier de l'utilisateur
    $sql = "SELECT produits.nom, produits.prix, contenue.quantité, (produits.prix * contenue.quantité) AS total FROM contenue 
            JOIN produits ON contenue.produits_id = produits.id
            WHERE contenue.clients_id = :userId";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="testPanier.css">
    
</head>
<body>
    <header>
        <h1>Mon Panier</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Affichage des données récupérées
                foreach ($result as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . '</td>';
                    echo '<td>' . $row['prix'] . ' €</td>';
                    echo '<td>' . $row['quantité'] . '</td>';
                    echo '<td>' . $row['total'] . ' €</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="total">
            <p>Total du panier : <span><?php
                // Calcul du total du panier
                $totalPanier = 0;
                foreach ($result as $row) {
                    $totalPanier += $row['total'];
                }
                echo $totalPanier . ' €';
                ?></span></p>
            <a href="compte.php" target="_blank" rel="noopener noreferrer"><button>Passer la commande</button></a>
        </div>
    </main>
</body>
</html>

<?php
// Fermeture de la connexion PDO
$conn = null;
?>

<?php include "footer.php"; ?>