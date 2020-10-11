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
						<input id='txt_input' name='txt_input' class='cx_texto' type="file">
				</div>	
			</div>		
			<div class='row'>	
				<div class='grupo_cxs'>								
						<input class='config_btn' type="button" value='Ler Arquivo' id='btn_ler_arquivo'>
						<input class='config_btn' type="button" value='Limpar' id='btn_limpar'>
				</div>		
			</div>	

			<div id='barra_separa'></div>	

			
				<h1 id='titulo_mapeamento'>Mapeamento de TAGs</h1>	

					<div class="row frmt_grupo_pesquisa">	
						<div class="grupo_cxs col-4" id="grupo_cx_pesquisar">
							<label class="titulo_txt">Pesquisar Tag</label>
							<input class="cx_text" type="text" id="cx_pesquisa">											
						</div>	
						<div class='grupo_cxs'>								
							<input class='config_btn' type="button" value='Pesquisar' id='btn_pesquisar'>						
					</div>		
				</div>

				<div class='container_table'>
						<table class='tabela_fretes_demo frmt_tabela_fretes'>	
						</table>
				</div>	

		

			<div id='msg_erro'>Erro personalizado</div>

	</form>

	<script  src='js/jquery-3.4.1.min.js'></script>
	<script  src='js/requisicao.js'></script>


</body>
</html>