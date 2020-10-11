<?php 

$dir_destino = "xml/";
$file = $_FILES["arquivo"];

move_uploaded_file($file["tmp_name"], "$dir_destino/dados_leitura.xml");


$file_open = fopen('xml/dados_leitura.xml', "r");
$data = fgetcsv($file_open,10000);
$string_xml = $data[0]; 
$qtd_caract = strlen($string_xml);

$srting_utf8 = utf8_encode($string_xml);


$dados_acento = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú');	

$dados_SemAcento = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','0','U','U','U');


$string_xml_semacento = str_replace($dados_acento, $dados_SemAcento, $srting_utf8);
	

$indx_tag = 1;
$nivel_hierarquia = 1;
$dados = $string_xml_semacento;
$chave_abertura = '<';
$chave_fechamento = '>';
$pr_tag = 0;
$indx_tag_pai = 1;
$tag_pai_atual [] = "a";
$var_teste = 0;



for ($i=0; $i < $qtd_caract; $i++) { 


//EXTRAIR TEXTO 
$posicao_tag_abertura = stripos($dados, $chave_abertura);
$posicao_tag_fechamento = stripos($dados, $chave_fechamento);

			
			// FUNÇÃO IDENTIFICA PROXIMA TAG
			for ($l= $posicao_tag_fechamento +1; $l < $qtd_caract ; $l++) { 
					$pr_tag = substr($dados,$l,1);
						if ($pr_tag == $chave_abertura) {
							$pos_prox_tag = $l;
							break;
						}
			}
			



$tag_atual[$i]  = substr($dados, $posicao_tag_abertura +1, $posicao_tag_fechamento - 1);
$vlr_tag_atual[$i] = substr($dados, $posicao_tag_fechamento + 1 , $pos_prox_tag - $posicao_tag_fechamento -1);
$tipo_tag_atual[$i] = "nd";
 


$tag_fechamento = substr($dados, $posicao_tag_abertura +1,1);
$identifica_tag_pai = substr($dados, $posicao_tag_fechamento + 1, 1);



// RETORNA UM NÍVEL NA HIERARQUIA DAS TAGS, QUANDO LOCALIZA TAG FECHAMENTO
if ($indx_tag_pai > 1) {
	
		if ($tag_atual[$i] == "/" .  $tag_pai_atual[1] ) {
			
			$nivel_hierarquia = 1;
			$indx_tag_pai =1;
			
			
		}


			
}


                 


// EXCLUSÃO DE ALGUMAS TAGS
	if ($tag_fechamento != '/' && strtoupper($tag_atual[$i]) != 'CTE'
		&& strtoupper(substr($tag_atual[$i],0,7)) != 'CTEPROC' 
		&& strtoupper(substr($tag_atual[$i],0,6)) != 'INFCTE' ) {
		



			 if ($identifica_tag_pai == "<" && $nivel_hierarquia <= 1 ) {

			 			
			 			verificar_hierarquia();
			 			$vlr_tag_atual[$i] = "//";
                        $tag_pai_atual[$indx_tag_pai] = $tag_atual[$i];
                                              
                        $indx_tag_pai ++;
                        $nivel_hierarquia ++;

                   
			
	 			} elseif ($identifica_tag_pai == "<" && $nivel_hierarquia >= 2 ) {
			
					
			 		verificar_hierarquia();
					
			 		 $vlr_tag_atual[$i] = substr($dados, $posicao_tag_fechamento + 1 , $pos_prox_tag - $posicao_tag_fechamento -1);
			 		 $tag_pai_atual[$indx_tag_pai] = $tag_atual[$i];
			 		  $indx_tag_pai ++;
                        $nivel_hierarquia ++;


			 } else {

			 		
			 		verificar_hierarquia();
			 		 
			 		 $vlr_tag_atual[$i] = substr($dados, $posicao_tag_fechamento + 1 , $pos_prox_tag - $posicao_tag_fechamento -1);

			 }



		$tags[] = array('tg_nome' =>  $tag_atual[$i],
						 'tg_valor'	=> $vlr_tag_atual[$i],
	 					 'tg_tipo'	=> $tipo_tag_atual[$i]);



	}



$indx_tag ++;	

if (empty($tag_atual[$i])) {
	break;
}


$dados = substr($dados, $posicao_tag_fechamento + 1);
$array_dados_teste[] =   $var_teste;
}

echo(json_encode($tags));





function verificar_hierarquia(){
$indx = $GLOBALS['i'];

	if ($GLOBALS['nivel_hierarquia'] <=1) {
			$GLOBALS['tipo_tag_atual'][$indx] = "PAI";


	} elseif ($GLOBALS['nivel_hierarquia'] ==2) {

		$GLOBALS['tipo_tag_atual'][$indx] = "FILHO";


	}  elseif ($GLOBALS['nivel_hierarquia'] ==3) {

		$GLOBALS['tipo_tag_atual'][$indx] = "NETO";


	}  elseif ($GLOBALS['nivel_hierarquia'] == 4) {

		$GLOBALS['tipo_tag_atual'][$indx] = "BISNETO";

	}  elseif ($GLOBALS['nivel_hierarquia'] == 5) {

	$GLOBALS['tipo_tag_atual'][$indx] = "TRINETO";

	}

}



?>