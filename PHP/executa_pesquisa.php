<?php


$dados_string_xml = $_POST["dados_php"];
$chave_pesquisa  = $_POST["chave_php"];
$objeto_xml = json_decode($dados_string_xml);
$qtd_itens = count($objeto_xml);



/*Retorno da função é realizado através de um array com os seguintes valores :
[0] - Primeiro valor corresponde ao tipo de retorno, podendo ser 1 ou 2.
	1 - Tag pesquisada não tem um único valor e sim uma sub com outras tags. 
	2 - Tag pesquisada tem somente um valor.

[1] -  corresponde a quantidade de itens que será carregado na listagem. Exmplo: Se a tag pesquisada estiver no index 5, o retorno desse item será = 4.

[2,3,4...] - Dados 

*/


for ($i=0; $i < $qtd_itens; $i++) { 
	

		if (strtoupper($chave_pesquisa) ==  strtoupper($objeto_xml[$i]->tg_nome)  ) {
							
						// TAG FILHO
						if ($objeto_xml[$i]->tg_tipo == 'FILHO') {
							
								// CARREGAR SUBS
								if ($objeto_xml[$i + 1 ]->tg_tipo == 'NETO') {

										for ($m = $i; $m < $qtd_itens ; $m++) { 
											
											if ($objeto_xml[$m + 1 ]->tg_tipo != 'NETO') {
												
												array_unshift($dados_retorno, 1,$i);
												break;
											}

											$dados_retorno [] = $objeto_xml[$m + 1]->tg_nome;
											
										}
										

								}	else {

									$dados_retorno = [2,$i, $objeto_xml[$i]->tg_nome, $objeto_xml[$i]->tg_tipo,$objeto_xml[$i]->tg_valor];
								}

						//echo(print_r($dados_retorno));
						echo(json_encode($dados_retorno));		
						exit;	
						}


					//TAG NETO	
					if ($objeto_xml[$i]->tg_tipo == 'NETO') {
							
								// CARREGAR SUBS
								if ($objeto_xml[$i + 1 ]->tg_tipo == 'BISNETO') {

										for ($m = $i; $m < $qtd_itens ; $m++) { 
											
											if ($objeto_xml[$m + 1 ]->tg_tipo != 'BISNETO') {
												
												array_unshift($dados_retorno, 1,$i);
												break;
											}

											$dados_retorno [] = $objeto_xml[$m + 1]->tg_nome;
											
										}
										

								}	else {

									$dados_retorno = [2,$i, $objeto_xml[$i]->tg_nome, $objeto_xml[$i]->tg_tipo,$objeto_xml[$i]->tg_valor];
								}

						//echo(print_r($dados_retorno));
						echo(json_encode($dados_retorno));		
						exit;	
						}

				//TAG BISNETO	
				if ($objeto_xml[$i]->tg_tipo == 'BISNETO') {
							
								// CARREGAR SUBS
								if ($objeto_xml[$i + 1 ]->tg_tipo == 'TRINETO') {

										for ($m = $i; $m < $qtd_itens ; $m++) { 
											
											if ($objeto_xml[$m + 1 ]->tg_tipo != 'TRINETO') {
												
												array_unshift($dados_retorno, 1,$i);
												break;
											}

											$dados_retorno [] = $objeto_xml[$m + 1]->tg_nome;
											
										}
										

								}	else {

									$dados_retorno = [2,$i, $objeto_xml[$i]->tg_nome, $objeto_xml[$i]->tg_tipo,$objeto_xml[$i]->tg_valor];
								}

						//echo(print_r($dados_retorno));
						echo(json_encode($dados_retorno));		
						exit;	
						}


				//TAG TRINETO	
				if ($objeto_xml[$i]->tg_tipo == 'TRINETO') {
							
							

									$dados_retorno = [2,$i, $objeto_xml[$i]->tg_nome, $objeto_xml[$i]->tg_tipo,$objeto_xml[$i]->tg_valor];
								

						//echo(print_r($dados_retorno));
						echo(json_encode($dados_retorno));		
						exit;	
						}

						

				//TAG PAI	
				if ($objeto_xml[$i]->tg_tipo == 'PAI') {
							
								// CARREGAR SUBS
								if ($objeto_xml[$i + 1 ]->tg_tipo == 'FILHO') {

										for ($m = $i; $m < $qtd_itens ; $m++) { 
											
											if ($objeto_xml[$m + 1 ]->tg_tipo != 'FILHO') {
												
												array_unshift($dados_retorno, 1,$i);
												break;
											}

											$dados_retorno [] = $objeto_xml[$m + 1]->tg_nome;
											
										}
										

								}	else {

									$dados_retorno = [2,$i, $objeto_xml[$i]->tg_nome, $objeto_xml[$i]->tg_tipo,$objeto_xml[$i]->tg_valor];
								}

						//echo(print_r($dados_retorno));
						echo(json_encode($dados_retorno));		
						exit;	
						}	


			

		}


}



echo('nao loacalizado');

//echo($chave_pesquisa);
//echo(print_r($objeto_xml[0]->tg_nome));

?>