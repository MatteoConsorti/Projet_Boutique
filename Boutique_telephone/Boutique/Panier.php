<?php
    // Démarrez la session (si ce n'est pas déjà fait)
    session_start();
    
    $pdo = new PDO('mysql:host=localhost;dbname=boutique_telephone', 'root', '');
    
    // Fonction pour ajouter un produit au panier
    function addToCart($product_id, $quantity) {
        // Vérifiez si le produit existe déjà dans le panier
        if (isset($_SESSION['cart'][$product_id])) {
            // Mettez à jour la quantité si le produit existe déjà
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            // Ajoutez le produit au panier s'il n'existe pas encore
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    
    // Fonction pour supprimer un produit du panier
    function removeFromCart($product_id) {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    
    // Afficher le contenu du panier
    function displayCart() {
        if (empty($_SESSION['cart'])) {
            echo "Le panier est vide.";
        } else {
            echo "<ul>";
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Récupérez les détails du produit depuis la base de données
                $query = "SELECT NOM_PRODUIT, PRIX_PRODUIT FROM produit WHERE ID_PRODUIT = $product_id";
                $result = mysqli_query($mysqli, $query);
                $row = mysqli_fetch_assoc($result);
                
                // Affichez les détails du produit dans le panier
                echo "<li>{$row['product_name']} (Prix : {$row['price']} €) - Quantité : $quantity</li>";
            }
            echo "</ul>";
        }
    }
    
    // Exemples d'utilisation
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        addToCart($product_id, $quantity);
    }
    
    if (isset($_GET['remove'])) {
        $product_id = $_GET['remove'];
        removeFromCart($product_id);
    }
    
    ?>
    
    <!-- Afficher le contenu du panier -->
    <h1>Panier</h1>
    <?php displayCart(); ?>
    
    <!-- Afficher les produits disponibles -->
    <h1>Produits disponibles</h1>
    <?php
    $query = "SELECT * FROM produit";
    $result = mysqli_query($mysqli, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>{$row['product_name']} (Prix : {$row['price']} €) 
            <form method='post' action='panier.php'>
            <input type='hidden' name='product_id' value='{$row['product_id']}'>
            <input type='number' name='quantity' value='1' min='1'>
            <input type='submit' name='add_to_cart' value='Ajouter au panier'>
            </form>
            </div>";
        }
    }
?>