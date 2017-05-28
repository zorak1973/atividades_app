<?php
	#editar
	#--------------------------------------------------------------------
	require_once 'cadastrar_model.php';
	
	class editar_model extends cadastrar_model{
		public $id;
		
		public function __construct(){
			parent::__construct();
			
			$this->id = $this->uri->segment(3);
		}
		
		#get fk's
		#--------------------------------------------------------------------
		private function get_fk($table, $select, $id = array()){
			$data = array();
			
			$query = $this->db->select($select)->get_where($table, array(key($id) => $id[key($id)]))->result();
			
			if($query){
				foreach($query as $row){
					$data[] = $row->$select;
				}
			}
			
			return $data;
		}
		
		#delete fk's
		#--------------------------------------------------------------------
		public function del_fk($table, $id = array()){
			return $this->db->delete($table, array(key($id) => $id[key($id)]));
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
		
	
	
		
		public function get_edit_atividade(){
			$data = array();
			
			$this->db->select('l.*', false);
			$this->db->select('s.desc_status', false);
			$this->db->from('atividades l');
			
			$this->db->join('atividade_status s', 'l.status = s.id_status', 'left');
			//$this->db->join('permissoes p', 'l.nivel = p.id', 'left');
			
			$where = "l.id_atv = ".$this->id;
			$this->db->where($where);
			$data['query'] = $this->db->get()->row();
			$data['query']->data_inicio = substr($data['query']->data_inicio,8,2)."/".substr($data['query']->data_inicio,5,2)."/".substr($data['query']->data_inicio,0,4);
			if(isset($data['query']->data_fim)){
				$data['query']->data_fim = substr($data['query']->data_fim,8,2)."/".substr($data['query']->data_fim,5,2)."/".substr($data['query']->data_fim,0,4);
			}
			else{
				$data['query']->data_fim = null;
			}
			
			return $data;
		}

		public function grava_edit_atividade(){
			
			$table = 'atividades';
			$data = $_POST['cadastro'];
			$data['data_inicio'] = substr($data['data_inicio'],6,4)."/".substr($data['data_inicio'],3,2)."/".substr($data['data_inicio'],0,2);
			if(!isset($data['data_fim']) || $data['data_fim'] == ''){
				unset($data['data_fim']);
			}else{
				$data['data_fim'] = substr($data['data_fim'],6,4)."/".substr($data['data_fim'],3,2)."/".substr($data['data_fim'],0,2);
			}
			$this->db->update($table, $data, array('id_atv' => $this->id));
		}
		
		
	
}