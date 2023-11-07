<?php
require("header.php");

// co à la base de données en utilisant PDO et pas mysqli
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // erreru si jamais pas co a base 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}

// reucp produits depuis db
$stmt = $conn->prepare("SELECT * FROM produits");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// modif du panier §§§§ on a pas de systeme de co donc utilisateur prédefinie
$userId = 4000;
if (isset($_POST['bouton'])) {
    $stmt = $conn->prepare("UPDATE contenue SET quantité = quantité + 1 WHERE clients_id=:userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    echo "testtestbouton";
}

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
        <?php
        foreach($results as $row) {
            // affiche boite pour chaque produit
            echo '<div class="carte">';
            echo '<h2>' . $row['nom'] . '</h2>';
            echo '<div class="img"><img src="' . $row['image'] . '"/></div>';
            echo '<p>Prix : ' . $row['prix'] . '</p>';
            echo '<button class="details-btn" onclick="openModal(\'' . $row['description'] . '\')">Détails</button>';
            echo '</div>';
        }
        ?>

        <!-- fenêtre modale -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Description du produit</h2>
                <p id="modalDescription"></p>
                <form action="" method="POST"><button name="bouton">Ajouter au panier</button></form>
            </div>
        </div>
    </div>

    <script>
        // js pour la fenêtre modale
        function openModal(description) {
            var modal = document.getElementById('myModal');
            var modalDescription = document.getElementById('modalDescription');
            modalDescription.textContent = description;
            modal.style.display = 'block';
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>

</body>

<?php
require("footer.php");
?>