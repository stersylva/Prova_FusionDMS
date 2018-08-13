<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

//$sql = "DELETE m, va FROM motorista m
  //   	inner JOIN veiculo_aluguel va ON m.id = va.motorista_id
   //  	WHERE m.id = $id"
$sql = "delete from motorista where id=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>