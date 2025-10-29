<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $stmt = $pdo->prepare('DELETE FROM insumos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        header('Location: index.php?msg=' . urlencode('Insumo excluído com sucesso.'));
        exit;
    }
}
header('Location: index.php');
exit;
?>