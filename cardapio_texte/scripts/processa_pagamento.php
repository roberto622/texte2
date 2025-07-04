<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../pages/login.php');
    exit;
}

$metodo = $_POST['metodo'];

// Aqui, você poderia validar os dados conforme o método
// Mas como é simulação, basta redirecionar com sucesso

echo "✅ Pagamento simulado via <strong>" . strtoupper($metodo) . "</strong> realizado com sucesso!<br><br>";
echo "<a href='../pages/menu.php'>Fazer novo pedido</a> | ";
echo "<a href='../pages/status.php'>Ver status do pedido</a>";
?>