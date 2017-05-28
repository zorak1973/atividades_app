<?php echo doctype(); ?>
<html>

	<head>
	
		<?php $this->load->view('head'); ?>
		
	</head>
	
	<body>
		<div id="wrap">
			<?php $this->load->view('header'); ?>
			<div class="wt esp2" id="content">
				<div id="main" class="container_24">
				
					<?php if($view) $this->load->view($view, $vars); ?>
					
				</div>
				<div class="clear"></div>
			</div>
			<?php $this->load->view('footer'); ?>
		</div>
	</body>
	
</html>

