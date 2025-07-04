<?php
session_start();
$idProduto = $_POST['adicionar'];
$quantidades = $_POST['quantidade'];

$produtos = json_decode(file_get_contents('../data/produtos.json'), true);
$produtoSelecionado = null;

foreach ($produtos as $produto) {
    if ($produto['id'] == $idProduto) {
        $produtoSelecionado = $produto;
        break;
    }
}

if ($produtoSelecionado) {
    $qtd = isset($quantidades[$idProduto]) ? (int)$quantidades[$idProduto] : 1;
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (!isset($_SESSION['carrinho'][$idProduto])) {
        $_SESSION['carrinho'][$idProduto] = [
            'produto' => $produtoSelecionado,
            'quantidade' => $qtd
        ];
    } else {
        $_SESSION['carrinho'][$idProduto]['quantidade'] += $qtd;
    }
}

header('Location: ../pages/menu.php');
exit;