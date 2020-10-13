
table =  document.querySelector('.tabela_fretes_demo')
info_qtd_reg = document.querySelector('#total_qtd_reg')
btn = document.querySelector('#btn_ler_arquivo');
btn.addEventListener('click',leitura_xml);

btn_limpar = document.querySelector('#btn_limpar');
btn_limpar.addEventListener('click',limpar);

btn_pesquisa = document.querySelector('#btn_pesquisar');
btn_pesquisa.addEventListener('click',define_pesquisa);

inputs = document.querySelector('.cx_text')
inputs.addEventListener('focus',foco_input);
inputs.addEventListener('blur',remove_foco_input);

input_select = document.querySelector('#cx_subtag1')
input_select.addEventListener('change',realiza_sub_pesquisa);
input_select.addEventListener('click',foco_input);
input_select.addEventListener('blur',remove_foco_input);

window.addEventListener('load', start)


function start(){
	tipo_pesquisa = 0;

}

function foco_input(event){
	//if (event.srcElement.id.substr(0,2) =='cx') {
	//}

	$(`#${event.srcElement.id}`).css('boxShadow','0px 0px 10px  #2F4F4F')

}

function remove_foco_input(event){
	
	$(`#${event.srcElement.id}`).css('boxShadow','none')

}



function leitura_xml (){


	var ext_file = $('#txt_input').val()
	var ext_file = ext_file.substr(-3,3)


		if(ext_file != 'xml') {
				$('#msg_erro').html('É permitido somente arquivos XML. Erro Leitura');
				exibe_erro()
				return;
		}


var fd = new FormData();
var arquivos = $('#txt_input')[0].files[0];	
fd.append ('arquivo', arquivos);



	$.ajax({
		url:'executa_leitura.php',
		type:'POST',
		data:fd,
		contentType: false,
    	processData: false,
		success:function(retorno){
			
			data_xml = JSON.parse(retorno);
		    qtd_itns = data_xml.length

		    carrega_tabela()
		    exibe_objetos()
			
		}

	});


}

function pesquisa_tag(){

		if($('#cx_pesquisa').val() =='') {
				$('#msg_erro').html('Preencha uma Tag para realizar a pesquisa');
				$('#msg_erro').css('backgroundColor','#00FF7F')
				$('#msg_erro').css('color','black')
				$('#msg_erro').css('fontWeight','100')
				exibe_erro()
				return;
		}

let chave = 0;
let dados = JSON.stringify(data_xml);


if (tipo_pesquisa == 0) {
	 chave = $('#cx_pesquisa').val();

	}else {
	 chave = $('#cx_subtag1').val();	
}



	$.ajax({
		method:'POST',
		url:'executa_pesquisa.php',
		data:{dados_php:dados,chave_php:chave},
		success:function(retorno){
			
			dados_retorno = JSON.parse(retorno);
			qtd_tags_retorno = dados_retorno.length
		   	qtd_itns = dados_retorno[1]				

				$('#cx_subtag1').html('');
			
				if (dados_retorno[0] == 1) { 	//sub com outras tags
						
						$('.grupo_sub_tag1').css('display','block');
						$('#cx_subtag1').append(`<option></option>`)
						for (var i = 2; i < qtd_tags_retorno ; i++) {
							
							$('#cx_subtag1').append(`<option>${dados_retorno[i]}</option>`)
						}

						$('#msg_erro').html("Tag Localizada. Selecione a próxima tag na opção, 'Sub Tags'");


					
				} else {                        // unico valor		   
					
					$('#msg_erro').html("Tag Localizada.Valor único retornado");
					$('#valor_retorno_nome').html(dados_retorno[2]);
					$('#valor_retorno_tipo').html(dados_retorno[3]);
					$('#valor_retorno_valorTag').html(dados_retorno[4]);


				}
	
				$('#msg_erro').css('backgroundColor','#6E7B8B')
				$('#msg_erro').css('color','black')
				$('#msg_erro').css('border','1px solid black')
				$('#msg_erro').css('fontWeight','600')
		   		exibe_erro()
				
		    carrega_tabela()
		    
			
		}

	});


}



function carrega_tabela(){


 let itm =''
			 itm +=	'<tr>'
			 itm += '<th id="col_nome">Nome Tag</th>'
			 itm += '<th>Tipo / Hierarquia</th>'
			 itm +=  '<th>Valor</th>'
			 itm +=  '</tr>'			

			 qt_reg = 0;
			 let cod = 1;
			 for (var i = 0; i < qtd_itns; i++) {


			 				if (cod === 3) {
									cod = 1
								}
								

								if (cod === 1) {
									var cls = 'styline_line_table_2'
								} else if (cod === 2) {
									var cls = 'styline_line_table_1'
								}

			 		

			 	itm +=`<tr class="${cls}">`
				itm +=`<td class="col1">${data_xml[i].tg_nome}</td>`
				itm +=`<td class="col2">${data_xml[i].tg_tipo}</td>`
				itm +=`<td class="col3">${data_xml[i].tg_valor}</td>`
				itm +=`</tr>`
				
				qt_reg++ ;
				cod ++;
	 	

			 	}	


				
			info_qtd_reg.innerHTML =  qt_reg 
			table.innerHTML = itm

}

function define_pesquisa() {
	tipo_pesquisa = 0;
	pesquisa_tag()
}


function realiza_sub_pesquisa(){	
	tipo_pesquisa = 1;
	pesquisa_tag()
}


function limpar(){
	$('#txt_input').val('')
	inibe_objetos()
}


function exibe_erro() {
	$('#msg_erro').css('display','block')
	window.setTimeout(inibe_erro,5000)
}


function inibe_erro() {
	$('#msg_erro').css('display','none')
}

function exibe_objetos() {

 	$('.container_table').css('display','block')
	$('.frmt_grupo_pesquisa').css('display','block')
	$('#titulo_mapeamento').css('display','block')
	$('#bloco_qtd_reg').css('display','block')
	$('.bloco_retorno_tags').css('display','block')


}

function inibe_objetos(){
	
	$('.container_table').css('display','none')
	$('.frmt_grupo_pesquisa').css('display','none')
	$('#titulo_mapeamento').css('display','none')
	$('#bloco_qtd_reg').css('display','none')
	$('.bloco_retorno_tags').css('display','none')
}
