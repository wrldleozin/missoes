<?php
// helpers
if (session_status() === PHP_SESSION_NONE) session_start();

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function getUserName($conn, $user_id) {
    $stmt = $conn->prepare('SELECT nome FROM usuarios WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return $res['nome'] ?? null;
}
?>