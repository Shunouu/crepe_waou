<?php
session_start();
require_once('db.php'); // Assurez-vous que ce fichier contient la connexion PDO à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $code_postal = htmlspecialchars($_POST['code_postal']);
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    // Vérification des champs vides
    if (empty($nom) || empty($email) || empty($password) || empty($confirm_password) || empty($adresse) || empty($ville) || empty($code_postal)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif ($password !== $confirm_password) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $erreur = "L'email est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion des données
            try {
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password, adresse, ville, code_postal, newsletter) VALUES (:nom, :email, :password, :adresse, :ville, :code_postal, :newsletter)");
                $stmt->execute([
                    'nom' => $nom,
                    'email' => $email,
                    'password' => $hashed_password,
                    'adresse' => $adresse,
                    'ville' => $ville,
                    'code_postal' => $code_postal,
                    'newsletter' => $newsletter
                ]);

                $success = "Inscription réussie ! Vous pouvez vous connecter.";
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
</head>
<body>
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
            <a href="/login">Connexion</a>
        </div>
    </nav>
</header>
<main>
        <section class="form-section">
            <h1>Créer un compte</h1>
            <form action="/submit-inscription" method="POST">
                
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
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
                    <input type="text" id="adresse" name="adresse" required>
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
                
               
                <button type="submit" class="btn">Créer un compte</button>
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