<!DOCTYPE html>
<html lang="en">

	<head>
	
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php //echo link_tag('media/css/reset.css'); ?>
		<?php echo link_tag('media/css/text.css'); ?>
		<?php echo link_tag('media/css/bootstrap.css'); ?>
		<?php echo link_tag('media/css/bootstrap-theme.min.css'); ?>
		<?php echo link_tag('media/css/jumbotron.css'); ?>
		<?php //echo link_tag('media/css/960.css'); ?>
		<?php //echo link_tag('media/css/template.css'); ?>
		<?php echo link_tag('media/plugins/jquery-ui.custom/jquery-ui.min.css'); ?>
		<link href='http://fonts.googleapis.com/css?family=Dosis|Ubuntu|Roboto+Slab|Arimo|Maven+Pro|Arvo|Play|Muli|Nunito|Asap|Questrial|PT+Sans+Caption|Armata|Changa+One|Gudea|Ropa+Sans|Rambla|Kreon|Orbitron|Voltaire|Exo+2|Oxygen|Merriweather+Sans|Oswald&subset=latin' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo base_url()?>media/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>media/js/bootstrap.min.js"></script>
		
	<?php?>
		
	</head>
	
	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
        <div class="navbar-header">
		<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-hdd"></span>&nbsp;DuoSystem</a>
		</div>
	</div>
	</nav>
	
		
		<div class="container">
			<div class="centralizador">
			<?php 
				$attributes = array('id' =>'FrmLogin', 'class' =>'form-horizontal', 'method'=>'post', 'role'=>'form'); 
		
			?>
			<?php echo form_open('',$attributes);?>
				<h2 style='text-align:center;margin-bottom:30px'><span class="glyphicon glyphicon-edit"></span>Login</h2>
			<div class="form-group">
				
				<label for="nome" class="col-sm-4 control-label"><?php echo 'Usuário';?></label>
				<div class="col-sm-4">
			
				<?php echo form_input('usuario', '', 'class="form-control" id="usuario"'); ?>
			
				</div>
		
			</div>
			<div class="form-group">

				<label for="nome" class="col-sm-4 control-label">Senha</label>
				<div class="col-sm-4">
			
				<?php echo form_password('senha', '', 'maxlength="20" class="form-control" id="senha"');?>
				</div>
		
			</div>
			<div class="form-group">
				<label for="sub" class="col-sm-4 control-label"></label>	
				<div class="col-sm-2">
					<input type="submit" name="entrar" value="Entrar" class="btn btn-primary" />
					<?php //echo form_submit('entrar','Entrar'); ?>
					
				</div>

			</div>
			</div>
		</div>	
		
		
	</body>
	
</html>
