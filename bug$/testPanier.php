<?php
session_start();

include "header.php";

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

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si un produit a été ajouté au panier
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantite'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id]['quantite'] = $quantity;
            try {
                $sql = "SELECT nom, prix FROM produits WHERE id_produit = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['cart'][$product_id]['nom'] = $result['nom'];
                $_SESSION['cart'][$product_id]['prix'] = $result['prix'];

            } catch (PDOException $e) {
                die("Erreur lors de la récupération des données : " . $e->getMessage());
            }
        }
    }

    // Vérifie si le formulaire a été soumis pour la suppression de produits
    if (isset($_POST['delete_selected'])) {
        // Boucle à travers les produits du panier
        foreach ($_SESSION['cart'] as $product_id => $row) {
            // Vérifie si une quantité a été spécifiée pour la suppression
            if (isset($_POST['selected_quantities'][$product_id])) {
                $selected_quantity = intval($_POST['selected_quantities'][$product_id]);

                // Vérifie si la quantité à supprimer est valide
                if ($selected_quantity > 0 && $selected_quantity <= $_SESSION['cart'][$product_id]['quantite']) {
                    // Soustrait la quantité sélectionnée du panier
                    $_SESSION['cart'][$product_id]['quantite'] -= $selected_quantity;

                    // Si la quantité atteint zéro, supprime le produit du panier
                    if ($_SESSION['cart'][$product_id]['quantite'] == 0) {
                        unset($_SESSION['cart'][$product_id]);
                    }
                }
            }
        }
    }

    // Vérifie si le bouton "Passer la commande" a été cliqué
    if (isset($_POST['passer_commande'])) {
        // Ajoutez ici le code pour passer la commande
        // ...

        // Après le traitement, vous pouvez vider le panier si nécessaire
        // unset($_SESSION['cart']);
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table>
                <thead>
                    <tr>
                        <th>Suppression</th>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['cart'])) {
                    $totalPanier = 0;
                    foreach ($_SESSION['cart'] as $product_id => $row) {
                        echo '<tr>';
                        echo '<td><input type="number" name="selected_quantities[' . $product_id . ']" value="0" min="0" max="' . $row['quantite'] . '"></td>';
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td>' . $row['prix'] . ' €</td>';
                        echo '<td>' . $row['quantite'] . '</td>';
                        echo '<td>' . $row['prix'] * $row['quantite'] . ' €</td>';
                        echo '</tr>';
                        $totalPanier += $row['prix'] * $row['quantite'];
                    }
                    echo '<tr><td colspan="4" class="total">Total du panier : </td><td class="total">' . $totalPanier . ' €</td></tr>';
                } else {
                    echo '<tr><td colspan="5">Votre panier est vide.</td></tr>';
                } ?>
                </tbody>
            </table>
            
            <div class="total">
                <p>Total du panier : <span>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        if (isset($_SESSION['cart'])) {
                            $totalPanier = 0;
                            foreach ($_SESSION['cart'] as $row) {
                                $totalPanier += $row['prix'] * $row['quantite'];
                            }
                            echo $totalPanier . ' €';
                        } else {
                            echo '';
                        }
                    } 
                    ?>
                    
                </span></p>

                <?php
                if (isset($messagePanierVide)) {
                    echo '<p>' . $messagePanierVide . '</p>';
                }
                ?>

                <button class="button_panier" type="submit" name="delete_selected" class="delete-selected-button">Supprimer sélection</button>
            </div>
        </form>
        <?php
        if (isset($_SESSION['cart'])) {
        echo '<a href="paiement.php"><button class="button_panier" type="submit" name="passer_commande">Passer la commande</button></a>';
        } if (!isset($_SESSION['cart'])){
        }
        ?>
        <a href="index.php" rel="noopener noreferrer"><button class="button_panier">Ajouter d'autres produits</button></a>
    </main>
</body>
</html>

<?php
$conn = null;
include "footer.php";
?>
