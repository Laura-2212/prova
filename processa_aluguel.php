<?php
require_once 'db/conexao.php';
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id      = $_POST['cliente_id_banco'] ?? null; 
    $filme_id        = $_POST['filme_id_banco'] ?? null; 
    $usuario_tela    = $_POST['usuario_tela'] ?? 'Visitante';
    $dataEmprestimo  = $_POST['data_emprestimo'] ?? '';
    $dataDevolucao   = $_POST['data_devolucao'] ?? '';


    if (!$cliente_id || !$filme_id) {
        echo "Erro: Dados do cliente ou do filme não foram enviados corretamente.";
        echo "<br><a href='filmes.php'>Voltar ao catálogo</a>";
        exit;
    }


    $p_emp = explode('/', $dataEmprestimo);
    $data_banco_emp = $p_emp[2] . '-' . $p_emp[1] . '-' . $p_emp[0];

    $p_dev = explode('/', $dataDevolucao);
    $data_banco_dev = $p_dev[2] . '-' . $p_dev[1] . '-' . $p_dev[0];

    try {
        $stmtCheck = $pdo->prepare("SELECT id FROM aluguelfilme WHERE filme_id = ? AND status = 'alugado'");
        $stmtCheck->execute([(int)$filme_id]);
        $jaAlugado = $stmtCheck->fetch();

        if ($jaAlugado) {
            ?>
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="refresh" content="4;url=filmes.php">
                <style>
                    body { background-color: #232226; color: #ffffff; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
                    .box { background-color: #2c2b33; padding: 40px; border-radius: 12px; text-align: center; border: 1px solid #ff6b6b; }
                    h1 { color: #ff6b6b; }
                </style>
            </head>
            <body>
                <div class="box">
                    <h1>Não foi possível alugar!</h1>
                    <p>Desculpe, outro usuário acabou de alugar este filme.</p>
                    <p style="font-size: 12px; color: #7a7980;">Retornando ao catálogo para escolher outro...</p>
                </div>
            </body>
            </html>
            <?php
            exit;
        }
        $sql = "INSERT INTO aluguelfilme (cliente_id, filme_id, status, data_aluguel, data_devolucao) 
                VALUES (:cliente_id, :filme_id, 'alugado', :data_aluguel, :data_devolucao)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':cliente_id'     => (int)$cliente_id, 
            ':filme_id'       => (int)$filme_id, 
            ':data_aluguel'   => $data_banco_emp,
            ':data_devolucao' => $data_banco_dev
        ]);
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="3;url=filmes.php">
            <style>
                body { background-color: #232226; color: #ffffff; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
                .box { background-color: #2c2b33; padding: 40px; border-radius: 12px; text-align: center; border: 1px solid #FCEAA6; }
                h1 { color: #FCEAA6; }
            </style>
        </head>
        <body>
            <div class="box">
                <h1>Aluguel Gravado com Sucesso!</h1>
                <p>Filme reservado para o cliente: <strong><?php echo htmlspecialchars($usuario_tela); ?></strong></p>
                <p style="font-size: 12px; color: #7a7980;">Retornando ao catálogo...</p>
            </div>
        </body>
        </html>
        <?php
    } catch (PDOException $e) {
        echo "Erro ao salvar no banco: " . $e->getMessage();
    }
} else {
    header("Location: filmes.php");
    exit;
}
?>