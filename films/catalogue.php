<?php
session_start();
require '../config/database.php';

// Préparation de la requête pour récupérer tous les films
$stmt = $pdo->prepare("SELECT * FROM films ORDER BY created_at DESC");
$stmt->execute();
$tous_les_films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Catalogue complet</title>
</head>
<body>

<nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        Bonjour <?= htmlspecialchars($_SESSION['prenom']) ?> |
        <a href="../index.php">Derniers films</a>
        <a href="add.php">Ajouter un film</a> |
        <a href="catalogue.php">Catalogue</a> |
        <a href="../auth/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="../auth/connexion.php">Connexion</a> |
        <a href="../auth/inscription.php">Inscription</a> |
        <a href="catalogue.php">Catalogue</a>
    <?php endif; ?>
</nav>

<h1>Toutes les fiches de films</h1>
<div class="films-container">
    <?php if (count($tous_les_films) === 0): ?>
        <p>Aucun film disponible pour le moment.</p>
    <?php else: ?>
        <?php foreach ($tous_les_films as $film): ?>
            <div class="film-card">
                <?php if (!empty($film['image'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($film['image']) ?>" alt="<?= htmlspecialchars($film['titre']) ?>" style="max-width:200px;">
                <?php else: ?>
                    <div style="width:200px; height:300px; background:#ddd; display:flex; align-items:center; justify-content:center;">Pas d'image</div>
                <?php endif; ?>
                
                <h3><?= htmlspecialchars($film['titre']) ?></h3>
                <p><?= htmlspecialchars($film['realisateur']) ?> | <?= htmlspecialchars($film['genre']) ?> | <?= $film['duree'] ?> min</p>
                <a href="show.php?id=<?= $film['id'] ?>" class="btn btn-view">Voir plus</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
