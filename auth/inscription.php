<?php
require '../config/database.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$nom || !$prenom || !$email || !$password) {
        $error = "Tous les champs sont obligatoires";
    } else {

        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $error = "Cet email est déjà utilisé";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (nom, prenom, email, password)
                VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$nom, $prenom, $email, $hash]);

            header('Location: connexion.php');
            exit;
        }
    }
}
?>

<form method="post">
    <h2>Inscription</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <input name="nom" placeholder="Nom" required><br>
    <input name="prenom" placeholder="Prénom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>

    <button>S'inscrire</button>
</form>
