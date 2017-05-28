    <div class="grid_24" id="listar">
	<div id="form">
		<?php echo form_hidden('back', base_url() . 'listar/login'); ?>
		
		<?php 
		$this->load->view('cadastrar/topo'); 
		$nivel = array(1=>1,2=>2);
		
		?>
		
		<?php echo form_open('',array('id'=>'frmCad')); ?>
		
		<div class="esp prefix_1">
			
			<div class="grid_3"><label for="username"><?php echo utf8_encode('Nome usuário'); ?>:</label></div>
			<div class="grid_6"><?php echo form_input('cadastro[usuario]', $query->usuario, 'id="usuario" maxlength="10" class="validar" validar="digite username"')?></div>
			
			
						
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			
			<div class="grid_3"><label for="nivel"><?php echo utf8_encode('Nível de Usuário'); ?>:</label></div>
			<div class="grid_6"><?php echo form_dropdown('cadastro[nivel]', $nivel, $query->nivel, 'id="nivel" class="validar" validar="selecione o nivel de usuario"')?></div>
			
			<div class="grid_3"><label for="email"><?php echo utf8_encode('Email'); ?>:</label></div>
			<div class="grid_7"><?php echo form_input('cadastro[email]', $query->email, 'id="email"  class="validar"')?></div>
			<div class="clear"></div>
		</div>
		
		
		<?php $this->load->view('cadastrar/rodape'); ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
