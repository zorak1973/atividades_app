<div class="container">
	
	<?php 
		$attributes = array('id' =>'FrmEditEst', 'class' =>'form-horizontal', 'method'=>'post', 'role'=>'form'); 
		echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2));
		
	?>
	<?php echo form_open('',$attributes);?>
		<h2><span class="glyphicon glyphicon-edit"></span>Cadastro de Atividade</h2>
	<hr />
	<div class="form-group">

		<label for="nome" class="col-sm-2 control-label">Nome</label>
		<div class="col-sm-6">
			
				<?php echo form_input('cadastro[nome]', '', 'id="cadastro_nome" required maxlength="255" minlength="4" class="form-control input-class"')?>
			
		</div>
		
	</div>
	
	<div class="form-group">	
		<label for="descricao" class="col-sm-2 control-label"><?php echo utf8_encode('Descricão'); ?></label>
		<div class="col-sm-6">
			
				<?php echo form_input('cadastro[descricao]', '', 'id="cadastro[descricao]" required minlength="4" class="form-control input-class"')?>
			
		</div>
	</div>
	

	<div class="form-group">
		<label for="dataIni" class="col-sm-2 control-label">Data Inicial</label>
		<div class="col-sm-2">
			
			<?php echo form_input('cadastro[data_inicio]', '', 'id="date" required class="form-control input-class" maxlength="10"');?>
		</div>
		<label for="data_fim" class="col-sm-2 control-label">Data Final</label>
		<div class="col-sm-2">
			<?php echo form_input('cadastro[data_fim]', '', 'id="date2"  class="form-control input-class" maxlength="10"');?>
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">Status</label>
			<div class="col-sm-2">
				<?php echo form_dropdown('cadastro[status]', $status, '', 'id="cadastro[status]" required class="form-control input-class"')?>
			</div>
		<label for="situacao" class="col-sm-2 control-label"><?php echo utf8_encode('Situação'); ?></label>
			<div class="col-sm-2">	
				<?php echo form_dropdown('cadastro[situacao]', $situacao, '','id="cadastro_situacao" required class="form-control input-class"')?>
			</div>
	</div>		
	<hr />	
	<div class="col-md-offset-8">
	<div class="btn-group" role="group">
		
			<?php echo form_button('', 'Voltar', 'class="redirect btn btn-primary" redirect="' . base_url() . 'listar/' . $this->uri->segment(2) . '"');?>
			<button type="submit" class="btn btn-primary" id="sub">Enviar</button>
		
	</div>
	</div>
	
			
	<?php echo form_close(); ?>
	
</div>	

