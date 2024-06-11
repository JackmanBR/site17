<?php

// Conexão com o banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obter os dados do castelo e informações do clã associado
    $stmt = $conn->query("SELECT c.*, cd.clan_name, cd.ally_name, cd.leader_id FROM castle c LEFT JOIN clan_data cd ON c.id = cd.hasCastle");
    $castles = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Castle Siege</title>
</head>
<body>
<h1>Castle Siege</h1>

<table width="95%" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nome do Castelo</th>
    <th>Taxa</th>
    <th>Data do Cerco</th>
    <th>Dono</th>
    <th>Ally</th>
    <th>Líder</th>
  </tr>
  <?php foreach ($castles as $castle): ?>
  <tr>
    <td align="center"><?php echo $castle['name']; ?></td>
    <td align="center"><?php echo $castle['taxPercent']; ?>%</td>
    <td align="center"><?php echo date('D, j M Y H:i', $castle['siegeDate']/1000); ?></td>
    <td align="center"><?php echo $castle['clan_name'] ? $castle['clan_name'] : 'Sem Dono'; ?></td>
    <td align="center"><?php echo $castle['ally_name'] ? $castle['ally_name'] : 'Sem Ally'; ?></td>
    <td align="center"><?php echo $castle['char_name'] ? $castle['char_name'] : 'Sem Líder'; ?></td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
