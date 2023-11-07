<?php //element connexsion base de donnée
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

// creez la connexion à la base
$conn = new mysqli($servername, $username, $password, $dbname);

// verif connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

<?php
$userId = 4000; // Id de l'utilisateur a afficher et en bas cest la formul de calcul des total
$sql = "SELECT produits.nom, produits.prix, contenue.quantité, (produits.prix * contenue.quantité) AS total FROM contenue 
        JOIN produits ON contenue.produits_id = produits.id
        WHERE contenue.clients_id = $userId";

$result = $conn->query($sql);
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
                <?php //affiche les colone par article dans le panier
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . '</td>';
                    echo '<td>' . $row['prix'] . ' €</td>';
                    echo '<td>' . $row['quantité'] . '</td>';
                    echo '<td>' . $row['total'] . ' €</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
            </tbody>
        </table>

            <div class="total"> <!--bug dans l'affichage du total des article a corriger-->
            <p>Total du panier : <span><?php echo ['totalPanier']; ?></span></p>
            <button>Passer la commande</button>
            </div>
            
    </main>
</body>
</html>


<?php
$conn->close(); // ferme la base de données
?>
