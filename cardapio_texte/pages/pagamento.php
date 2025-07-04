<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../assets/styles.css">
  <title>Pagamento</title>
  <style>
    .metodo {
      margin: 15px;
      border: 1px solid #ccc;
      padding: 15px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }
    input[type="text"], input[type="number"] {
      width: 90%;
      padding: 8px;
      margin-top: 8px;
    }
  </style>
</head>
<body>
  <h2>💳 Finalizar Pagamento</h2>

  <form method="POST" action="../scripts/processa_pagamento.php">
    <div class="metodo">
      <label><input type="radio" name="metodo" value="pix" checked> 💰 Pix</label><br>
      <label><input type="radio" name="metodo" value="cartao"> 💳 Cartão</label><br>
      <label><input type="radio" name="metodo" value="qr"> 📱 QRCode</label>
    </div>

    <div id="detalhes-cartao" class="metodo" style="display:none;">
      <h4>Dados do Cartão</h4>
      <input type="text" name="numero_cartao" placeholder="Número do cartão"><br>
      <input type="text" name="nome_titular" placeholder="Nome no cartão"><br>
      <input type="number" name="cvv" placeholder="CVV">
    </div>

    <button type="submit">✅ Confirmar Pagamento</button>
  </form>

  <script>
    const radios = document.querySelectorAll('input[name="metodo"]');
    const cartaoBox = document.getElementById('detalhes-cartao');

    radios.forEach(r => {
      r.addEventListener('change', () => {
        cartaoBox.style.display = r.value === 'cartao' ? 'block' : 'none';
      });
    });
  </script>

  <br><a href="menu.php">Voltar ao menu</a>
</body>
</html>