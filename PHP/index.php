<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leitura Arquivo XML</title>

	<link rel="stylesheet" href="css/frm_flex.css">		
	<link rel="stylesheet" href="css/frmt.css">		
</head>
<body>
	
	<form id='frm_registro'>
		
		<h1>Importação Arquivo XML</h1>
			<div class='row'>
				<div class='grupo_cxs'>								
						<input id='txt_input'class='cx_texto' type="file">
				</div>		
			</div>	
			<div class='row'>
				<div class='grupo_cxs'>								
						<input class='config_btn' type="button" value='Ler Arquivo' id='btn_ler_arquivo'>
						<input class='config_btn' type="button" value='Limpar'>
				</div>		
			</div>			


			<div id='barra_separa'></div>	

			<table>
				<tr>
				    <th>Nome</th>
				    <th>Tipo / Hierarquia</th>
				    <th>Valor Tag</th>
				</tr>
				
				<tr>
					<td>0000</td>
					<td>0000</td>
					<td>0000</td>
				</tr>	
			</table>

	</form>

	<script  src='js/jquery-3.4.1.min.js'></script>
	<script  src='js/requisicao.js'></script>


</body>
</html>