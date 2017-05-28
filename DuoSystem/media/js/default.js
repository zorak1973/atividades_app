+
$(document).ready(function(){
	
	/*$.widget("ui.form",{
	_init:function(){
	 var object = this;
	 var form = this.element;
	 var inputs = form.find("input , select ");
		//form.find("fieldset").addClass("ui-widget-content");
	 	form.find("legend").addClass("ui-widget-header ui-corner-all");
	 	form.addClass("ui-widget");
		$.each(inputs,function(){
			$(this).addClass('ui-state-default ui-corner-all');
			$(this).wrap("<label />");
			
		});
	},
		
	});
	$('#container_paginacao a').button();
	$("form").form();
	$("button").button();
	$("input[type='submit']").button();*/
	var base_url = $('input[name="base_url"]').val();
	
	//$('#cpf').mask('000.000.000-00', {reverse: true});
	//$("#rg").mask("00.000.000-0");
	//$("#cnpj").mask("00.000.000/0000-00");
	//$("#tel").mask("(00)0000-0000");
	//$("#NF_valor").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	
	//$("#val_contrato").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	
	//$("#NF_valor").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	
	
	$(".ui-datepicker-calendar").addClass("dtpkr");
    //$('input[id="date"], input[id="date2"]').attr('readonly','true');      
    $("#date, #date2, #date3, #cadastro[data_inicio], #cadastro[data_fim]").datepicker({
           minDate: new Date(),
           changeMonth: true,
           changeYear: true,
           showWeek: true,
           showOtherMonths: true,
                /*appendText: "dd/mm/yyyy",
                buttonImage: "cal.png",
                buttonImageOnly: true,
                buttonText: "Open the datepicker",
                showOn: "both",*/
           dateFormat: "dd/mm/yy",
		   minDate: new Date(1971, 1 - 1, 1),
   		   yearRange: "1970 : 2022",
		   startDate: "01/01/2000"
		   
		   /*,
           beforeShowDay: function (date) {
           var dateSplit = date.toString().split(" ");

			   if (dateSplit[0] === "Mon" && dateSplit[2] < 7) {
					return [false, "disabled", "We don't ever work on the first Monday of the month"];
			   } else {
					return [true];
			   }
		   }*/
    });
	$('#cadastro_status').val('4').alert("bolota");
     $("#datePag").datepicker({
           changeMonth: true,
           changeYear: true,
           showWeek: true,
           showOtherMonths: true,
           dateFormat: "dd/mm/yy",
   		   minDate: 3,
		   yearRange: "1970 : 2022",
		   startDate: "01/01/2000"
    });       
    $("#frmCad, #frmEditPrj, #frmEditGas, #frmEditCli").validate({
		// Define as regras
		rules:{
			nome:{
				required: true, minlength: 2,notNumber: true
			},
			"cadastro[COD_ATCAO]":{
				required: true, minlength: 3, notNumber: true
			},
			"cadastro[TTL_PRJ]":{
				required: true, minlength: 3, notNumber: true
			},
			cpf:{
				required: true, minlength: 2, cpf:'valid'
			},
			"cadastro[DESC_EMAIL_1]":{
				required: true, 
				email: true,
                minlength: 9
			},
			"cadastro[NUM_NF]":{
				required: true, 
				number: true,
                minlength: 9
			},
			"cadastro[NUM_TEL]":{
				required: true, 
                minlength: 13
			},
			
			telefone:{
				required: true, minlength: 10
			},
			ddd:{
				required: true
			},	
			celular:{
				required: true
			},
			estado:{
				required: true
			},
			cidade:{
				required: true, minlength: 2,notNumber: true
			},
			mensagem:{
				required: true
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			nome:{
				required: "Digite o seu nome",
				minlength: "O seu nome deve conter, no mínimo, 2 caracteres",
				notNumber: "Somente letras"	
			},
			"cadastro[TTL_PRJ]":{
				required: "Digite o titulo do projeto",
				minlength: "minimo de 3 caracteres",
				notNumber: "Somente letras"	
			},
			"cadastro[COD_ATCAO]":{
				required: "Digite a area de atua&ccedil;&atilde;o",
				minlength: "minimo de 3 caracteres",
				notNumber: "Somente letras"	
			},
			"cadastro[NUM_NF]":{
				required: "Digite o no. da NF",
				minlength: "minimo de 9 caracteres",
				number: "Somente algarismos"		
			},
			"cadastro[NUM_TEL]":{
				required: "Digite o no. do Tel.",
				minlength: "minimo de 13 caracteres"
			},
			cpf:{
				required: "Digite o CPF"
			},
			"cadastro[DESC_EMAIL_1]":{
				required: "Digite o seu e-mail",
				email: "Digite um e-mail valido"
			},
			telefone:{
				required: "Digite o telefone",
				minlength: "Insira o DDD + Telefone"
			},
			ddd:{
				required: "Digite o DDD"
			},
			celular:{
				required: "Digite o telefone",
				minlength: "Insira o Celular"
			},
			estado:{
				required: "Selecione o estado"
			},
			cidade:{
				required: "Digite a cidade"
			},
			mensagem:{
				required: "Digite a mensagem"
			}
			
		}
		});
		//fim validate

jQuery.validator.addMethod("notNumber", function(value, element, param) {
    var reg = /[0-9]/;
    if(reg.test(value)){
          return false;
    }else{
            return true;
    }
}, "Somente letras");

	
	
	//menu hover
	//--------------------------------------------------------------------
	$('#menu div div ul li').hover(
		function(){
			$(this).children('ul').show();
		},
		function(){
			$(this).children('ul').hide();
		}
	);
	
	//menu hover
	//--------------------------------------------------------------------
	$('#menu div div ul li ul li').hover(
		function(){
			$(this).parent('ul').parent('li').addClass('menu_selected');
		},
		function(){
			$(this).parent('ul').parent('li').removeClass('menu_selected');
		}
	);

	//submit
	//--------------------------------------------------------------------
	$(".submit").click(function(){
	    $(this).parents('form:first').submit();
	});
	
	//any question to confirm?
	//--------------------------------------------------------------------
	$('.confirm').click(
		function(){
			if(confirm($(this).attr('ask')) == false){
				return false;
			}
		}	
	);
	
	//redirect
	//--------------------------------------------------------------------
	$('.redirect').click(function(){
		location.href = $(this).attr('redirect');
	});

	//menu selected
	//--------------------------------------------------------------------
	$('a[href="' + $('input[name="selected"]').val() + '"]').addClass('menu_selected');
	$('a[href="' + $('input[name="selected"]').val() + '"]').parent('li').parent('ul').prev('a').addClass('menu_selected');
	
	//class="link_false"
	//--------------------------------------------------------------------
	$('.link_false').click(function(){return false;});
	
	//class="exit"
	//--------------------------------------------------------------------
	$('.exit').click(function(){if(confirm('Deseja realmente sair?')== false){return false;}});
	
	//class="del"
	//--------------------------------------------------------------------
	$('.del').click(function(){if(confirm('Deseja realmente excluir?')== false){return false;}});
	
	//validacao
	//--------------------------------------------------------------------
	$('#validar').click(function(){
		
		var total_campos = $('.validar').length;
		
		var valida = false;
		
		var f_valida = true;
		
		$('.validar').removeClass('erro_validade');
		
		for(var i = 0; i < total_campos  ; i++){
			
			if($('.validar:eq(' + i + ')').val() == 0 || 
			$('.validar:eq(' + i + ')').val() == ''){
				
				if(f_valida){
					
					$('.validar:eq(' + i + ')').focus();
					
					if($('.validar:eq(' + i + ')').attr('validar')){
						//alert($('.validar:eq(' + i + ')').attr('validar'));
						alerta('Erro', $('.validar:eq(' + i + ')').attr('validar'));
					}else{
						//alert('Preencha o campo corretamente.');
						alerta('Erro', 'Preencha o campo corretamente.');
					}
					
					f_valida = false;
				}
				
				$('.validar:eq(' + i + ')').addClass('erro_validade');
				
				valida = true;
			}
			
		}
		
		if(valida){
			return false;
		}
	});
	
	$("select[name='cadastro[COD_ESTD]']").change(function(){
		$("select[name='cadastro[COD_CID]']").html('<option value="0">Carregando...</option>');
        
        $.post("/site/lajeadoSys/listar/listarCidades", 
              {estado:$(this).val()},
              function(valor){
            	  //alert(valor);
                 $("select[name='cadastro[COD_CID]']").html(valor);
              });
 
     });
     $("select[name='cadastro[COD_ESTADO]']").change(function(){
		$("select[name='cadastro[COD_CIDADE]']").html('<option value="0">Carregando...</option>');
        
        $.post("/site/lajeadoSys/listar/listarCidades", 
              {estado:$(this).val()},
              function(valor){
            	  //alert(valor);
                 $("select[name='cadastro[COD_CIDADE]']").html(valor);
              });
 
     });
	  $("#deslig").change(function(){
		
		if($(this).val() == 2){
			
			$("input[name='cadastro[DAT_DEMIS]'").prop('disabled',true);
			//$("input[name='cadastro[DAT_DEMIS]'").val("");	
		}else{
			$("input[name='cadastro[DAT_DEMIS]'").removeAttr('disabled');
			
		}
	});
     $("select[name='cadastro[COD_CLNT]']").change(function(){
     	
		
		$("select[name='cadastro[COD_PRJ]']").html('<option value="0">Carregando...</option>');
        
        $.post("/site/lajeadoSys/listar/listarProjetos", 
              {projeto:$(this).val()},
              function(valor){
            	  //document.write(valor);
                 $("select[name='cadastro[COD_PRJ]']").html(valor);
              });

        
       
        
     });
	//pda datapiker
	//--------------------------------------------------------------------
	$.datepicker.regional["pt-BR"];
	$('input[pda="date"]').datepicker();
	$('input[pda="date_min_today"]').datepicker({minDate: 0});
	
});

//alerta
//--------------------------------------------------------------------
function alerta(title, content){
	$('body').prepend('<div id="dialog-modal" title="' + title + '"><center><p>' + content + '</center></p></div>');
	$( "#dialog-modal" ).dialog({
		modal: true,
		resizable: false, 
		draggable: false,
		minHeight: '150px'
	});
}
