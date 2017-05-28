<script type="text/javascript">
<!--
	$(document).ready(function(){
		//$('input:text').setMask();
	});
//-->
</script>
<div class="grid_24" id="listar">
	<div id="form">
		<?php echo "<div class='errors'>".validation_errors()."</div>"; ?>
		<?php echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2)); ?>
		
		<?php $this->load->view('cadastrar/topo'); ?>
		
		<?php echo form_open('',array('id'=>'frmCad')); ?>
		<fieldset>
		<legend>Dados Gerais</legend>
		<div class="esp prefix_1">
			
			<div class="grid_6"><?php echo utf8_encode('Funcionário'); ?>:<br /><?php echo form_dropdown('cadastro[COD_FUNC]', $funcionario, 'id="funcionario" maxlength="10" class="validar" validar="selecione funcionario" ')?></div>
			
			<div class="grid_5"><?php echo utf8_encode('Estado'); ?>:<br /><?php echo form_dropdown('cadastro[COD_ESTD]', $estado, 'id="estado" maxlength="10"')?></div>
			<div class="grid_6"><?php echo utf8_encode('Cidade'); ?>:<br /><?php echo form_dropdown('cadastro[COD_CID]', $cidade, 'id="cidade" maxlength="10"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_9"><?php echo utf8_encode('Cliente') ?><br /><?php echo form_dropdown('cadastro[COD_CLNT]', $cliente, 'id="cliente" maxlength="255" class="validar" validar="selecione cliente"')?></div>
			<div class="grid_11"><?php echo utf8_encode('Título Projeto'); ?>:<br /><?php echo form_input('cadastro[TTL_PRJ]', '', 'id="titulo" ')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_10"><?php echo utf8_encode('Nome Resumido do Projeto'); ?>:<br /><?php echo form_input('cadastro[NOM_PRJ_RSMD]', '', 'id="nome_proj" class="validar" validar="digite o nome resumido do projeto" tag="prc"')?></div>
			<div class="grid_3"><?php echo utf8_encode('Data início'); ?>:<br /><?php echo form_input('cadastro[DAT_INI_PRJ]', '', 'id="date" maxlength="10" ')?></div>
			<div class="grid_3"><?php echo utf8_encode('Data Fim'); ?>:<br /><?php echo form_input('cadastro[DAT_CNCL_PRJ]', '', 'id="date2" maxlength="10" ')?></div>
			
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			
			<div class="grid_9"><?php echo utf8_encode('Área atuação'); ?>:<br /><?php echo form_input('cadastro[COD_ATCAO]', '', 'id="area" maxlength="90" ')?></div>
			<div class="grid_6"><?php echo utf8_encode('Número Contrato'); ?>:<br /><?php echo form_input('cadastro[NUM_CONTRATO]', '', 'id="num_contrato" maxlength="60" ')?></div>
			<div class="clear"></div>
		</div>
		
		</fieldset>
		
		<fieldset>
		<legend>Coordenadas</legend>
		<div class="esp prefix_1">
			<div class="grid_3"><label for="latitudeN"><?php echo utf8_encode('Latitude N');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LATT_NRT]', '', 'id="latitudeN"')?></div>
			<div class="grid_3"><label for="latitudeS"><?php echo utf8_encode('Latitude S');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LATT_SUL]', '', 'id="latitudeS"')?></div>
			<div class="grid_4"><label for="latitudeM"><?php echo utf8_encode('Latitude no Mapa');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LATT_MAP]', '', 'id="latitudeM"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_3"><label for="longitudeN"><?php echo utf8_encode('Longitude O');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LONG_W]', '', 'id="longitudeO"')?></div>
			<div class="grid_3"><label for="longitudeS"><?php echo utf8_encode('Longitude L');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LONG_E]', '', 'id="longitudeL"')?></div>
			<div class="grid_4"><label for="longitudeM"><?php echo utf8_encode('Longitude no Mapa');?>:</label></div>
			<div class="grid_4"><?php echo form_input('cadastro[COD_LONG_MAP]', '', 'id="longitudeM"')?></div>
			<div class="clear"></div>
		</div>
		</fieldset>
		
		
		<div class="esp prefix_1">
			<div class="grid_3"><label for="obs"><?php echo utf8_encode('Resumo'); ?>:</label></div>						
			<div class="grid_9"><?php echo form_textarea('cadastro[DESC_RSMO]', '', 'id="obs"')?></div>
			<div class="clear"></div>
		
		</div>
		
		<?php $this->load->view('cadastrar/rodape'); ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
