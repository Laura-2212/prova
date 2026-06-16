<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db/conexao.php';

$menuClasse = "";
if (isset($_GET['menu']) && $_GET['menu'] == 'aberto') {
    $menuClasse = "ativo";
}

$modalClasse = "";
$filmeSelecionado = null;

try {
    $stmt = $pdo->query("SELECT * FROM filmesByFuncionarios ORDER BY id DESC");
    $filmesDoBanco = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $filmes = [];
    foreach ($filmesDoBanco as $f) {
        $filmes[$f['id']] = [
            "titulo"   => $f['titulo'],
            "imagem"   => $f['imagem_url'],
            "ano"      => $f['ano_lancamento'] ?? 'N/A',
            "diretor"  => $f['diretor'] ?? 'Não informado',
            "sinopse"  => !empty($f['sinopse']) ? $f['sinopse'] : "Sem sinopse disponível para este filme."
        ];
    }
} catch (PDOException $e) {
    $filmes = [];
}

if (isset($_GET['filme']) && array_key_exists($_GET['filme'], $filmes)) {
    $modalClasse = "ativo";
    $filmeSelecionado = $filmes[$_GET['filme']];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <div class="sidebar <?php echo $menuClasse; ?>" id="sidebarMenu">
        <a href="filmes.php" class="fechar-menu" style="text-decoration: none;">&times;</a>
        <nav class="links-menu">
            <a href="abaFuncionarios.php">Aba funcionários</a>
            <a href="logout.php" style="color:red;">Sair da Conta</a>
        </nav>
    </div>

    <header class="topo-pagina">
        <a href="filmes.php?menu=aberto" class="menu-hamburguer" style="text-decoration: none;">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </header>

    <main class="conteudo-principal">
        <h1 class="titulo-secao">Filmes</h1>

        <div class="grade-filmes">
            <?php foreach ($filmes as $id => $item): ?>
                <a href="alugarFilme.php?filme=<?php echo $id; ?>" class="cartao-filme">
                    <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>