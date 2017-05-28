<?php
	#import
	#--------------------------------------------------------------------
	require_once 'editar_model.php';	

	#excluir model
	#--------------------------------------------------------------------
	class excluir_model extends editar_model{
		
		#update fk
		#--------------------------------------------------------------------
		private function upd_fk($table, $id = array()){
			return $this->db->update($table, 
				array(
					key($id) => NULL
				),
				array(
					key($id) => $id[key($id)]
				)
			);
		}
	
	}