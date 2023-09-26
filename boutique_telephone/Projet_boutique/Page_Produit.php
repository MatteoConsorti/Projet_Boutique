<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=boutique_tel', 'root', '');

$triPrix = isset($_GET['triPrix']) ? $_GET['triPrix'] : 'croissant';

// Requête SQL pour récupérer les produits avec les filtres
$query = "SELECT * FROM produit WHERE 1";

// Appliquez le filtre de tri par prix
if ($triPrix === 'croissant') {
    $query .= " ORDER BY PRIX_PRODUIT ASC";
} else {
    $query .= " ORDER BY PRIX_PRODUIT DESC";
}

$marquesAutorisees = ['iPhone', 'Samsung', 'Motorola', 'LG', 'Nokia', 'OnePlus', 'Asus', 'Google', 'Sony', 'Xiaomi'];
$marquesFiltre = isset($_GET['marque']) ? $_GET['marque'] : array();

// Filtrer les marques sélectionnées pour inclure uniquement celles autorisées
$marquesFiltre = array_intersect($marquesFiltre, $marquesAutorisees);

// Requête SQL pour récupérer les produits avec les filtres
$query = "SELECT * FROM produit WHERE 1";

// Ajouter le filtre par marque s'il y a des marques sélectionnées
if (!empty($marquesFiltre)) {
    $query .= " AND MARQUE_TEL IN ('" . implode("', '", $marquesFiltre) . "')";
}

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

<?php include 'header.html'; ?> <!-- Inclure le header -->

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
    <section class="marque-filtre">
        <h2>Filtrer par marque :</h2>
        <div class="trois-colonnes">
            <ul class="colonne">
                <li><input type="checkbox" name="marque[]" value="iPhone"> iPhone</li>
                <li><input type="checkbox" name="marque[]" value="Samsung"> Samsung</li>
                <li><input type="checkbox" name="marque[]" value="Motorola"> Motorola</li>
            </ul>
            <ul class="colonne">
                <li><input type="checkbox" name="marque[]" value="LG"> LG</li>
                <li><input type="checkbox" name="marque[]" value="Nokia"> Nokia</li>
                <li><input type="checkbox" name="marque[]" value="OnePlus"> OnePlus</li>
            </ul>
            <ul class="colonne">
                <li><input type="checkbox" name="marque[]" value="Asus"> Asus</li>
                <li><input type="checkbox" name="marque[]" value="Google"> Google</li>
                <li><input type="checkbox" name="marque[]" value="Sony"> Sony</li>
                <li><input type="checkbox" name="marque[]" value="Xiaomi"> Xiaomi</li>
            </ul>
        </div>
        <input type="submit" value="Appliquer le filtre par marque">
    </section>


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
        <div class="description_generale">
        <div class="description_produit">
        <p class="prix_produit"><u>Prix</u> : <?= $row['PRIX_PRODUIT'] ?> €</p>
        <p><u>Stock</u> : <?= $row['STOCK_PRODUIT'] ?></p>
        <p><u>Marque</u> : <?= $row['MARQUE_TEL'] ?></p>
        <p><u>Caractéristique</u> : <?= $row['CARACTERISTIQUE_TEL'] ?></p>
        </div>
        <div class="notation">
        <p><u>Note moyenne</u> :</p>
        </div>
        <?php
        // Génération d'une note aléatoire entre 1 et 5 étoiles
        $averageRating = rand(1, 5);
        // Affichez la note moyenne en tant que symboles d'étoiles
        echo '<p>';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $averageRating) {
                echo '&#9733;'; // Étoile pleine
            } else {
                echo '&#9734;'; // Étoile vide
            }
        }
        echo '</p>';
        ?>
        </div>
        </li>
    <?php endwhile; ?>
    </ul>
    </div>
</main>

<?php include 'footer.html'; ?> <!-- Inclure le footer -->

</body>
</html>

<?php
// Fermeture de la connexion à la base de données
$pdo = null;
?>

