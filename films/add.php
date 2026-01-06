<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    exit("Accès refusé");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Nettoyer le nom du fichier et garder l'extension
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $safeName = uniqid() . '.' . $ext;

        // Déplacement vers uploads
        if (!is_dir('../uploads')) mkdir('../uploads', 0777, true);
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$safeName");

        // Stocker le nom dans la DB
        $image = $safeName;
    }

    // Insertion dans la DB
    $stmt = $pdo->prepare("
        INSERT INTO films (titre, realisateur, genre, duree, synopsis, image, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST['titre'],
        $_POST['realisateur'],
        $_POST['genre'],
        $_POST['duree'],
        $_POST['synopsis'],
        $image,
        $_SESSION['user_id']
    ]);

    header('Location: ../index.php');
    exit;
}
?>

<form method="post" enctype="multipart/form-data">
    <input name="titre" placeholder="Titre" required>
    <input name="realisateur" placeholder="Réalisateur" required>
    <input name="genre" placeholder="Genre" required>
    <input type="number" name="duree" placeholder="Durée" required>
    <textarea name="synopsis" placeholder="Synopsis"></textarea>
    <input type="file" name="image" accept="image/*">
    <button>Ajouter le film</button>
</form>
