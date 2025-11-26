<?php
// db.php - ajuste as credenciais conforme seu ambiente
define('DB_HOST','127.0.0.1');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','missoes_do_dia');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_errno) {
    die('Erro na conexão: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>