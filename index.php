<?php
session_start();
require __DIR__ . '/config/database.php';

$stmt = $pdo->prepare("
    SELECT * FROM films
    ORDER BY created_at DESC
    LIMIT 4
");
$stmt->execute();
$films = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Médiathèque</title>
</head>
<body>

<nav>
<?php if (isset($_SESSION['user_id'])): ?>
    Bonjour <?= htmlspecialchars($_SESSION['prenom']) ?> |
    <a href="films/add.php">Ajouter un film</a> |
    <a href="films/catalogue.php">Catalogue</a>
    <a href="auth/logout.php">Déconnexion</a>
<?php else: ?>
    <a href="auth/connexion.php">Connexion</a> |
    <a href="auth/inscription.php">Inscription</a>
<?php endif; ?>
</nav>

<h1>Derniers films</h1>

<div class="films-container"> 
    <?php foreach ($films as $film): ?>
        <div class="film-card"> 
            
            <?php if (!empty($film['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($film['image']) ?>" alt="<?= htmlspecialchars($film['titre']) ?>">
            <?php else: ?>
                <div style="height:300px; background:#ddd; display:flex; align-items:center; justify-content:center;">Pas d'image</div>
            <?php endif; ?>

            <h3><?= htmlspecialchars($film['titre']) ?></h3>
            <p><?= htmlspecialchars($film['realisateur']) ?> | <?= htmlspecialchars($film['genre']) ?> | <?= $film['duree'] ?> min</p>

            <a href="films/show.php?id=<?= $film['id'] ?>" class="btn btn-view">Voir plus</a>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $film['user_id']): ?>
                <br>
                <a href="films/edit.php?id=<?= $film['id'] ?>" class="btn btn-edit">Modifier</a>
                <a href="films/delete.php?id=<?= $film['id'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer ?')">Supprimer</a>
            <?php endif; ?>
            
        </div> <?php endforeach; ?>
</div> </body>
</html>