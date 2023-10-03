<?php
// Configuration de la base de données
$dsn = 'mysql:host=localhost;dbname=boutique_telephone;charset=utf8';
$username = 'root';
$password = '';

// Options PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $con = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
