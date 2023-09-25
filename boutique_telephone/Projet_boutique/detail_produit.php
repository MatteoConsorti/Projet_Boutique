<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=boutique_tel', 'root', '');

if (isset($_GET['id_produit'])) {
    // Récupère la valeur de 'id_produit' depuis l'URL
    $id_produit = $_GET['id_produit'];
    
    // Requête SQL pour sélectionner le produit avec l'ID correspondant
    $query = "SELECT * FROM produit WHERE ID_PRODUIT = :id_produit";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id_produit', $id_produit);
    $statement->execute();

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $nom_produit = $row['NOM_PRODUIT'];
        $description_produit = $row['DESCRIPTION_PRODUIT'];
        $prix_produit = $row['PRIX_PRODUIT'];
        $stock_produit = $row['STOCK_PRODUIT'];
        $marque_tel = $row['MARQUE_TEL'];
        $caracteristique_tel = $row['CARACTERISTIQUE_TEL'];
        $url_image = $row['URL_IMAGE'];
    } else {
        header('Location: liste_produits.php');
        exit();
    }
} else {
    header('Location: liste_produits.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $nom_produit ?></title>
    <link href="Boutique.css" rel="stylesheet">
</head>
<body>
<main>
    <header>
        <h1><?= $nom_produit ?></h1>
    </header>
    <div class="detail_produit">
        <h2><?= $row['NOM_PRODUIT'] ?></h2>
        <img class="image_detail" src="<?= $url_image ?>" alt="<?= $nom_produit ?>">
        <div class="description_produit">
        <p>Description : <?= $description_produit ?></p>
        <p>Prix : $<?= $prix_produit ?></p>
        <p>Stock : <?= $stock_produit ?></p>
        <p>Marque : <?= $marque_tel ?></p>
        <p>Caractéristique : <?= $caracteristique_tel ?></p>
        </div>
    </div>
</main>
</body>
</html>

<?php
$pdo = null;
?>
