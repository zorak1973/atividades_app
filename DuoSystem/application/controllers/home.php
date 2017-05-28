<?php
	#template
	#--------------------------------------------------------------------
	require_once 'template.php';
	
	class home extends template{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){
			$this->title = 'Bem-vindo ' . $_SESSION['username'];
			$this->view = 'home/index';
			
			$this->template();
			
		}
	}