<?php 
	#default template
	#--------------------------------------------------------------------
	class template extends CI_Controller{
		
		public $title = null;
		public $view = null;
		public $view_footer = null;
		public $vars = array();
		public $js = null;
		public $js_function = null;
		public $template = 'template';
		public $refresh = false;
		public $refresh_pages = array(
			'listar'
		);
		
		public function __construct(){
			parent::__construct();
			
			#login_model
			#--------------------------------------------------------------------
			$this->load->model('login_user_model');
			//echo 'bola';
			#verifica se está logado
			#--------------------------------------------------------------------
			$this->login_user_model->logged();
			
		}
		
		public function template(){
			$this->load->view($this->template, array(
				'title' => $this->title,
				'view' => $this->view,
				'vars' => $this->vars,
				'js' => $this->js,
				'js_function' => $this->js_function,
				'refresh' => $this->refresh,
				'refresh_pages' => $this->refresh_pages
			));
		}
	}