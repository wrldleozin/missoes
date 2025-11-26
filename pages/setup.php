<?php
// setup.php - execute uma vez via browser para criar o DB e um usuário de teste.
// Depois de usar, remova este arquivo por segurança.
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'missoes_do_dia';

$mysqli = new mysqli($host, $user, $pass);
if ($mysqli->connect_errno) {
    die('Erro: ' . $mysqli->connect_error);
}

// criar db e importar estrutura
$sql = file_get_contents('init_db.sql');
if (!$mysqli->multi_query($sql)) {
    die('Falha ao criar banco/tabelas: ' . $mysqli->error);
}
while ($mysqli->more_results()) { $mysqli->next_result(); }

// criar usuário de teste
$nome = 'Usuário Teste';
$email = 'teste@missoes.com';
$senha = '123456';
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$mysqli->select_db($dbname);
$stmt = $mysqli->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $stmt->close();
    $ins = $mysqli->prepare('INSERT INTO usuarios (nome,email,senha_hash) VALUES (?,?,?)');
    $ins->bind_param('sss', $nome, $email, $senha_hash);
    $ins->execute();
    $ins->close();
    echo 'Usuário de teste criado: ' . $email . ' / ' . $senha . "<br>";
} else {
    echo 'Usuário de teste já existe.<br>';
    $stmt->close();
}

echo 'Setup concluído. Remova setup.php por segurança.';
?>