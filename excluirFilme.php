<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db/conexao.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id) {
    try {

        $stmt = $pdo->prepare("DELETE FROM filmesByFuncionarios WHERE id = ?");
        $stmt->execute([$id]);
        

        echo "<script>
                alert('Filme excluído com sucesso!');
                window.location.href = 'telaFuncionarios.php';
              </script>";
        exit;
        
    } catch (PDOException $e) {

        echo "<script>
                alert('Erro ao excluir filme: " . addslashes($e->getMessage()) . "');
                window.location.href = 'telaFuncionarios.php';
              </script>";
        exit;
    }
} else {

    header("Location: telaFuncionarios.php");
    exit;
}
?>