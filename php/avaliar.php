<?php require_once '../php/db.php'; require_once '../php/functions.php'; requireLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_missao = intval($_POST['id_missao'] ?? 0);
    $avaliacao = intval($_POST['avaliacao'] ?? 0);
    if ($id_missao && ($avaliacao === 1 || $avaliacao === -1)) {
        // inserir apenas se ainda não existir (unique key evita duplicatas)
        $stmt = $conn->prepare('INSERT IGNORE INTO avaliacoes (id_usuario,id_missao,avaliacao) VALUES (?,?,?)');
        $stmt->bind_param('iii', $_SESSION['user_id'], $id_missao, $avaliacao);
        $stmt->execute();
    }
}
header('Location: ../pages/mural.php'); exit;
?>