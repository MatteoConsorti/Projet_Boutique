<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=boutique_telephone', 'root', '');

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

    >

<main>
    <header>
        <h2 class="h2_detail"><?= $nom_produit ?></h2>
    </header>
    <div class="detail_produit">
        <h1 class="h1_detail"><?= $row['NOM_PRODUIT'] ?></h1>
        <img class="image_detail" src="<?= $url_image ?>" alt="<?= $nom_produit ?>">
        <div class="description_detail_produit">
        <p><u>Description</u> : <?= $description_produit ?></p>
        <p><u>Prix</u> : <?= $prix_produit ?> €</p>
        <p><u>Stock</u> : <?= $stock_produit ?></p>
        <p><u>Marque</u> : <?= $marque_tel ?></p>
        <p><u>Caractéristique</u> : <?= $caracteristique_tel ?></p>
        </div>
    </div>
</main>

<?php include '../footer/footer.html'; ?> <!-- Inclure le footer -->

</body>
</html>

<?php
$pdo = null;
?>

