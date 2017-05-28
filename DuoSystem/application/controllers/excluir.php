<?php
	#import template
	#--------------------------------------------------------------------
	require_once 'template.php';
	
	#import js
	#--------------------------------------------------------------------
	require_once 'js.php';

	#controler excluir
	#--------------------------------------------------------------------
	class excluir extends template{
		public $ob_js = null;
		
		public function __construct(){
			parent::__construct();
			
			#model
			#--------------------------------------------------------------------
			$this->load->model('excluir_model');
			
			#permissão de excluir
			#--------------------------------------------------------------------
			//if($_SESSION['excluir'] == false) redirect('home');
			
			#js
			#--------------------------------------------------------------------
			$this->ob_js = new js();
			$this->ob_js->alert = 'Registro apagado com suceso!';
		 	$this->ob_js->redirect = base_url() . 'listar/' . $this->uri->segment(2);
		}
		

	}	