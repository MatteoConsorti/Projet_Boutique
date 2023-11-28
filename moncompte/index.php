<?php
session_start();

require("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

if (!isset($_SESSION['user_id'])) {
    header("Location: Connexion/connexion.php");
    exit();
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}

// Récupérer toutes les catégories distinctes de la base de données
$stmt_categories = $conn->prepare("SELECT DISTINCT categorie FROM produits");
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll(PDO::FETCH_COLUMN);

// Vérifier si une catégorie est sélectionnée
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

// Vérifier l'ordre de tri
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'asc';
$validSortOrders = ['asc', 'desc'];
if (!in_array($sortOrder, $validSortOrders)) {
    $sortOrder = 'asc';  // Valeur par défaut
}

// Requête SQL pour récupérer les produits en fonction des filtres
if ($selectedCategory) {
    $sql = "SELECT * FROM produits WHERE categorie = :category";
} else {
    $sql = "SELECT * FROM produits";
}

// Ajouter l'ordre de tri à la requête SQL
$sql .= " ORDER BY prix $sortOrder";

$stmt = $conn->prepare($sql);

// Liaison des paramètres en fonction des filtres sélectionnés
if ($selectedCategory) {
    $stmt->bindParam(':category', $selectedCategory, PDO::PARAM_STR);
}

// ...

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css" />
    <title>Lamazon</title>
</head>
<body>
    <div class="container">
        <!-- Formulaire de filtre par catégorie, prix et tri -->
        <form action="index.php" method="GET">
            <label for="category">Filtrer par catégorie :</label>
            <select id="category" name="category">
                <option value="" <?php echo $selectedCategory === null ? 'selected' : ''; ?>>Toutes les catégories</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category; ?>" <?php echo $selectedCategory === $category ? 'selected' : ''; ?>><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Ajouter des boutons pour l'ordre de tri -->
            <div>
                <label>Trier par :</label>
                <label>
                    <input type="radio" name="sortOrder" value="asc" <?php echo $sortOrder === 'asc' ? 'checked' : ''; ?>>
                    Croissant
                </label>
                <label>
                    <input type="radio" name="sortOrder" value="desc" <?php echo $sortOrder === 'desc' ? 'checked' : ''; ?>>
                    Décroissant
                </label>
            </div>

            <button type="submit">Filtrer</button>
        </form>

        <?php
        foreach($results as $row) {
            // affiche boite pour chaque produit
            echo '<div class="carte">';
            echo '<h2>' . $row['nom'] . '</h2>';
            echo '<div class="img"><img src="' . $row['image'] . '"/></div>';
            echo '<p>Prix : ' . $row['prix'] . '</p>';
            echo '<a href="pageProduit.php?id=' . $row['id_produit'] . '" class="details-btn">Détails</a>';
            echo '</div>';
        }
        ?>
    </div>
</body>

<?php
require("footer.php");
?>
