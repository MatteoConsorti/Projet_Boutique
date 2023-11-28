<?php
session_start();

include "../config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user information from the database
try {
    $sql = "SELECT * FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error retrieving user information: " . $e->getMessage());
}

// Retrieve order history from the database
try {
    $orderSql = "SELECT * FROM commandes WHERE idUser = :user_id";
    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $orderStmt->execute();
    $orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error retrieving order history: " . $e->getMessage());
}

// Handle password update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    // ... (as before)
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: connexion.php"); // Redirect to login page after logout
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
</head>
<body>

<h1>Voulez-vous vous déconnecter ?</h1>

<?php
if ($user) {
    echo '<a href="?logout=true">Se déconnecter</a>';
    echo '<br>';
    echo '<a href="../monCompte.php">Revenir en arrière</a>';
} else {
    echo "<p>Utilisateur introuvable.</p>";
}

?>

</body>
</html>
