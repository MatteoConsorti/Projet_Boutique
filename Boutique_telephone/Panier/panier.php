<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=boutique_telephone', 'root', '');
include "../header/header.html";
include_once "index.php";


// Supprimer les produits
// Si la variable del existe
if(isset($_GET['del'])){
    $id_del = $_GET['del'] ;
    // Suppression
    unset($_SESSION['panier'][$id_del]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="panier">
    <a href="index.php" class="link">Boutique</a>
    <section>
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php 
            $total = 0 ;
            // Liste des produits
            // Récupérer les clés du tableau session
            $ids = array_keys($_SESSION['panier']);
            // S'il n'y a aucune clé dans le tableau
            if(empty($ids)){
                echo "Votre panier est vide";
            }else {
                // Si oui 
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN (" . implode(',', $ids) . ")");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Liste des produits avec une boucle foreach
                foreach($products as $product):
                    // Calculer le total (prix unitaire * quantité) 
                    // Et additionner chaque résultat à chaque tour de boucle
                    $total = $total + $product['price'] * $_SESSION['panier'][$product['id']] ;
                ?>
                <tr>
                    <td><img src="project_images/<?=$product['img']?>"></td>
                    <td><?=$product['name']?></td>
                    <td><?=$product['price']?>€</td>
                    <td><?=$_SESSION['panier'][$product['id']] // Quantité?></td>
                    <td><a href="panier.php?del=<?=$product['id']?>"><img src="delete.png"></a></td>
                </tr>

            <?php endforeach ;} ?>

            <tr class="total">
                <th>Total : <?=$total?>€</th>
            </tr>
             
        </table><br><br>
        <a href="compte.php" class="link">Procédez au paiement !</a>
    </section>
</body>
</html>
