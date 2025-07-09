<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$arquivoPedidos = '../data/pedidos.json';
$pedidos = file_exists($arquivoPedidos) ? json_decode(file_get_contents($arquivoPedidos), true) : [];

$meusPedidos = array_filter($pedidos, fn($p) => $p['usuario'] === $usuario);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../assets/styles.css">
  <title>Status dos Pedidos</title>
</head>
<body>
  <h2>📦 Pedidos de <?php echo htmlspecialchars($usuario); ?></h2>

  <?php if (empty($meusPedidos)): ?>
    <p>Você ainda não fez nenhum pedido.</p>
    <a href="menu.php">📋 Fazer Pedido</a>
  <?php else: ?>
    <?php foreach (array_reverse($meusPedidos) as $index => $pedido): ?>
      <div style="border:1px solid #ccc; margin: 15px; padding: 15px; max-width: 500px; margin-left:auto; margin-right:auto;">
        <strong>Data:</strong> <?= $pedido['data'] ?><br>
        <strong>Tipo:</strong> <?= $pedido['entrega'] === 'delivery' ? 'Delivery' : 'Consumo Local' ?><br>
        <?php if (!empty($pedido['endereco'])): ?>
          <strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco']) ?><br>
        <?php endif; ?>
        <strong>Status:</strong> <span class="status-badge"><?= htmlspecialchars($pedido['status'])?></span><br><br>

        <u>Itens:</u>
        <ul style="text-align:left;">
          <?php foreach ($pedido['itens'] as $item): ?>
            <li>
              <?= $item['quantidade'] ?> × <?= $item['produto']['nome'] ?> —
              R$ <?= number_format($item['produto']['preco'], 2, ',', '.') ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <a href="menu.php">🍔 Voltar ao Menu</a>
</body>
</html>