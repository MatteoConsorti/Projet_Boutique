<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=boutique_tel', 'root', '');

// Définissez des valeurs par défaut pour les filtres
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

// Appliquez le filtre de tri par marque si ce n'est pas "tous"
if ($triMarque !== 'tous') {
    $query .= " AND MARQUE_TEL = :marque";
}

$statement = $pdo->prepare($query);

// Passez la valeur de la marque si elle n'est pas "tous"
if ($triMarque !== 'tous') {
    $statement->bindParam(':marque', $triMarque);
}

$statement->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Produits</title>
    <link href="Boutique.css" rel="stylesheet">
</head>
<body>
<main>
    <header>
        <label for="triPrix">Trier par prix :</label>
        <select id="triPrix">
            <option value="croissant">Prix Croissant</option>
            <option value="decroissant">Prix Décroissant</option>
        </select>
        <label for="triMarque">Trier par marque :</label>
        <select id="triMarque">
            <option value="tous">Tous</option>
            <option value="iPhone">iPhone</option>
            <option value="Samsung">Samsung</option>
            <option value="Google">Google</option>
            <option value="OnePlus">OnePlus</option>
            <option value="Sony">Sony</option>
            <option value="Xiaomi">Xiaomi</option>
            <option value="LG">LG</option>
            <option value="Motorola">Motorola</option>
            <option value="Nokia">Nokia</option>
            <option value="Asus">Asus</option>
            <!-- Ajoutez d'autres options de marque ici -->
        </select>
        <input type="submit" value="Appliquer">
    </header>
    <h1>Nos Produits</h1>
    <ul>
        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)): ?>
            <li>
                <h2><?= $row['NOM_PRODUIT'] ?></h2>
                <p><?= $row['DESCRIPTION_PRODUIT'] ?></p>
                <p>Prix : $<?= $row['PRIX_PRODUIT'] ?></p>
                <p>Stock : <?= $row['STOCK_PRODUIT'] ?></p>
                <p>Marque : <?= $row['MARQUE_TEL'] ?></p>
                <p>Caractéristique : <?= $row['CARACTERISTIQUE_TEL'] ?></p>
                <img src="<?= $row['URL_IMAGE'] ?>" alt="Image du produit">
            </li>
        <?php endwhile; ?>
    </ul>
</main>
</body>
</html>

<?php
// Fermeture de la connexion à la base de données
$pdo = null;
?>