<?php
	#login
	#--------------------------------------------------------------------
	require_once 'template.php';

	class login extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('login_user_model');
		}
		
		public function index(){
			//on post
			if($_POST):

				//populate
				$data = array(
					'u' => $this->input->post('usuario'),
					'p' => $this->input->post('senha'),
				);
				
				//on post
				if($data['u'] && $data['p']):
				
					if($this->login_user_model->login($data['u'], $data['p'])):
						
						//true
						redirect('home');	
					
					endif;
					
				endif;
				
			endif;
			
			$this->load->view('login/index', array(
				'title' => 'LOGIN'
			));
		}
		
		public function logout(){
			$this->login_user_model->logout();
		}
	}
	