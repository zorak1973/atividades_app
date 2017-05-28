<?php
	class cadastrar_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			
		}

		
		
		public function get_status($bool = false){
			$data = array();
			if($bool == false) $data = array('Selecione');
			$this->db->distinct();
			
			$this->db->select('s.*',false);
			$this->db->from('atividade_status s');
			$result = $this->db->get()->result();
			
			if($result){
				foreach($result as $row){
					$data[$row->id_status] = $row->desc_status;
				}
			}
			return $data;
		}
		
		public function cadastrar_atividade(){
			
			$table = 'atividades';
			
			$data  = $_POST['cadastro'];
						
			$data['data_inicio']  = substr($data['data_inicio'],6,4)."-".substr($data['data_inicio'],3,2)."-".substr($data['data_inicio'],0,2);
			//$data['DAT_NASC'] = substr($data['DAT_NASC'],6,4)."-".substr($data['DAT_NASC'],3,2)."-".substr($data['DAT_NASC'],0,2);
			if(isset($data['data_fim']) && ($data['data_fim'] == '')){
				unset($data['data_fim']);
			}else{
				$data['data_fim']  = substr($data['data_fim'],6,4)."-".substr($data['data_fim'],3,2)."-".substr($data['data_fim'],0,2);
			}
			
			$this->db->insert($table, $data);
		}
		
		
	
		
		#seleciona proximo_id
		#--------------------------------------------------------------------
		public function proximo_id($table){
			$query = $this->db
			->query('SHOW TABLE STATUS LIKE \'' . $table . '\'')
			->row();
			
			return $query->Auto_increment;
		}
		
		#grava fk's
		#--------------------------------------------------------------------
		public function grava_fk($table, $fk = array(), $id = array()){
			if(count($fk)){
				foreach($fk[key($fk)] as $row){
					$this->db->insert(
						$table, 
						array(
							key($fk) => $row, 
							key($id) => $id[key($id)]
						)
					); 
				}
			}
		}
	
	
	
	
		
		public function find($tabela, $valor)
		{
			$query = $this->db->get_where($tabela, $valor);
			return $query->num_rows();
		
		}
		
	}