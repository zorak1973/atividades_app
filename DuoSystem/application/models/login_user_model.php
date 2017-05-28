<?php
	class login_user_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			session_start();
		}
		
		public function logged()
		{
			
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				if($this->check_user($_SESSION['username'], $_SESSION['password'], false) == false)
				{
					$this->logout();
				}
			}else{
				$this->logout();
			}
		}
		
		public function login($username, $password)
		{
			$data = $this->check_user($username, $password);
			//var_dump($data);exit();
			if($data):
				if($data->id_nivel==1 || $data->id_nivel == 2):
					//set session
					//$_SESSION['id'] 			= $data->id;
					$_SESSION['username'] 		= $data->usuario;
					//$_SESSION['funcionario'] 	= $data->NOM_FUNC;
					$_SESSION['password'] 		= $data->senha;
					//$_SESSION['id_func'] 		= $data->cd_func;
					//$_SESSION['id_permissao'] 	= $data->id_nivel;
					$_SESSION['nivel'] 			= $data->id_nivel;
					//$_SESSION['criar'] 			= $data->criacao;
					//$_SESSION['visualizar'] 	= $data->visualizacao;
					//$_SESSION['editar'] 		= $data->edicao;
					//$_SESSION['excluir'] 		= $data->exclusao;
					return true;
				else:
					return false;
				endif;
			else:
			
				return false;
				
			endif;				
		}
		
		public function check_user($username, $password, $md5 = true)
		{
			if($username && $password):
			
				return $this->db
				->select('login.login as usuario,
						login.senha as senha, 
						login.nivel as id_nivel,
						
						
						login.email as email')
				->from('login')
				
				->where(array(
					'login' => $username,
					//'senha'   => $password	
					'senha' => ($md5) ? md5($password) : $password
				))
				->get()
				->row();	
				
			endif;		
		}
		
		public function logout()
		{
			
			//unset($_SESSION['id']);
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			//unset($_SESSION['id_func']);
			//unset($_SESSION['funcionario']);
			//unset($_SESSION['id_permissao']);
			unset($_SESSION['nivel']);
			//unset($_SESSION['criacao']);
			//unset($_SESSION['visualizacao']);
			//unset($_SESSION['edicao']);
			//unset($_SESSION['exclusao']);
			//unset($_SESSION['filt']);
			session_destroy();
			redirect('login');
			
		}
	}
	
	