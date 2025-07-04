<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $arquivo = '../data/usuarios.json';
    $dados = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

    if (isset($dados[$usuario])) {
        echo "⚠️ Nome de usuário já existe. <a href='../pages/cadastro.php'>Tente novamente</a>";
        exit;
    }

    $dados[$usuario] = $senha;
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    echo "✅ Cadastro realizado com sucesso. <a href='../pages/login.php'>Fazer login</a>";
}
?>