<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db/conexao.php';


if (!isset($_SESSION['funcionario_autenticado'])) {
    $_SESSION['funcionario_autenticado'] = true;
}


$stmt = $pdo->query("SELECT * FROM filmesByFuncionarios ORDER BY id DESC");
$filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="filmes.php" class="seta">&lsaquo; Sair do Painel</a>
    <h1>Gerenciar Catálogo</h1>
    <a href="formulario_novo_filme.php" class="btn-add">+ Adicionar Novo Filme</a>

    <table>
    <thead>
        <tr>
            <th>Capa</th>
            <th>Título</th>
            <th>Diretor</th>
            <th>Ano</th>
            <th>Ações</th> </tr>
    </thead>
    <tbody>
        <?php foreach ($filmes as $f): ?>
            <tr>
                <td><img src="<?= htmlspecialchars($f['imagem_url']) ?>" width="50"></td>
                <td><?= htmlspecialchars($f['titulo']) ?></td>
                <td><?= htmlspecialchars($f['diretor'] ?? '') ?></td>
                <td><?= htmlspecialchars($f['ano_lancamento'] ?? '') ?></td>
                
                <td>
                    <a href="formulario_novo_filme.php?edit=<?= $f['id'] ?>" class="btn-edit">Editar</a>

                    <a href="excluirFilme.php?id=<?= $f['id'] ?>" class="btn-del" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>

<?php
if (isset($_GET['del'])) {
    $id = (int)$_GET['del'];
    $pdo->prepare("DELETE FROM filmesByFuncionarios WHERE id = ?")->execute([$id]);
    header("Location: telaFuncionarios.php");
    exit;
}
?>