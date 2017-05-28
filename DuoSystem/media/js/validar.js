$(document).ready(function(){	
	$("#sub").click(function(){
		
	});
	$("#FrmEditEst").validate({
		// Define as regras
		rules:{
			"cadastro[nome]":{
				required: true, minlength: 4
			},
			"cadastro[descricao]":{
				required: true, minlength: 4
			},
			"cadastro[data_inicio]":{
				required: true
			},
			"cadastro[data_fim]":{
				required:  {
                depends: function(element) {
                    return $("select[name='cadastro[status]'] option:checked").val() == 4 
					}
				}
            },
			"cadastro[status]":{
				required: true,
				min:1
			},	
			"cadastro[situacao]":{
				required: true
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			"cadastro[nome]":{
				required: "Digite o seu nome",
				minlength: "O seu nome deve conter ao menos 4 caracteres"
			},
			"cadastro[descricao]":{
				required: "Digite o descricao da atividade.",
				minlength: "A descricao deve conter ao menos 4 caracteres"
			},
			"cadastro[data_inicio]":{
				required: "Selecione data inicial"
				
			},
			"cadastro[data_fim]":{
				required: "Selecione data final"
				
			},
			"cadastro[status]":{
				required: "Selecione status",
				min: "Selecione status"
			},
			"cadastro[situacao]":{
				required: "Selecione o campo acima"
			}
			
		}
	});



});