<div class="container">
	<?php 
		echo form_hidden('back', base_url() . 'listar/' . $this->uri->segment(2)); 
		$atrib = "";
		if($query->status == 4){
			$atrib = " disabled = 'disabled' ";
		}
	
	?>
	<?php 
		$attributes = array('id' =>'FrmEditEst', 'class' =>'form-horizontal', 'method'=>'post', 'role'=>'form'); 
		
	?>
	<?php echo form_open('',$attributes);?>
		<h2><span class="glyphicon glyphicon-edit"></span>Editar Atividade</h2>
	<hr />
	<div class="form-group">

		<label for="nome" class="col-sm-2 control-label">Nome</label>
		<div class="col-sm-8">
			
				<?php echo form_input('cadastro[nome]', $query->nome, 'id="nome" '.$atrib.' maxlength="255" class="validar form-control" validar="digite o nome da atividade"')?>
			
		</div>
		
	</div>
	
	<div class="form-group">	
		<label for="descricao" class="col-sm-2 control-label"><?php echo utf8_encode('Descricão'); ?></label>
		<div class="col-sm-8">
			
				<?php echo form_input('cadastro[descricao]', $query->descricao, 'id="descricao" '.$atrib.' class="form-control" validar="digite a descricao" ')?>
			
		</div>
	</div>
	

	<div class="form-group">
		<label for="dataIni" class="col-sm-2 control-label">Data Inicial</label>
		<div class="col-sm-2">
			
			<?php echo form_input('cadastro[data_inicio]', $query->data_inicio, 'id="date" '.$atrib.' class="form-control" maxlength="10" readonly="readonly"');?>
		</div>
		<label for="data_fim" class="col-sm-2 control-label">Data Final</label>
		<div class="col-sm-2">
			<?php echo form_input('cadastro[data_fim]', $query->data_fim, 'id="date2" '.$atrib.' class="form-control" maxlength="10" readonly="readonly"');?>
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">Status</label>
			<div class="col-sm-2">
				<?php echo form_dropdown('cadastro[status]', $status, $query->status, 'id="status" '.$atrib.' class="form-control"')?>
			</div>
		<label for="situacao" class="col-sm-2 control-label"><?php echo utf8_encode('Situação'); ?></label>
			<div class="col-sm-2">	
				<?php echo form_dropdown('cadastro[situacao]', $situacao, $query->situacao,'id="situacao" '.$atrib.' class="form-control"')?>
			</div>
	</div>		
	<hr />
	<div class="col-md-offset-8">
	<div class="btn-group" role="group">
			<?php echo form_button('', 'Voltar', 'class="redirect btn btn-primary" redirect="' . base_url() . 'listar/' . $this->uri->segment(2) . '"');?>
			<button type="submit" class="btn btn-primary" <?php echo $atrib; ?> id="sub">Enviar</button>
		
	</div>
	</div>
	
			
	<?php echo form_close(); ?>
	
	
</div>	


		
		
		
		
