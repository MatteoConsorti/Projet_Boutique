<?php
session_start();

require("header.php");

include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Connexion/connexion.php"); // Redirect to login page if not logged in
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
$password_update_success = $password_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the new password
    if (strlen($new_password) < 8) {
        $password_error = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif ($new_password != $confirm_password) {
        $password_error = "Les mots de passe ne correspondent pas.";
    } else {
        // Hash the new password before storing it in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        try {
            $updatePasswordSql = "UPDATE users SET password = :hashed_password WHERE id = :user_id";
            $updatePasswordStmt = $conn->prepare($updatePasswordSql);
            $updatePasswordStmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
            $updatePasswordStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $updatePasswordStmt->execute();

            // Password update success message
            $password_update_success = "Mot de passe mis à jour avec succès!";
        } catch (PDOException $e) {
            die("Error updating password: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header> 
        <h1>Mon Compte</h1>
    </header>
    <div class="container">

        <?php if ($user) : ?>
            <div class="user-info">
                <p>Nom d'utilisateur: <strong><?php echo $user['username']; ?></strong></p>

                <?php if ($orders) : ?>
                    <h2>Historique des commandes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Date de commande</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?php echo $order['nom_produit']; ?></td>
                                    <td><?php echo $order['quantite']; ?></td>
                                    <td><?php echo $order['prix']; ?> €</td>
                                    <td><?php echo $order['date_commande']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>Aucune commande passée.</p>
                <?php endif; ?>
                
                <?php
                echo '<br>';
                echo '<form class="formMdp" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                echo '<label for="new_password">Nouveau mot de passe: </label>';
                echo '<input type="password" id="new_password" name="new_password" required>';
                echo '<label for="confirm_password">Confirmer le mot de passe: </label>';
                echo '<input type="password" id="confirm_password" name="confirm_password" required>';
                echo '<input type="submit" name="update_password" value="Mettre à jour le mot de passe">';
                echo '</form>';

                if (!empty($password_update_success)) {
                    echo '<p class="success-message">' . $password_update_success . '</p>';
                } elseif (!empty($password_error)) {
                    echo '<p class="error-message">' . $password_error . '</p>';
                }

                if (isset($_SESSION['user_id']) && $_SESSION['user_username'] == 'JJ') {
                    echo "<a href='admin/Admin.php'><button>Page admin</button></a>";                }
                ?>

            </div>
        <?php else : ?>
            <p>Utilisateur introuvable.</p>
        <?php endif; ?>

    </div>

    <a href="Connexion/logout.php">Se déconnecter</a>
    
    
</body>

</html>

<?php require("footer.php"); ?>
