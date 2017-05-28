<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
	<?php echo form_hidden('selected', current_url()); ?>
	<?php echo form_hidden('base_url', base_url()); ?>
    <div class="navbar-header">
		<!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>-->
          <a class="navbar-brand" href="#">DuoSystem</a>
           
		
		
	</div>
	<div class="container-fluid">
		<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-right navbar-nav">
              <li><?php echo anchor('home', 'Home');?></li>
              
              <li class="dropdown">
			  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Atividades<span class="caret"></span></a>
			  
			  	<ul class="dropdown-menu">
					<li><?php echo anchor('listar/atividades', utf8_encode('Listar Atividades'));?></li>
					<li><?php echo anchor('cadastrar/atividades', utf8_encode('Cadastrar Atividade'));?></li>
				</ul>	
			  
			  </li>
              
			  <li><?php echo anchor('login/logout', utf8_encode('Sair'));?></li>
            </ul>
        
        </div><!--/.navbar-collapse -->
	</div>
</div>	
</nav>

