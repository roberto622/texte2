<?php
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$arquivo = '../data/usuarios.json';
if (!file_exists($arquivo)) {
    die("⚠️ Arquivo de usuários não encontrado.");
}

$dados = json_decode(file_get_contents($arquivo), true);

if (isset($dados[$usuario]) && password_verify($senha, $dados[$usuario])) {
    $_SESSION['usuario'] = $usuario;
    header('Location: ../pages/menu.php');
    exit;
} else {
    header('Location: ../pages/login.php?erro=1');
    exit;
}
?>