<!DOCTYPE html>
<html lang="en">

	<head>
	
		<?php $this->load->view('head'); ?>
		
	</head>
	
	<body>
		
		

			<?php $this->load->view('header'); ?>
			
				<div class="container">
			
					<?php if($view) $this->load->view($view, $vars);  ?>
					
				
			
				</div>
			
			<?php $this->load->view('footer'); ?>
		
		
	</body>
	
</html>

