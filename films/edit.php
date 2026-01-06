<?php
session_start();
require '../config/database.php';

$stmt = $pdo->prepare(
    "SELECT * FROM films WHERE id = ? AND user_id = ?"
);
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);
$film = $stmt->fetch();

if (!$film) exit("Accès interdit");

if (!empty($_POST)) {
    $stmt = $pdo->prepare(
        "UPDATE films SET titre=?, realisateur=?, genre=?, duree=?, synopsis=? WHERE id=?"
    );
    $stmt->execute([
        $_POST['titre'],
        $_POST['realisateur'],
        $_POST['genre'],
        $_POST['duree'],
        $_POST['synopsis'],
        $_GET['id']
    ]);
    header('Location: ../index.php');
}
?>

<form method="post">
    <input name="titre" value="<?= $film['titre'] ?>">
    <input name="realisateur" value="<?= $film['realisateur'] ?>">
    <input name="genre" value="<?= $film['genre'] ?>">
    <input name="duree" value="<?= $film['duree'] ?>">
    <textarea name="synopsis"><?= $film['synopsis'] ?></textarea>
    <button>Modifier</button>
</form>
