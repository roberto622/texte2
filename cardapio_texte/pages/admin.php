<?php
session_start();
// Verifica se o usuário é admin (ajuste conforme seu sistema de login)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header('Location: login.php');
    exit;
}
$pedidos = json_decode(file_get_contents('../data/pedidos.json'), true);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../assets/styles.css">
  <title>Painel do Administrador</title>
</head>
<body>
  <div class="menu-welcome">
    👨‍💼 Painel do Administrador - Visualização de Pedidos
  </div>
  <table class="menu-table">
    <tr>
      <th>Usuário</th>
      <th>Itens</th>
      <th>Entrega</th>
      <th>Endereço</th>
      <th>Status</th>
      <th>Data</th>
    </tr>
    <?php foreach ($pedidos as $pedido): ?>
      <tr>
        <td><?php echo htmlspecialchars($pedido['usuario']); ?></td>
        <td>
          <?php
            foreach ($pedido['itens'] as $item) {
              echo htmlspecialchars($item['produto']['nome']) . " (x" . $item['quantidade'] . ")<br>";
            }
          ?>
        </td>
        <td><?php echo htmlspecialchars($pedido['entrega']); ?></td>
        <td><?php echo htmlspecialchars($pedido['endereco']); ?></td>
        <td><?php echo htmlspecialchars($pedido['status']); ?></td>
        <td><?php echo htmlspecialchars($pedido['data']); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <br>
  <a href="menu.php">Voltar ao Menu</a>
</body>
</html>