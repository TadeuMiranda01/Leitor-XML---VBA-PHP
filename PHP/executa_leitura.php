<?php 

//$var = $_POST["var_php"];

$file_open = fopen('xml/SEM_FORMATACAO.xml', "r");
$data = fgetcsv($file_open,10000);
$string_xml =  $data[0]; 
$qtd_caract = strlen($string_xml);


$i = 0;
$dados = $string_xml;
$chave_abertura = '<';
$chave_fechamento = '>';

//$dados = '<abertura><informacao><tag2><tag3><tagggg4>dasdsodaosdoasdoa</informacao></abertura>';

for ($i=0; $i < $qtd_caract; $i++) { 


//EXTRAIR TEXTO 
$posicao_tag_abertura = stripos($dados, $chave_abertura);
$posicao_tag_fechamento = stripos($dados, $chave_fechamento);
$tag_atual[]  = substr($dados, $posicao_tag_abertura +1, $posicao_tag_fechamento - 1);

$tag_fechamento = substr($dados, $posicao_tag_abertura +1,1);
$identifica_tag_pai = substr($dados, $posicao_tag_fechamento + 1, 1);


if (empty($tag_atual[$i])) {
	break;
}






$array_dados_teste[] = $identifica_tag_pai;



// EXCLUSÃO DE ALGUMAS TAGS
	if ($tag_fechamento != '/') {
		



		$tags[] = array('tg_nome' =>  $tag_atual[$i],
						 'tg_valor'	=> "vazio",
	 					 'tg_tipo'	=> "vazio" );



	}





$dados = substr($dados, $posicao_tag_fechamento + 1);
}



echo(print_r($array_dados_teste));
?>