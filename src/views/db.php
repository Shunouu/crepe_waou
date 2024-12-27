<?php
$host = 'localhost'; // ou ton adresse de serveur MySQL
$dbname = 'crepe_waou'; // remplace par le nom de ta base de données
$username = 'root'; // ou un autre utilisateur MySQL
$password = 'root'; // mot de passe de ton utilisateur MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie!";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>