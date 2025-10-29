<?php
require 'db.php';
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($search !== '') {
  $stmt = $pdo->prepare("SELECT * FROM insumos WHERE nome LIKE :q ORDER BY id DESC");
  $stmt->execute([':q' => "%$search%"]);
} else {
  $stmt = $pdo->query("SELECT * FROM insumos ORDER BY id DESC");
}
$insumos = $stmt->fetchAll();
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Farmácia Vila Boa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="container">
    <h1>Farmácia Vila Boa</h1>

    <div style="display:flex;justify-content:space-between;align-items:center;">
      <form method="get" class="searchbox">
        <input type="search" name="q" placeholder="Buscar por nome..." value="<?php echo htmlspecialchars($search); ?>" />
        <button class="button" type="submit">Buscar</button>
      </form>
    </div>
    <div>
      <a class="button" href="create.php">Novo Cadastro</a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
      <div class="message success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Unidade</th>
          <th>Estoque</th>
          <th>Preço</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($insumos) === 0): ?>
          <tr>
            <td colspan="6" class="small">Nenhum cadastro encontrado</td>
          </tr>
        <?php else: ?>
          <?php foreach ($insumos as $i): ?>
            <tr>
              <td><?php echo htmlspecialchars($i['id']); ?></td>
              <td><?php echo htmlspecialchars($i['nome']); ?></td>
              <td><?php echo htmlspecialchars($i['unidade']); ?></td>
              <td><?php echo htmlspecialchars($i['estoque_atual']); ?></td>
              <td><?php echo number_format($i['preco'], 2, ',', '.'); ?></td>
              <td class="actions">
                <a href="edit.php?id=<?php echo $i['id']; ?>">Editar</a>
                <form method="post" action="delete.php" style="display:inline" onsubmit="return confirm('Confirma exclusão?');">
                  <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
                  <button class="button secondary" type="submit">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>