<div class="grid_24" id="listar">
	<div id="form">
		<?php echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2)); ?>
		
		<?php $this->load->view('cadastrar/topo'); ?>
		
		<?php echo form_open(''); ?>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="nombre">Nome:</label></div>
			<div class="grid_17"><?php echo $query->NOM_FUNC; ?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="username"><?php echo utf8_encode('Usuário'); ?>:</label></div>
			<div class="grid_17"><?php echo form_input('cadastro[usuario]', $query->usuario, 'id="username"  maxlength="145" class="validar" validar="digite seu nome de usu&aacute;rio"')?></div>
			<div class="clear"></div>
		</div>
		
		
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="id_permissao"><?php echo utf8_encode('Permissão')?>:</label></div>
			<div class="grid_17"><?php echo form_dropdown('cadastro[nivel]', $permissao, $query->nivel, 'id="id_permissao" class="select_one validar" validar="selecione sua permissao"')?></div>
			<div class="clear"></div>
		</div>
		
		<!--<div class="esp prefix_1">
			<div class="grid_5"><label for="id_form">Forma:</label></div>
			<div class="grid_17"><?php //echo form_dropdown('usuario_formulario[id_form][]', $formulario, $query_formulario, 'multiple id="id_form"  class="select_multiple"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for=id_loja>Tiendas:</label></div>
			<div class="grid_17"><?php //echo form_dropdown('usuario_loja[id_loja][]', $lojas, $query_lojas, 'multiple id="id_loja"  class="select_multiple"')?></div>
			<div class="clear"></div>
		</div>-->
	
		
		<?php $this->load->view('cadastrar/rodape'); ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
