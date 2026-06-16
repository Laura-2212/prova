<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db/conexao.php';

$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_digitado = $_POST['usuario'] ?? '';
    $email_digitado   = $_POST['email'] ?? '';
    $senha_digitada   = $_POST['senha'] ?? '';

    if (!empty($email_digitado) && !empty($senha_digitada)) {
        try {

            $stmtCheck = $pdo->prepare("SELECT id, nome, senha FROM clientes WHERE email = :email");
            $stmtCheck->execute([':email' => $email_digitado]);
            $cliente_existente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($cliente_existente) {

                if ($senha_digitada == $cliente_existente['senha']) {
                    $_SESSION['cliente_id_logado'] = $cliente_existente['id'];
                    $_SESSION['cliente_logado']    = $cliente_existente['nome'];

                    header("Location: filmes.php");
                    exit;
                } else {
                    $mensagem_erro = "Senha incorreta para este e-mail!";
                }
            } else {

                if (!empty($usuario_digitado)) {
                    $sqlInsert = "INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)";
                    $stmtInsert = $pdo->prepare($sqlInsert);
                    $stmtInsert->execute([
                        ':nome'  => $usuario_digitado,
                        ':email' => $email_digitado,
                        ':senha' => $senha_digitada
                    ]);

                    $novo_id = $pdo->lastInsertId();

                    $_SESSION['cliente_id_logado'] = $novo_id;
                    $_SESSION['cliente_logado']    = $usuario_digitado;

                    header("Location: filmes.php");
                    exit;
                } else {
                    $mensagem_erro = "E-mail não cadastrado. Digite um nome no campo 'Usuário' para se cadastrar.";
                }
            }
        } catch (PDOException $e) {
            $mensagem_erro = "Erro no banco: " . $e->getMessage();
        }
    } else {
        $mensagem_erro = "Por favor, preencha o E-mail e Senha.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            background-image: url('img/fundo.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: white;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .erro-alerta {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ff6b6b;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 20px;
            text-align: center;
        }

        .titulo-login {
            color: #FCEAA6;
            font-size: 45px;
            font-weight: 400;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        .input-grupo {
            position: relative;
            margin-bottom: 30px;
        }

        .input-grupo input {
            width: 100%;
            padding: 10px 0;
            background: transparent;
            border: none;
            border-bottom: 1.5px solid #757575;
            color: #ffffff;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-grupo label {
            position: absolute;
            left: 0;
            top: 10px;
            color: #757575;
            pointer-events: none;
            transition: 0.3s ease all;
            font-size: 16px;
        }

        .input-grupo input:focus~label,
        .input-grupo input:not(:placeholder-shown)~label {
            top: -15px;
            font-size: 12px;
            color: #FCEAA6;
        }

        .input-grupo input:focus {
            border-bottom: 1.5px solid #FCEAA6;
        }

        .btn-enviar {
            width: 100%;
            background-color: #FCEAA6;
            color: #232226;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .btn-enviar:hover {
            background-color: #edd987;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h1 class="titulo-login">Login</h1>

        <?php if (!empty($mensagem_erro)): ?>
            <div class="erro-alerta">
                <?= htmlspecialchars($mensagem_erro) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="input-grupo">
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">E-mail</label>
            </div>

            <div class="input-grupo">
                <input type="text" id="usuario" name="usuario" placeholder=" ">
                <label for="usuario">Usuário (deixe vazio se já tiver cadastro)</label>
            </div>

            <div class="input-grupo">
                <input type="password" id="senha" name="senha" required placeholder=" ">
                <label for="senha">Senha</label>
            </div>

            <button type="submit" class="btn-enviar">Entrar</button>
        </form>
    </div>

</body>

</html>