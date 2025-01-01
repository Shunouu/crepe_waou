<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $adresse = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : null;
    $ville = htmlspecialchars($_POST['ville']);
    $code_postal = htmlspecialchars($_POST['code_postal']);
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($confirm_password) || empty($ville) || empty($code_postal)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif ($password !== $confirm_password) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $erreur = "L'email est déjà utilisé.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (`nom`, `prenom`, `email`, `password`, `adresse`, `ville`, `code_postal`, `newsletter`) 
                                       VALUES (:nom, :prenom, :email, :password, :adresse, :ville, :code_postal, :newsletter)");
                $stmt->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'password' => $hashed_password,
                    'adresse' => $adresse,
                    'ville' => $ville,
                    'code_postal' => $code_postal,
                    'newsletter' => $newsletter
                ]);
                $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                header('Location: /login');
                exit();
            } catch (Exception $e) {
                $erreur = "Erreur lors de l'inscription : " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
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
            <?php if (!isset($_SESSION['user_nom'])): ?>
            <li><a href="/categories">Catégories</a></li>
            <li><a href="/panier">Panier</a></li>
        </ul>
        <div class="auth-links">
            <a href="/login">Connexion</a>
            <?php else: ?>
        <a href="/logout">Déconnexion</a>
    <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <section class="form-section">
        <h1>Créer un compte</h1>
        <?php if (isset($erreur)) { echo "<p style='color: red;'>$erreur</p>"; } ?>
        <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
        <form action="/formulaire" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmer le mot de passe</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>
            <h2>Adresse</h2>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse">
            </div>
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" required>
            </div>
            <div class="form-group">
                <label for="code-postal">Code postal</label>
                <input type="text" id="code-postal" name="code_postal" required>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="newsletter" name="newsletter">
                <label for="newsletter">Je souhaite recevoir les newsletters</label>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </section>
</main>

<footer>
    <div class="footer-container">
        <p>Nous acceptons :</p>
        <img src="/image/paiement.jpg" alt="Moyens de paiement">
        <p>Suivez-nous :</p>
        <a href="https://facebook.com">Facebook</a>
        <a href="https://instagram.com">Instagram</a>
    </div>
</footer>

</body>
</html>