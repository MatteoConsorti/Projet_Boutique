<?php
// Inclure la page de connexion
include_once "con_dbb.php";

// Vérifier si une session existe
if (!isset($_SESSION)) {
    // Si non, démarrer la session
    session_start();
}

// Créer la session
if (!isset($_SESSION['panier'])) {
    // S'il n'existe pas de session, on crée une et on y met un tableau vide
    $_SESSION['panier'] = array();
}

// Récupération de l'id depuis le lien
if (isset($_GET['id'])) {
    // Si un id a été envoyé alors :
    $id = $_GET['id'];

    // Vérifier grâce à l'id si le produit existe dans la base de données
    $stmt = $con->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($produit)) {
        // Si ce produit n'existe pas
        die("Ce produit n'existe pas");
    }

    // Ajouter le produit dans le panier (le tableau)
    if (isset($_SESSION['panier'][$id])) {
        // Si le produit est déjà dans le panier, augmenter la quantité
        $_SESSION['panier'][$id]++;
    } else {
        // Sinon, ajouter le produit avec une quantité de 1
        $_SESSION['panier'][$id] = 1;
    }

    // Redirection vers la page index.php
    header("Location: index.php");
}
?>
