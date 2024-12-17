<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Site E-Commerce</title>
  <link rel="stylesheet" href="/css/styles.css">
  <style>
    
  </style>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <img src="/image/logo.jpg" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="/">Accueil</a></li>
            <li><a href="/cd">CD</a></li>
            <li><a href="/dvd">DVD</a></li>
            <li><a href="/accessoires">Accessoires</a></li>
            <li><a href="/panier">Panier</a></li>
        </ul>

        <div class="auth-links">
            <a href="/login">Connexion</a>
            <a href="/formulaire" class="register-btn">S'inscrire</a>
        </div>
    </nav>
</header>

<?php

$mysqli = new mysqli('localhost', 'root', 'Shun935', 'ecom');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT name, picture FROM category ORDER BY home_order";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo '<main>';
    echo '<h1>Nos catégories</h1>';
    echo '<div class="category-box">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="category-item" onclick="window.location.href=\'/' . strtolower($row['name']) . '\';">';
        echo '<img src="' . $row['picture'] . '" alt="' . $row['name'] . '">';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</main>';
} else {
    echo 'Aucune catégorie trouvée.';
}

$mysqli->close();
?>

<?php
require_once __DIR__ . '/partials/footer.php';
?>

</body>
</html>