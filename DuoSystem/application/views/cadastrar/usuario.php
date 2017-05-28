<div class="grid_24" id="listar">
	<div id="form">
		<?php echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2)); ?>
		
		<?php $this->load->view('cadastrar/topo'); ?>
		
		<?php echo form_open(''); ?>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="nombre">Nombre:</label></div>
			<div class="grid_17"><?php echo form_input('cadastro[nombre]', '', 'id="nombre" maxlength="145" class="validar" validar="digite seu nome"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="username"><?php echo utf8_encode('Usuario'); ?>:</label></div>
			<div class="grid_17"><?php echo form_input('cadastro[username]', '', 'id="username"  maxlength="145" class="validar" validar="digite seu nome de usu&aacute;rio"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="password">Senha:</label></div>
			<div class="grid_17"><?php echo form_password('cadastro[password]', '', 'id="password" class="validar" maxlength="145" validar="digite sua senha"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="id_permissao"><?php echo utf8_encode('Permiso')?>:</label></div>
			<div class="grid_17"><?php echo form_dropdown('cadastro[id_permissao]', $permissao, '', 'id="id_permissao" class="select_one validar" validar="selecione sua permissao"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for="id_form"><?php echo utf8_encode('Forma')?>:</label></div>
			<div class="grid_17"><?php echo form_dropdown('usuario_formulario[id_form][]', $formulario, '', 'multiple id="id_form"  class="select_multiple"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_5"><label for=id_loja><?php echo utf8_encode('Tiendas')?>:</label></div>
			<div class="grid_17"><?php echo form_dropdown('usuario_loja[id_loja][]', $lojas, '', 'multiple id="id_loja"  class="select_multiple"')?></div>
			<div class="clear"></div>
		</div>
	
		
		<?php $this->load->view('cadastrar/rodape'); ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
