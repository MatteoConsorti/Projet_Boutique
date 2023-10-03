<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "boutique_telephone";

    try {
        // Create a PDO connection
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Success";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
?>
