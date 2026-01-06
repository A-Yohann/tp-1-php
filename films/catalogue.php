<?php
session_start();
require '../config/database.php';


$stmt = $pdo->query("SELECT * FROM films ORDER BY created_at DESC");
$tous_les_films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Catalogue complet</title>
</head>
<body>
    <h1>Toutes les fiches de films</h1>
    <div class="films-container">
        <?php foreach ($tous_les_films as $film): ?>
            <div class="film-card">
                <h3><?= htmlspecialchars($film['titre']) ?></h3>
                <a href="show.php?id=<?= $film['id'] ?>" class="btn btn-view">Voir plus</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>