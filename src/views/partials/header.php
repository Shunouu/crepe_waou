<?php
session_start();
?>

<header>
    <nav class="navbar">
        <div class="logo">
            <img src="/image/logo.jpg" alt="Logo">
        </div>

        <ul class="nav-links">
            <li><a href="/">Accueil</a></li>
            <li><a href="/categories">Catégories</a></li>
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