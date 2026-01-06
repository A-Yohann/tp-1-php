<?php
session_start();

if (!isset($_SESSION['user'])) { 
    header("Location: ../index.php"); 
    exit("Accès refusé"); 
}

require '../config/database.php';

if (!empty($_POST)) {
    $image = null; 

    if (!empty($_FILES['image']['name'])) {
        $image = uniqid() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$image");
    }

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
        $_SESSION['user']['id'] 
    ]);

    header('Location: ../index.php');
    exit;
}
?>