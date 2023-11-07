<?php
// Connexion à la base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
  die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupérer les données du formulaire
$name = mysqli_real_escape_string($conn, $_POST["name"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$message = mysqli_real_escape_string($conn, $_POST["message"]);

// Insérer les données dans la base de données
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
if (mysqli_query($conn, $sql)) {
  http_response_code(200);
} else {
  http_response_code(500);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
