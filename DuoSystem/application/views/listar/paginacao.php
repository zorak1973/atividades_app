<?php 
	#set vars
	#--------------------------------------------------------------------
	$anterior = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '?';
	$proximo = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '?';
	//$por_pagina = 10;
	$inicial = 0;
	$final = 0;
	$complemento = 0;
	#caso ache buscas
	#--------------------------------------------------------------------
	if(isset($_GET['busca'])
	&& $_GET['busca']){
		$anterior .= '&busca=' . $_GET['busca'];
		$proximo .= '&busca=' . $_GET['busca'];
	}	

	#paginação
	#--------------------------------------------------------------------
	if(isset($_GET['pag'])
	&& is_numeric($_GET['pag'])){
		if(isset($_GET['compl']) && is_numeric($_GET['compl'])){
			$inicial = $_GET['pag'];
			$final = ($_GET['pag'] + $_GET['compl']);
		}else{
			$inicial = $_GET['pag'];
			$final = ($_GET['pag'] + $por_pagina);
		}
	}else{
		/*if(isset($_POST['por_pag']) && ($total < $_POST['por_pag'])){
			$final = $_POST['por_pag'];
		}else{*/
			$final = $por_pagina;
		//}
	}
	if(isset($_POST['por_pag'])){
		$complemento += $_POST['por_pag'];
	}
	#caso seja menor que total
	#--------------------------------------------------------------------
	if($total < $por_pagina) $final = $total;
	
	#set anterior
	#--------------------------------------------------------------------
	//$anterior .= '&pag=' . ($inicial - $por_pagina);
	if($complemento > 0 ){
		$anterior .= '&pag=' . ($inicial - $complemento). '&compl=' .$complemento;
	}else{
		if(isset($_GET['compl'])){
			$anterior .= '&pag=' . ($inicial - $_GET['compl']). '&compl=' .$_GET['compl'];
		}else{
			$anterior .= '&pag=' . ($inicial - $por_pagina);
		}
	}
	
	#proximo
	#--------------------------------------------------------------------
	//$proximo .= '&pag=' . $final;
	if($complemento > 0 ){
		$proximo .= '&pag=' . $final . '&compl=' .$complemento;
	}else{
		if(isset($_GET['compl'])){
			$proximo .= '&pag=' . $final . '&compl=' .$_GET['compl'];
		}else{
			$proximo .= '&pag=' . $final . '&compl=' .$por_pagina;
		}	
	}
	
	
?>

<div class="container">
<div class="row">
	<div class="col-sm-6"><p>Total de <?php echo $total; ?> registros , <?php echo utf8_encode('exibindo');?> de <?php echo ($total > 1) ? ($inicial + 1) : $inicial; ?> a <?php echo ($final >= $total) ? $total : $final; ?></p></div>
	
	<?php if($total > $por_pagina): ?>


	<div class="btn-group" role="group">

	<?php if($inicial || $final >= ($por_pagina * 2)): 
		$ativo = "";
	else:
		$ativo = "disabled='disabled'";
	endif; ?>
	<?php echo form_button('ant', 'Anterior', 'class="redirect btn btn-primary" '.$ativo.'" redirect="' . $anterior . '"'); ?>
		
	
	<?php if($final < $total): 
			$ativo = "";
		else:
			$ativo = "disabled='disabled'";
	endif; ?>
	<?php echo form_button('prox', utf8_encode('Próxima'), 'class="redirect btn btn-primary" '.$ativo.'" redirect="' . $proximo . '"'); ?>
	<?php ?>
	
	</div>


<?php endif;?>
	
	
</div>



</div>