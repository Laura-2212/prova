<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$cliente_id = isset($_SESSION['cliente_id_logado']) ? $_SESSION['cliente_id_logado'] : null;
$cliente_nome = isset($_SESSION['cliente_logado']) ? $_SESSION['cliente_logado'] : '';

if (!$cliente_id || empty($cliente_nome)) {
        echo "<script>
                        alert('Você precisa estar logado como cliente para alugar um filme!'); 
                        window.location.href='login.php'; 
                    </script>";
        exit;
}

require_once 'db/conexao.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$id_filme = isset($_GET['filme']) ? (int)$_GET['filme'] : null;
$filmeSelecionado = null;

if ($id_filme) {
    try {
        $stmtCheckAluguel = $pdo->prepare("SELECT id FROM aluguelfilme WHERE filme_id = ? AND status = 'alugado'");
        $stmtCheckAluguel->execute([$id_filme]);
        $jaAlugado = $stmtCheckAluguel->fetch();

        if ($jaAlugado) {
            echo "<script>
                    alert('Este filme já foi alugado por outro cliente e não está disponível no momento!'); 
                    window.location.href='filmes.php'; 
                  </script>";
            exit;
        }

  
        $stmt = $pdo->prepare("SELECT * FROM filmesByFuncionarios WHERE id = ?");
        $stmt->execute([$id_filme]);
        $filmeDoBanco = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($filmeDoBanco) {
            $filmeSelecionado = [
                "id"       => $filmeDoBanco['id'],
                "titulo"   => $filmeDoBanco['titulo'],
                "imagem"   => $filmeDoBanco['imagem_url'], 
                "ano"      => $filmeDoBanco['ano_lancamento'] ?? 'N/A',
                "diretor"  => $filmeDoBanco['diretor'] ?? 'Não informado',
                "sinopse"  => $filmeDoBanco['sinopse'] ?? 'Sem sinopse disponível.'
            ];
        }
    } catch (PDOException $e) {
        echo "Erro ao verificar disponibilidade do filme: " . $e->getMessage();
        exit;
    }
}

if (!$filmeSelecionado) {
    echo "<script>alert('Filme não encontrado!'); window.location.href='filmes.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Aluguel de Filme</title>
    <link rel="stylesheet" href="css/aluguel.css">
</head>
<body>
    <a href="filmes.php" class="seta-voltar">&lsaquo;</a>
    <main class="container-aluguel">
        <h1 class="titulo-alugar">Alugar filme</h1>
        <div class="conteudo-aluguel">
            <div class="bloco-poster">
                <img src="<?php echo $filmeSelecionado['imagem']; ?>" alt="<?php echo htmlspecialchars($filmeSelecionado['titulo'], ENT_QUOTES, 'UTF-8'); ?>" class="poster-filme">
            </div>
            <div class="bloco-formulario">
                <form action="processa_aluguel.php" method="POST">
                    
                    <input type="hidden" name="cliente_id_banco" value="<?php echo $cliente_id; ?>">
                    <input type="hidden" name="filme_id_banco" value="<?php echo $filmeSelecionado['id']; ?>">
                    
                    <div class="grupo-input">
                        <label style="font-size: 12px; color: #7a7980; display:block;">Cliente</label>
                        <input type="text" name="usuario_tela" value="<?php echo htmlspecialchars($cliente_nome); ?>" readonly>
                    </div>
                    
                    <div class="grupo-input">
                        <label style="font-size: 12px; color: #7a7980; display:block;">Filme Selecionado</label>
                        <input type="text" value="<?php echo htmlspecialchars($filmeSelecionado['titulo']); ?>" readonly>
                    </div>
                    
                    <div class="grupo-input">
                        <label style="font-size: 12px; color: #7a7980; display:block;">data de emprestimo</label>
                        <input type="text" name="data_emprestimo" value="<?php echo date('d/m/Y'); ?>" readonly>
                    </div>
                    
                    <div class="grupo-input">
                        <label style="font-size: 12px; color: #7a7980; display:block;">data de devolução</label>
                        <input type="text" name="data_devolucao" value="<?php echo date('d/m/Y', strtotime('+2 days')); ?>" readonly>
                    </div>
                    
                    <button type="submit" class="btn-confirmar-aluguel">Alugar filme</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>