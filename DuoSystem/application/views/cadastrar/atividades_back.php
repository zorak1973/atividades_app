<div class="container">
	<div class="centralizador" >
	<?php 
		$attributes = array('id' =>'FrmEditEst', 'class' =>'form-horizontal', 'method'=>'post', 'role'=>'form'); 
		
	?>
	<?php echo form_open('',$attributes);?>
		<h2>Cadastro de Atividade</h2>
	<hr />
	<div class="form-group">

		<label for="nome" class="col-sm-2 control-label">Nome</label>
		<div class="col-sm-8">
			
				<?php echo form_input('cadastro[nome]', '', 'id="nome" maxlength="255" class="validar form-control" validar="digite o nome da atividade"')?>
			
		</div>
		
	</div>
	
	<div class="form-group">	
		<label for="descricao" class="col-sm-2 control-label"><?php echo utf8_encode('Descricão'); ?></label>
		<div class="col-sm-8">
			
				<?php echo form_input('cadastro[descricao]', '', 'id="descricao"  class="form-control" validar="digite a descricao" ')?>
			
		</div>
	</div>
	

	<div class="form-group">
		<label for="dataIni" class="col-sm-2 control-label">Data Inicial</label>
		<div class="col-sm-2">
			
			<?php echo form_input('cadastro[data_inicio]', '', 'id="date" class="form-control" maxlength="10" readonly="readonly"');?>
		</div>
		<label for="data_fim" class="col-sm-2 control-label">Data Final</label>
		<div class="col-sm-2">
			<?php echo form_input('cadastro[data_fim]', '', 'id="date2" class="form-control" maxlength="10" readonly="readonly"');?>
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">Status</label>
			<div class="col-sm-2">
				<?php echo form_dropdown('cadastro[status]', $status, '', 'id="status" class="form-control"')?>
			</div>
		<label for="situacao" class="col-sm-2 control-label"><?php echo utf8_encode('Situação'); ?></label>
			<div class="col-sm-2">	
				<?php echo form_dropdown('cadastro[situacao]', $situacao, '','id="situacao" class="form-control"')?>
			</div>
	</div>		
				
	<div class="form-group">
		<label for="sub" class="col-sm-2 control-label"></label>	
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary" id="sub">Enviar</button>
		</div>

	</div>
	
			
	<?php echo form_close(); ?>
	</div>
</div>	
<div class="grid_24" id="listar">
	<div id="form">
		<?php echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2)); ?>
		
		<?php $this->load->view('cadastrar/topo');  ?>
		<?php 
		$attributes = array('id' =>'FrmEditEst'); 
		
		?>
		<?php echo form_open('',$attributes);?>
		<fieldset>
		<legend>Dados da Atividade</legend>
		<div class="esp prefix_1">
			<div class="grid_3"><label for="nome"><?php echo utf8_encode('Nome') ?></label></div>
			<div class="grid_19"><?php echo form_input('cadastro[nome]', '', 'id="nome" maxlength="255" class="validar" validar="digite o nome da atividade"')?></div>
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_3"><label for="flu"><?php echo utf8_encode('Descricão'); ?>:</label></div>
			<div class="grid_19"><?php echo form_input('cadastro[descricao]', '', 'id="descricao"  class="validar" validar="digite a descricao" ')?></div>
			
			<div class="clear"></div>
			
		</div>
		
		<div class="esp prefix_1">
			<div class="grid_3"><label for="data_inicio"><?php echo utf8_encode('Data de Início'); ?>:</label></div>
			<div class="grid_5"><?php echo form_input('cadastro[data_inicio]', '', 'id="date" maxlength="10" ');?></div>
			
			
			<div class="grid_3"><label for="data_fim"><?php echo utf8_encode('Data Final'); ?>:</label></div>
			<div class="grid_5"><?php echo form_input('cadastro[data_fim]', '', 'id="date2" maxlength="10" '); ?></div>
			
			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>
		
		<div class="esp prefix_1">
			<?php  ?>
			<div class="grid_3"><label for="status"><?php echo utf8_encode('Status'); ?>:</label></div>
			
			<div class="grid_5"><?php echo form_dropdown('cadastro[status]', $status, '','id="status"')?></div>
			
			<div class="grid_3"><label for="situacao"><?php echo utf8_encode('Situação'); ?>:</label></div>
			<div class="grid_5"><?php echo form_dropdown('cadastro[situacao]', $situacao, '','id="situacao" maxlength="20"')?></div>
			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>
		</fieldset>
		
		
		
		<?php $this->load->view('cadastrar/rodape'); ?>
		
		<?php echo form_close(); ?>
	</div>
</div>
