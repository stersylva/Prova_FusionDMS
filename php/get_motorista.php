<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include 'conn.php';

	$query = "SELECT id, nome, cnh, rg, cpf, data_nascimento, data_hora_cadastro, (SELECT COUNT(*) FROM veiculo_aluguel WHERE motorista_id = m.id) AS quantidade,
(SELECT v.modelo FROM veiculo AS v
	LEFT JOIN veiculo_aluguel AS aluguel ON aluguel.veiculo_id = v.id
	WHERE m.id = aluguel.motorista_id ORDER BY aluguel.data_hora_fim DESC LIMIT 1) AS ultimo_veiculo,
	
(SELECT aluguel.data_hora_fim FROM veiculo_aluguel AS aluguel
	WHERE aluguel.motorista_id = m.id ORDER BY aluguel.data_hora_fim DESC LIMIT 1) AS ultimo_aluguel

FROM motorista m limit $offset, $rows";
	
	$rs = mysql_query("select count(*) from users");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query($query);
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>