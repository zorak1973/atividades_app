<?php
	#cadastrar
	#--------------------------------------------------------------------
	require_once 'template.php';
	
	/**
	*@property $this->view
	*@property $this->title
	* @section DESCRIPTION
 	*
 	* A classe Cadastrar apresenta diversos metodos para cadastrar as entidades no banco de dados
	*/
	class cadastrar extends template{
		public function __construct(){
			parent::__construct();
			
			#model
			#--------------------------------------------------------------------
			$this->load->model('cadastrar_model');
			
						
			#permissão de cadastrar
			#--------------------------------------------------------------------
			if($_SESSION['nivel'] == '2') redirect('home');
			
		}
		public function formataDinheiro($num){
			$num = str_replace(".", "", $num); 
			$num = str_replace(",", ".", $num);
			return $num;	
		}
		
		
		

		
				
		public function atividades(){
			$this->view = 'cadastrar/atividades';
			$this->title = utf8_encode('Cadastro de Atividade');
			$sit = array(0 => "inativo", 1 => "ativo");
			$this->vars = array(
					'status' => $this->cadastrar_model->get_status(),
					'situacao' => $sit
					
			);
			if($_POST):
					$this->cadastrar_model->cadastrar_atividade();
					$this->js = 'cadastrar_true';
			endif;
				
			$this->template();
		
		}
		
		
		
	}