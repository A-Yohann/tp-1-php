<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare(
        "DELETE FROM films WHERE id = ? AND user_id = ?"
    );
    
    $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
}

header('Location: ../index.php');
exit();