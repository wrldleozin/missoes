<?php
require_once '../php/db.php';
require_once '../php/functions.php';
requireLogin();

$sql = "
SELECT missoes.*, usuarios.nome,
    (SELECT COUNT(*) FROM avaliacoes WHERE id_missao = missoes.id AND avaliacao = 1) AS likes,
    (SELECT COUNT(*) FROM avaliacoes WHERE id_missao = missoes.id AND avaliacao = -1) AS dislikes
FROM missoes
JOIN usuarios ON usuarios.id = missoes.id_usuario
ORDER BY missoes.criado_em DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mural</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .btn-like, .btn-dislike {
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            margin-right: 12px;
        }

        .btn-like {
            background: #2563eb;
            color: white;
        }

        .btn-like:hover {
            background: #1e40af;
        }

        .btn-dislike {
            background: #dc2626;
            color: white;
        }

        .btn-dislike:hover {
            background: #b91c1c;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.09);
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="nav-container">
        <div class="nav-left">
            <img src="../imgs/logo.png" class="nav-logo" alt="Logo">
            <span class="nav-title">Missões do Dia</span>
        </div>

        <div class="nav-links">
            <a class="nav-item" href="dashboard.php">Dashboard</a>
            <a class="nav-item" href="mural.php">Mural</a>
            <a class="nav-item" href="perfil.php">Perfil</a>
            <a class="nav-btn" href="logout.php">Sair</a>
        </div>
    </div>
</header>

<div class="container">
    <h2 style="margin-bottom: 25px;">Mural da Comunidade</h2>

<?php
while ($row = $result->fetch_assoc()) {

echo '
<div class="card">

    <p style="color:#6b7280; margin-bottom:6px;">
        Por: <strong>' . htmlspecialchars($row["nome"]) . '</strong>
    </p>

    <h3 style="margin-bottom:8px;">' . htmlspecialchars($row["texto"]) . '</h3>

    <p><strong>Experiência:</strong><br>' 
        . nl2br(htmlspecialchars($row["experiencia"])) .
    '</p>

    <div style="margin-top:15px;">
        
        <form method="POST" action="../php/avaliar.php" style="display:inline;">
            <input type="hidden" name="id_missao" value="' . $row["id"] . '">
            <input type="hidden" name="avaliacao" value="1">
            <button class="btn-like">👍 Curtir (' . $row["likes"] . ')</button>
        </form>

        <form method="POST" action="../php/avaliar.php" style="display:inline;">
            <input type="hidden" name="id_missao" value="' . $row["id"] . '">
            <input type="hidden" name="avaliacao" value="-1">
            <button class="btn-dislike">👎 Descurtir (' . $row["dislikes"] . ')</button>
        </form>

    </div>

</div>';
}
?>
</div>

</body>
</html>
