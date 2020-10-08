
btn = document.querySelector('#btn_ler_arquivo');

btn.addEventListener('click',leitura_xml);


function leitura_xml (){


let valor = '1'	

	$.ajax({
		method:'POST',
		url:'executa_leitura.php',
		data:{var_php:valor},
		success:function(retorno){
			
			console.log(retorno)
		}

	});


}