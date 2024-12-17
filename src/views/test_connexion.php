<?php
$host = 'localhost';
$user = 'root';
$password = 'Shun935';
$dbname = 'ecom';

$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
} else {
    echo "Connexion réussie '$dbname'";
}

$mysqli->close();
?>