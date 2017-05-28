<?php echo doctype(); ?>
<html>

	<head>

		<?php 
			echo meta( 
				array(
					array(
						'name' => 'Content-type', 
						'content' => 'text/html; charset=utf-8', 
						'type' => 'equiv'
					),array(
						'name' => 'robots', 
						'content' => 'no-cache'
					)
				)
			);
		?>
		<?php header('Content-type: application/msexcel'); ?>
		<?php header('Content-Disposition: attachment; filename=' . underscore($title) . '.xls'); ?>
		
	</head>
	
	<body>
		
		<?php $this->load->view( $view , $vars ); ?>
		
	</body>
	
</html>

