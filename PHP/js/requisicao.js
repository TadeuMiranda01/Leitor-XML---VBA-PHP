
table =  document.querySelector('.tabela_fretes_demo')
btn = document.querySelector('#btn_ler_arquivo');
btn.addEventListener('click',leitura_xml);

btn_limpar = document.querySelector('#btn_limpar');
btn_limpar.addEventListener('click',limpar);

btn_pesquisa = document.querySelector('#btn_pesquisar');
btn_pesquisa.addEventListener('click',pesquisa_tag);

inputs = document.querySelector('.cx_text')
inputs.addEventListener('focus',foco_input);
inputs.addEventListener('blur',remove_foco_input);


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

console.log(data_xml);
}



function carrega_tabela(){


 let itm =''
			 itm +=	'<tr>'
			 itm += '<th id="col_nome">Nome</th>'
			 itm += '<th>Tipo / Hierarquia</th>'
			 itm +=  '<th>Valor Tag</th>'
			 itm +=  '</tr>'			


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
				
				// qt_reg++ ;
				cod ++;
	 	

			 	}	


			

			table.innerHTML = itm

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
}

function inibe_objetos(){
	
	 $('.container_table').css('display','none')
	$('.frmt_grupo_pesquisa').css('display','none')
	$('#titulo_mapeamento').css('display','none')
}