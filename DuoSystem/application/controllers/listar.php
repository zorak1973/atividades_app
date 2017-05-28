<?php
	#listar
	#--------------------------------------------------------------------
	require_once 'template.php';
	
	class listar extends template{
		public $por_pagina = '';
		
		public function __construct(){
			parent::__construct();
			
			#por página
			#--------------------------------------------------------------------
			$this->por_pagina = 10;
			
			#model
			#--------------------------------------------------------------------
			$this->load->model('listar_model');
			
			#set on model
			#--------------------------------------------------------------------
			$this->listar_model->por_pagina = $this->por_pagina;
			
			#visualizar
			#--------------------------------------------------------------------
			//if($_SESSION['visualizar'] == false) redirect('home');
		}
		
		
	
		
		public function atividades(){
			
			$this->view = 'listar/atividades';
			
			$this->title = 'Lista de Todas Atividades';
			
			if($_POST): 
				$this->vars = array(
					'query' => $this->listar_model->get_filter_Atividades($_POST['status-filtro']),
					'total' => $this->listar_model->count_Atividades(),
					'por_pagina' => $this->por_pagina
				);
			else:
				$this->vars = array(
					'query' => $this->listar_model->get_Atividades(),
					'total' => $this->listar_model->count_Atividades(),
					'por_pagina' => $this->por_pagina
				);
			endif;	
			$this->template();
		}
		
	
	}
	