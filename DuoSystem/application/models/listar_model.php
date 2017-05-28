<?php
	class listar_model extends CI_Model{
		#set por página
		#--------------------------------------------------------------------
		public $por_pagina = 0;

		#set limit
		#--------------------------------------------------------------------
		private function set_limit(){
			if(isset($_GET['pag'])
			&& $_GET['pag']){
				return $this->db->limit($this->por_pagina, $_GET['pag']);
			}else{
				return $this->db->limit($this->por_pagina);
			}
			
		}
		
		#set like
		#--------------------------------------------------------------------
		private function set_like($coll = array()){
			if(isset($_GET['busca'])
			&& $_GET['busca']
			&& is_array($coll)){	
				foreach($coll as $line => $value){
					if($line){
						$this->db->or_like($value, $_GET['busca']);
					}else{
						$this->db->like($value, $_GET['busca']);
					}
				}
			}
		}
	
		
		public function get_Atividades(){
			$this->db->distinct();
			$this->db->select('t.id_atv', false);
			$this->db->select('t.nome', false);
			$this->db->select('t.descricao', false);
			
			$this->db->select('DATE_FORMAT(t.data_inicio,"%d/%m/%Y %H:%i:%s") as data_inicio', false);
			$this->db->select('DATE_FORMAT(t.data_fim,"%d/%m/%Y %H:%i:%s") as data_fim', false);
			$this->db->select('t.status', false);
			$this->db->select('t.situacao', false);
			$this->db->select('s.desc_status', false);
			$this->db->from('atividades t');
			$this->db->join('atividade_status s', 't.status = s.id_status');	
					
			$this->db->order_by('t.data_inicio', 'desc');
				
			$this->set_limit();
			return $this->db->get()->result();
		}
		public function get_filter_Atividades($filtro){
			if($filtro == 1):
				$order = "t.status";
			else:
				$order = "t.situacao";
			endif;
			$this->db->distinct();
			$this->db->select('t.id_atv', false);
			$this->db->select('t.nome', false);
			$this->db->select('t.descricao', false);
			
			$this->db->select('DATE_FORMAT(t.data_inicio,"%d/%m/%Y %H:%i:%s") as data_inicio', false);
			$this->db->select('DATE_FORMAT(t.data_fim,"%d/%m/%Y %H:%i:%s") as data_fim', false);
			$this->db->select('t.status', false);
			$this->db->select('t.situacao', false);
			$this->db->select('s.desc_status', false);
			$this->db->from('atividades t');
			$this->db->join('atividade_status s', 't.status = s.id_status');	
					
			$this->db->order_by($order, 'asc');
				
			$this->set_limit();
			return $this->db->get()->result();
		}
		
		
		public function count_Atividades(){
			$this->db->distinct();
			$this->db->select('t.id_atv', false);
			$this->db->from('atividades t');
			
			
			return $this->db->count_all_results();
		}
		
	}