<?php
session_start();

$produits_disponibles = [
    11 => ['nom' => 'Casque Audio - Sony', 'prix' => 25.00, 'description' => 'Qualité audio exceptionnelle et confort optimal.', 'image' => '/image/accessoire_1.jpg'],
    12 => ['nom' => 'Chargeur Universel - Samsung', 'prix' => 15.50, 'description' => 'Chargeur rapide pour vos appareils.', 'image' => '/image/accessoire_2.jpg'],
    13 => ['nom' => 'Support de Téléphone - Apple', 'prix' => 10.00, 'description' => 'Support sécurisé et élégant pour téléphone.', 'image' => '/image/accessoire_3.jpg'],
    14 => ['nom' => 'Enceinte Bluetooth - JBL', 'prix' => 35.00, 'description' => 'Son puissant et autonomie prolongée.', 'image' => '/image/accessoire_4.jpg'],
    15 => ['nom' => 'Adaptateur HDMI - Belkin', 'prix' => 12.50, 'description' => 'Connectez facilement vos appareils HDMI.', 'image' => '/image/accessoire_5.jpg']
];

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $quantite = isset($_GET['quantite']) ? (int) $_GET['quantite'] : 1;
    if ($quantite > 0) {
        $_SESSION['panier'][$id] = ($quantite + ($_SESSION['panier'][$id] ?? 0));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessoires - Site E-Commerce</title>
    <link rel="stylesheet" href="/css/styles.css">
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
            <?php if (isset($_SESSION['user_nom'])): ?>
                <span>Bienvenue, <?= htmlspecialchars($_SESSION['user_nom']); ?> !</span>
                <a href="/logout" class="logout-btn">Déconnexion</a>
            <?php else: ?>
                <a href="/login" class="login-btn">Connexion</a>
                <a href="/formulaire" class="register-btn">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <h1>Nos Accessoires</h1>
    <div class="product-list">
        <?php foreach ($produits_disponibles as $id => $produit): ?>
            <div class="product-item">
                <h2><?php echo $produit['nom']; ?></h2>
                <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" width="150">
                <p><?php echo $produit['description']; ?></p>
                <p><strong>Prix : €<?php echo number_format($produit['prix'], 2); ?></strong></p>
                <form action="" method="get">
                    <input type="hidden" name="add" value="<?php echo $id; ?>">
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>