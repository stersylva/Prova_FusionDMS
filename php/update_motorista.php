<?php

$id = intval($_REQUEST['id']);
$nome = htmlspecialchars($_REQUEST['nome']);
$cnh = htmlspecialchars($_REQUEST['cnh']);
$rg = htmlspecialchars($_REQUEST['rg']);
$cpf = htmlspecialchars($_REQUEST['cpf']);
$data_nascimento = htmlspecialchars($_REQUEST['data_nascimento']);

include 'conn.php';

$sql = "update motorista set nome='$nome',cnh='$cnh',rg='$rg',cpf='$cpf',data_nascimento='$data_nascimento' where id=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $id,
		'nome' => $nome,
		'cnh' => $cnh,
		'rg' => $rg,
		'cpf' => $cpf,
		'data_nascimento' => $data_nascimento
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>