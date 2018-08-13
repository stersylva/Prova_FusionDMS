<?php
    include 'header.php';
?>
	
	<table id="dg" title="Motoristas" class="easyui-datagrid" style="width:1200px;height:400px"
			url="php/get_motorista.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nome" width="50">Nome</th>
				<th field="cnh" width="50">CNH</th>
				<th field="rg" width="50">RG</th>
				<th field="cpf" width="50">CPF</th>
				<th field="data_nascimento" width="50">Nascimento</th>
				<th field="data_hora_cadastro" width="50">Hora Cadastro</th>
				<th field="quantidade" width="50">Quantidade Veiculos</th>
				<th field="ultimo_veiculo" width="50">Último Veiculo</th>
				<th field="ultimo_aluguel" width="50">Último Aluguel</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMotorista()">New Motorista</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMotorista()">Edit Motorista</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMotorista()">Remove Motorista</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informação do Motorista</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Nome do Motorista:</label>
				<input name="nome" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>CNH:</label>
				<input name="cnh" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>RG</label>
				<input name="rg" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>CPF</label>
				<input name="cpf" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Data de Nascimento</label>
				<input name="data_nascimento" class="easyui-textbox">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMotorista()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		function newMotorista(){
			$('#dlg').dialog('open').dialog('setTitle','New Motorista');
			$('#fm').form('clear');
			url = 'php/save_motorista.php';
		}
		function editMotorista(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Motorista');
				$('#fm').form('load',row);
				url = 'php/update_motorista.php?id='+row.id;
			}
		}
		function saveMotorista(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function destroyMotorista(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Atenção','Tem certeza que deseja excluir esse motorista?',function(r){
					if (r){
						$.post('php/destroy_motorista.php',{id:row.id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
</body>
</html>