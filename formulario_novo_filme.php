<?php

require_once 'db/conexao.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['edit']) ? (int)$_GET['edit'] : null;
$titulo = "";
$diretor = "";
$ano = "";
$url = "";
$sinopse = ""; 
$mensagem_erro = "";

if ($id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM filmesByFuncionarios WHERE id = ?");
        $stmt->execute([$id]);
        $filme = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($filme) {
            $titulo = $filme['titulo'];
            $diretor = $filme['diretor'] ?? '';
            $ano = $filme['ano_lancamento'] ?? '';
            $url = $filme['imagem_url'];
            $sinopse = $filme['sinopse'] ?? ''; 
        }
    } catch (PDOException $e) {
        $mensagem_erro = "Erro ao buscar: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_post = $_POST['titulo_filme'] ?? '';
    $diretor_post = $_POST['diretor_filme'] ?? '';
    $ano_post = !empty($_POST['ano_filme']) ? (int)$_POST['ano_filme'] : null;
    $url_post = $_POST['url_filme'] ?? '';
    $sinopse_post = $_POST['sinopse_filme'] ?? ''; 

    if (!empty($titulo_post) && !empty($url_post)) {
        try {
            if ($id) {

                $sql = "UPDATE filmesByFuncionarios SET titulo = ?, diretor = ?, ano_lancamento = ?, imagem_url = ?, sinopse = ? WHERE id = ?";
                $pdo->prepare($sql)->execute([$titulo_post, $diretor_post, $ano_post, $url_post, $sinopse_post, $id]);
            } else {
              
                $sql = "INSERT INTO filmesByFuncionarios (titulo, diretor, ano_lancamento, imagem_url, sinopse) VALUES (?, ?, ?, ?, ?)";
                $pdo->prepare($sql)->execute([$titulo_post, $diretor_post, $ano_post, $url_post, $sinopse_post]);
            }

            echo "<script>alert('Filme salvo com sucesso!'); window.location.href='telaFuncionarios.php';</script>";
            exit;
        } catch (PDOException $e) {
            $mensagem_erro = "Erro no Banco: " . $e->getMessage();
        }
    } else {
        $mensagem_erro = "Preencha o título e a URL da imagem.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme</title>
    <link rel="stylesheet" href="CSS/novoform.css">
    <style>
        .textarea-linha { width: 100%; background: transparent; border: 1px solid #7a7980; border-radius: 6px; padding: 10px; color: white; margin-bottom: 20px; outline: none; font-size: 15px; min-height: 100px; resize: vertical; }
    </style>
</head>
<body>

    <div class="header-add">
        <a href="telaFuncionarios.php" class="seta-voltar">&lsaquo;</a>
        <h1 class="titulo-pg"><?= $id ? 'Editar' : 'Adicionar' ?> filme</h1>
    </div>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="erro-alerta">
             <strong>Aviso:</strong> <?= htmlspecialchars($mensagem_erro) ?>
        </div>
    <?php endif; ?>

    <form action="formulario_novo_filme.php<?= $id ? '?edit=' . $id : '' ?>" method="POST">
        <div class="container-form">
            
            <div class="box-upload" onclick="document.getElementById('url_img').focus()">
                <span>+</span>
            </div>

            <div class="campos-texto">
                <input type="text" name="titulo_filme" placeholder="Título do filme" value="<?= htmlspecialchars($titulo) ?>" class="input-linha" required>
                <input type="text" name="diretor_filme" placeholder="Diretor" value="<?= htmlspecialchars($diretor) ?>" class="input-linha">
                <input type="number" name="ano_filme" placeholder="Ano de lançamento" value="<?= htmlspecialchars($ano) ?>" class="input-linha">
                
                <textarea name="sinopse_filme" placeholder="Sinopse/Descrição do filme" class="textarea-linha"><?= htmlspecialchars($sinopse) ?></textarea>
                
                <input type="text" id="url_img" name="url_filme" placeholder="URL da imagem da capa" value="<?= htmlspecialchars($url) ?>" class="input-linha" required>
            </div>

            <div style="width: 100%;">
                <button type="submit" class="btn-salvar">
                    <?= $id ? 'Salvar alterações' : 'Adicionar filme' ?>
                </button>
                <a href="telaFuncionarios.php" class="btn-cancelar">Cancelar</a>
            </div>
        </div>
    </form>

</body>
</html>