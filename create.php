<?php
require 'db.php';

$errors = [];
$nome = '';
$unidade = '';
$estoque_atual = 0;
$preco = 0.00;
$descricao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = trim($_POST['nome'] ?? '');
  $unidade = trim($_POST['unidade'] ?? '');
  $estoque_atual = $_POST['estoque_atual'] ?? '';
  $preco = $_POST['preco'] ?? '';
  $descricao = trim($_POST['descricao'] ?? '');

  if ($nome === '') $errors[] = 'O nome é obrigatório.';
  if ($unidade === '') $errors[] = 'A unidade é obrigatória.';

  if ($estoque_atual === '' || !is_numeric($estoque_atual) || intval($estoque_atual) < 0) {
    $errors[] = 'Estoque atual deve ser um número inteiro maior ou igual a 0.';
  } else {
    $estoque_atual = intval($estoque_atual);
  }

  if ($preco === '' || !is_numeric($preco) || floatval($preco) < 0) {
    $errors[] = 'Preço deve ser um número maior ou igual a 0.';
  } else {
    $preco = number_format((float)$preco, 2, '.', '');
  }

  if (empty($errors)) {
    $stmt = $pdo->prepare('INSERT INTO insumos (nome, unidade, estoque_atual, preco, descricao) VALUES (:nome, :unidade, :estoque_atual, :preco, :descricao)');
    $stmt->execute([
      ':nome' => $nome,
      ':unidade' => $unidade,
      ':estoque_atual' => $estoque_atual,
      ':preco' => $preco,
      ':descricao' => $descricao
    ]);
    header('Location: index.php?msg=' . urlencode('Insumo criado com sucesso.'));
    exit;
  }
}
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Novo Cadastro</title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="container">
    <h1>Novo Cadastro</h1>
    <?php if (!empty($errors)): ?>
      <div class="message error">
        <ul><?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?></ul>
      </div>
    <?php endif; ?>

    <form method="post">
      <label>Nome</label>
      <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>">

      <label>Unidade</label>
      <input type="text" name="unidade" value="<?php echo htmlspecialchars($unidade); ?>">

      <label>Estoque Atual</label>
      <input type="number" name="estoque_atual" min="0" value="<?php echo htmlspecialchars($estoque_atual); ?>">

      <label>Preço</label>
      <input type="text" name="preco" value="<?php echo htmlspecialchars($preco); ?>">
      <div style="margin-top:10px;">
        <button class="button" type="submit">Salvar</button>
        <a class="button secondary" href="index.php">Cancelar</a>
      </div>
    </form>
  </div>
</body>

</html>