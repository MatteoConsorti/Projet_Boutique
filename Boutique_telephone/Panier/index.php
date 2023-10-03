<?php 
session_start();
 
// Initialisez $_SESSION['panier'] en tant qu'array vide s'il n'existe pas déjà.
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- afficher le nombre de produits dans le panier -->
    <a href="panier.php" class="link">Panier<span><?= array_sum($_SESSION['panier']) ?></span></a>
    <section class="products_list">
        <?php 
        //inclure la page de connexion
        include_once "con_dbb.php";

        //afficher la liste des produits
        $stmt = $con->query("SELECT * FROM products");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" class="product">
            <div class="image_product">
                <img src="project_images/<?= $row['img'] ?>">
            </div>
            <div class="content">
                <h4 class="name"><?= $row['name'] ?></h4>
                <h2 class="price"><?= $row['price'] ?>€</h2>
                <a href="ajouter_panier.php?id=<?= $row['id'] ?>" class="id_product">Ajouter au panier</a>
            </div>
        </form>
        <?php } ?>
    </section>
</body>
</html>
