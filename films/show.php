<?php
require '../config/database.php';

$stmt = $pdo->prepare("SELECT * FROM films WHERE id = ?");
$stmt->execute([$_GET['id']]);
$film = $stmt->fetch();
?>

<h2><?= htmlspecialchars($film['titre']) ?></h2>

<?php if ($film['image']): ?>
    <img src="../uploads/<?= $film['image'] ?>" width="200">
<?php endif; ?>

<p><?= nl2br(htmlspecialchars($film['synopsis'])) ?></p>
