<?php
	class js{
		public $alert = '';
		public $redirect = '';
		
		private function redirect($link = ''){
			if($link)
				return 'location.href="' . $link . '";';	
		}
		
		private function alert($string = ''){
			if($string)
				return 'alert("' . $string . '");';
		}
		
		public function src($link){
			if($link){
				return '<script type="text/javascript" src="' . $link . '"></script>';
			}	
		}
		
		public function get(){
			$data = null;
			$data .= 'window.onload = function(){';
			$data .= $this->alert($this->alert);
			$data .= $this->redirect($this->redirect);
			$data .= '}';
			
			return $data;
		}
	}