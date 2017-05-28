<?php
	#editar
	#--------------------------------------------------------------------
	require_once 'template.php';
	
	class editar extends template{
		public function __construct(){
			parent::__construct();
			
			#model
			#--------------------------------------------------------------------
			$this->load->model('editar_model');
			
			#permissão de editar
			#--------------------------------------------------------------------
			//if($_SESSION['criar'] == false) redirect('home');
		}
		public function formataDinheiro($num){
			$num = str_replace(".", "", $num); 
			$num = str_replace(",", ".", $num);
			return $num;	
		}
	
		#editar atividade
		#--------------------------------------------------------------------
		public function atividades(){
			$data = $this->editar_model->get_edit_atividade();
			
			$this->view = 'editar/atividade';
			$this->title = utf8_encode('Editar Atividade');
			$sit = array(0 => 'inativo', 1=>'ativo');
			$this->vars = array(
				'query' => $data['query'],
				'status' => $this->editar_model->get_status(),
				'situacao' => $sit
			);
			
			if($_POST): 
				$this->editar_model->grava_edit_atividade();
				$this->js = 'editar_true';
			endif;	
			
			$this->template();
		}
		
		
		function ConverteData($dia){
			$dia = substr($dia,8,2)."/".substr($dia,5,2)."/".substr($dia,0,4);
			return $dia;
		}
	}