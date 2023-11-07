<?php


session_start();




include "header.php";
/*
echo '<pre>';
var_dump($_POST);
echo '</pre>';

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
*/

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

try {
    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration de PDO pour qu'il génère des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}


// Vérifiez si un produit a été ajouté au panier
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Vous devrez ajouter le code pour vérifier si le produit existe dans la base de données
    // et récupérer ses détails (similaire à ce que vous avez fait dans "produit.php")

    // Ensuite, vous pouvez ajouter le produit au panier en utilisant des sessions
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Si le produit est déjà dans le panier, mettez à jour la quantité
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantite'] += $quantity;
    } else {
        // Sinon, ajoutez-le au panier
        $_SESSION['cart'][$product_id]['quantite'] = $quantity;
        try {
            // Requête SQL pour récupérer les produits du panier de l'utilisateur
            $sql = "SELECT nom, prix FROM produits WHERE id_produit = :id";
        
            // Préparation de la requête
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        
            // Exécution de la requête
            $stmt->execute();
        
            // Récupération des résultats
           $result = $stmt->fetch(PDO::FETCH_ASSOC);

            var_dump( $result);
            $_SESSION['cart'][$product_id]['nom'] = $result['nom'];
            $_SESSION['cart'][$product_id]['prix'] = $result['prix'];


        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
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
                foreach ($_SESSION['cart'] as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . '</td>';
                    echo '<td>' . $row['prix'] . ' €</td>';
                    echo '<td>' . $row['quantite'] . '</td>';
                    echo '<td>' . $row['prix'] * $row['quantite'] . ' €</td>';
                    
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="total">
    <p>Total du panier : <span><?php
        // Calcul du total du panier
        $totalPanier = 0;
        foreach ($_SESSION['cart'] as $row) {
            $totalPanier += $row['prix'] * $row['quantite'];
        }
        echo $totalPanier . ' €';
        ?></span></p>
              
    <a href="../projetBoutique/Connexion/Inscription.php" target="_blank" rel="noopener noreferrer"><button>Passer la commande</button></a>
    <a href="index.php" target="_blank" rel="noopener noreferrer"><button>Ajouter d'autres produits</button></a>
</div>

    </main>
</body>
</html>

<?php
// Fermeture de la connexion PDO
$conn = null;
?>
<?php include "footer.php"; ?>
