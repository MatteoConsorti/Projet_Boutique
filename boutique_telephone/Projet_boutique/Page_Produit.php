<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=boutique_tel', 'root', '');

$triPrix = isset($_GET['triPrix']) ? $_GET['triPrix'] : 'croissant';
$triMarque = isset($_GET['triMarque']) ? $_GET['triMarque'] : 'tous';

// Requête SQL pour récupérer les produits avec les filtres
$query = "SELECT * FROM produit WHERE 1";

// Appliquez le filtre de tri par prix
if ($triPrix === 'croissant') {
    $query .= " ORDER BY PRIX_PRODUIT ASC";
} else {
    $query .= " ORDER BY PRIX_PRODUIT DESC";
}

$statement = $pdo->prepare($query);
$statement->execute();
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Produits</title>
    <link href="Boutique.css" rel="stylesheet">
</head>
<body>
<main>
    <form method="GET"> <!-- Ajout d'un formulaire pour les filtres -->
        <header>
            <label for="triPrix">Trier par prix :</label>
            <select id="triPrix" name="triPrix"> 
                <option value="croissant">Prix Croissant</option>
                <option value="decroissant">Prix Décroissant</option>
            </select>
            <input type="submit" value="Appliquer">
        </header>
    </form> <!-- Fin du formulaire -->
    <h1>Nos Produits</h1>
    <div class="Produit">
        <ul>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)): ?>
                <li>
                    <h2><?= $row['NOM_PRODUIT'] ?></h2>
                    <!-- Lien vers la page de détail du produit avec l'ID du produit en paramètre -->
                    <a href="detail_produit.php?id_produit=<?= $row['ID_PRODUIT'] ?>">
                        <img class="image_produit" src="<?= $row['URL_IMAGE'] ?>" alt="Image du produit">
                    </a>
                    <p>Prix : $<?= $row['PRIX_PRODUIT'] ?></p>
                    <p>Stock : <?= $row['STOCK_PRODUIT'] ?></p>
                    <p>Marque : <?= $row['MARQUE_TEL'] ?></p>
                    <p>Caractéristique : <?= $row['CARACTERISTIQUE_TEL'] ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</main>
</body>
</html>

<?php
// Fermeture de la connexion à la base de données
$pdo = null;
?>
