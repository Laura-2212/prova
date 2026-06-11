<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db/conexao.php';

try {

    $stmt = $pdo->query("SELECT * FROM filmesByFuncionarios ORDER BY id DESC");
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    $filmes = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="CSS/filmesedit.css">

</head>
<body>

    <header>
        <div class="flex-titulo">
            <a href="login.php" class="seta-voltar">&lsaquo;</a>
            <h1 class="titulo-pagina">Filmes</h1>
        </div>

        <a href="abaFuncionarios.php" class="link-funcionario">
            <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            funcionario novo?
        </a>
    </header>

    <main class="grid-filmes">
        
        <?php foreach ($filmes as $f): ?>
            <div class="card-filme">
                <a href="alugarFilme.php?filme=<?= $f['id']; ?>">
                    <?php 
                        $url_capa = isset($f['imagem_url']) ? $f['imagem_url'] : ($f['url_filme'] ?? ''); 
                        $titulo_filme = isset($f['titulo']) ? $f['titulo'] : ($f['titulo_filme'] ?? 'Filme');
                    ?>
                    <img src="<?= htmlspecialchars($url_capa); ?>" alt="<?= htmlspecialchars($titulo_filme); ?>">
                </a>
            </div>
        <?php endforeach; ?>

        <a href="formulario_novo_filme.php" class="btn-adicionar">
            <span class="icon-mais">+</span>
        </a>

    </main>

</body>
</html>