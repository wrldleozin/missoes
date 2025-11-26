<?php 
require_once '../php/db.php'; 
require_once '../php/functions.php'; 
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $texto = trim($_POST['texto'] ?? '');
    $experiencia = trim($_POST['experiencia'] ?? '');

    if ($texto) {

        $stmt = $conn->prepare('
            INSERT INTO missoes (id_usuario, texto, experiencia, publico) 
            VALUES (?, ?, ?, 1)
        ');

        $stmt->bind_param('iss', $_SESSION['user_id'], $texto, $experiencia);
        $stmt->execute();
    }
}

header('Location: mural.php');
exit;
?>
