<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$senha_correta = "12345678"; 
$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha_digitada = $_POST['senha'] ?? '';

    if ($senha_digitada === $senha_correta) {
        $_SESSION['funcionario_autenticado'] = true;
        session_write_close(); 
        
        header("Location: telaFuncionarios.php");
        exit;
    } else {
        $erro = "Senha incorreta! Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aba de Funcionários</title>
    <link rel="stylesheet" href="CSS/abaFuncionarios.css">
</head>
<body>

    <a href="filmes.php" class="seta-voltar">&lsaquo;</a>

    <div class="container-funcionarios">
        <h1 class="titulo-aba">Aba de funcionarios</h1>
        
        <h2 class="subtitulo-login">Digite a senha para entrar</h2>

        <form action="abaFuncionarios.php" method="POST" class="form-senha">
            <div class="grupo-input">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>

            <button type="submit" class="btn-entrar">Entrar</button>

            <?php if (!empty($erro)): ?>
                <p class="erro-msg"><?php echo $erro; ?></p>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>