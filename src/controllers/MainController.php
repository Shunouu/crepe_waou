<?php

class MainController
{
    public function home()
    {
        require_once __DIR__ . '/../views/home.php';
    }

    public function panier()
    {
        require_once __DIR__ . '/../views/panier.php';
    }

    public function formulaire()
    {
        require_once __DIR__ . '/../views/formulaire.php';
    }

    public function processForm()
    {
        require_once __DIR__ . '/../views/db.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            if (empty($nom) || empty($email) || empty($password)) {
                $erreur = "Veuillez remplir tous les champs.";
            } else {
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch();

                if ($user) {
                    $erreur = "L'email est déjà utilisé.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    try {
                        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :password)");
                        $stmt->execute([
                            'nom' => $nom,
                            'email' => $email,
                            'password' => $hashed_password
                        ]);
                        header('Location: /login');
                        exit();
                    } catch (Exception $e) {
                        $erreur = "Erreur lors de l'inscription : " . $e->getMessage();
                    }
                }
            }
            require_once __DIR__ . '/../views/formulaire.php';
        }
    }

    public function login()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function product()
    {
        require_once __DIR__ . '/../views/product.php';
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public function logout()
    {
        require_once __DIR__ . '/../views/logout.php';
    }

    public function categories()
    {
        require_once __DIR__ . '/../views/categories.php';
    }

    public function cd()
    {
        require_once __DIR__ . '/../views/cd.php';
    }

    public function dvd()
    {
        require_once __DIR__ . '/../views/dvd.php';
    }

    public function accessoires()
    {
        require_once __DIR__ . '/../views/accessoires.php';
    }

    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        require_once __DIR__ . '/../views/404.php';
        exit;
    }
}