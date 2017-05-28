<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leituradados{
	
	public $destino;
	public $ponteiro;
	public $linhas;
	public $origem;
	public $file;
	public $caminho;
	public $fileName;
	public $flu;
	public $plu;
	public $inicio;
	public $fim;
	public $estacao;
	public $dataLimite;
	public $primeiroDia;
	public $arquivoONS;
	//public $nomeArquivoONSLocal;
	public $diaAuxiliar;
	public $colunasDaEstacao;
	public $colunaSelecionada;
	public $garrison;
	public $colChuva;
	public $lenChuva;
	public $colNivel;
	public $lenNivel;
	public $conVazao;
	public $lenVazao;
	public $pluviosidadeDiaria;
	public $minutoEnvio;
	
	public function __construct(){
		
		
	}
	
	
	
	public function obterArquivo($arquivo,$titulo){
		
		$this->estacao = $titulo;
		$this->origem = (string) $arquivo; 
		$dia = date("d-m-Y_His");
		$this->destino = $titulo.'_arquivo.txt'; 
		try{
			
			copy($this->origem, $this->destino); 
			if (!file_exists($this->destino)) {
			    			    
			 	throw new Exception('Arquivo inexistente');
			    
			} 
			
		}catch(Exception $e){
			
			echo $e->getMessage();
			
		}
	}
	
	
	public function contarLinhas(){
				
		$this->file = file($this->destino);
		$this->linhas = count($this->file);
						
	}
	
	
	public function obterPonteiro(){
		
		$this->ponteiro = fopen($this->destino, 'r');
				
	}
	
	public function setColunas($colunas)
	{
		$this->colChuva = $colunas[0];
		$this->lenChuva = $colunas[1];
		$this->colNivel    = $colunas[2];
		$this->lenNivel    = $colunas[3];
		$this->colVazao  = $colunas[4];
		$this->lenVazao  = $colunas[5];
		
		
	}
	
	public function identificaCampos($colunas)
	{
		$this->colChuva = $colunas[0];
		$this->colNivel    = $colunas[1];
		$this->colVazao  = $colunas[2];
		
	}
	
	public function setGarrison($garrison)
	{
		
		$this->garrison = $garrison;
		
	}
	
	
	public function lerArquivoExcelHtml(){
		
		$linhas = 0;
		$linhas2 = 0;
		$linhainicio = 0;
		$dataTotal = "";
		$colunas = "";
		$aux = 0;
		$tabela = "";
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		
		$diaAux = $this->primeiroDia;
		$tabela = "<style>td{border:1px solid #000;}table{cellspacing:0px;cellpadding:3px;}</style>";
		$tabela .= '<table >';
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			if($linhas < 3){
				if($linhas==2){
					switch($this->colunaSelecionada){
						case('n'):
							$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>N&iacute;vel(m)</b></td></tr>';
							break;
						case('n_p'):
							$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td><b>Nivel(m)</b></td></tr>';
							break;
						case('p'):
							$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva Acumulada Diária(mm)</b></td></tr>';
							break;
						case('v'):
							$tabela .= '<tr><td><b>Data/Hora</b></td><td><b>Vaz&atilde;o(m3)</b></td></tr>';
							break;
						
					}

				}
			}
			
			if($linhas >= 3){
				
				$valores2 = "";
				$valores = explode(" ", $linhaAtual);
				/*echo "<pre>";
				print_r($valores);
				echo "</pre>";
				exit;*/
				if(isset($valores[1])){
					$valores2 = explode("\t", $valores[1]);
				
				}
				
				if(isset($valores2[0])){
					$dia = $valores[0]." ".$valores2[0];
				}else{
					$dia = substr($linhaAtual, 0, 14);
				}
				
				/*if($linhas == 3){
					$semMedicao = $this->diasSemMedicao($dia);
					echo "sem medicao = ".$semMedicao;
					if(!($semMedicao == "vazio")){
						echo "sem Medicao = vazio";
						$tabela .= $semMedicao;
					}
				
				}*/
				$diaIncompleto = substr($linhaAtual, 0, 14);
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					
					
					
					$diaAux = explode("/", $dia);
				
					$dia2= $diaAux[1]."/".$diaAux[0]."/".$diaAux[2];
					
					$tabela .= "<tr><td>".$dia2."</td>";
					switch($this->colunaSelecionada){
						case('n'):
							$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
						break;
						case('n_p'):
							$tabela .= "<td>".$valores2[$this->colChuva]."</td><td>".$valores2[$this->colNivel]."</td>";					
						break;
						
							
						case('v'):
							$tabela .= "<td>".$valores2[$this->colVazao]."</td>";
						break;	
						
						
					}
					$tabela .= "</tr>";
						
				}
				
			}
			$linhas++;
		}//FECHA WHILE
		$tabela .="</table>";
		return $tabela;
	}
	
	
	public function lerArquivoTxt(){
		
		$linhas = 0;
		$linhas2 = 0;
		$linhainicio = 0;
		$dataTotal = "";
		$colunas = "";
		$aux = 0;
		$tabela = "";
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		
		$diaAux = $this->primeiroDia;
		
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			if($linhas < 3){
				if($linhas==2){
					switch($this->colunaSelecionada){
						case('n'):
							$tabela =  "Data/Hora    Nivel(m)\r\n";
							fwrite($arquivoExportacao, $tabela);
							break;
						case('n_p'):
							$tabela =  "Data/Hora    Chuva(mm)      Nivel(m)\r\n";
							fwrite($arquivoExportacao, $tabela);
							break;
						
						case('v'):
							$tabela ="Data/Hora    Vazão(m3)\r\n";
							fwrite($arquivoExportacao, $tabela);
							break;
						
					}

				}
			}
			
			if($linhas >= 3){
				$teste2 = "";
				$teste = explode(" ", $linhaAtual);
				if(isset($teste[1])){
					$teste2 = explode("\t", $teste[1]);
				
				}
				
				
				//
				if(isset($teste2[0])){
					$dia = $teste[0]." ".$teste2[0];
				}else{
					$dia = substr($linhaAtual, 0, 14);
				}
				
				
				$diaIncompleto = substr($linhaAtual, 0, 14);
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					$diaAux = explode("/", $dia);
				
					$dia2= $diaAux[1]."/".$diaAux[0]."/".$diaAux[2];
					
					
					switch($this->colunaSelecionada){
						case('n'):
							//$tabela = " ".$dia2."    ".substr($linhaAtual, $this->colNivel, $this->lenNivel)."\r\n ";
							$tabela = " ".$dia2."    ".$teste2[$this->colNivel]."\r\n";
							fwrite($arquivoExportacao, $tabela);
						break;
						case('n_p'):
							//$tabela = $dia2."  ".substr($linhaAtual, $this->colChuva, $this->lenChuva)."  ".substr($linhaAtual,$this->colNivel, $this->lenNivel)."\r\n ";				
							$tabela = $dia2."  ".$teste2[$this->colChuva]."  ".$teste2[$this->colNivel]."\r\n ";				
							fwrite($arquivoExportacao, $tabela);	
						break;

						case('v'):
							//$tabela = " ".$dia2."   ".substr($linhaAtual, $this->colVazao, $this->lenVazao)."\r\n";
							$tabela = " ".$dia2."   ".$teste2[$this->colVazao]."\r\n";
							fwrite($arquivoExportacao, $tabela);	
						break;	
						
						
					}
					
						
				}
				
			}
			$linhas++;
		}//FECHA WHILE
		
	}
	
	
	
	public function lerArquivoExcelHtmlChuvaAcumulada(){
		
		$linhas = 0;
		$linhas2 = 0;
		$linhainicio = 0;
		$dataTotal = "";
		$hora = '';
		$horacontrole='';
		$minutoSeguinte='';
		$colunas = "";
		$aux = 0;
		$tabela = "";
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		
		$diaAux = $this->primeiroDia;
		$tabela = "<style>td{border:1px solid #000;}table{cellspacing:0px;cellpadding:3px;}</style>";
		$tabela .= '<table >';
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			if($linhas < 3){
				if($linhas==2){
					$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva Acumulada Di&aacute;ria(mm)</b></td></tr>';
				}
			}
			
			if($linhas >= 3){
				$valores2 = "";
				$valores = explode(" ", $linhaAtual);
				if(isset($valores[1])){
					$valores2 = explode("\t", $valores[1]);
				
				}
				
				if(isset($valores2[0])){
					$dia = $valores[0]." ".$valores2[0];
				}else{
					$dia = substr($linhaAtual, 0, 14);
				}
				$hora = substr($linhaAtual, 9,5);
				$horacontrole = substr($this->fim, 9,2).":".$this->minutoEnvio;
				
				
				if($this->minutoEnvio == "00"){
					$minutoSeguinte = "15";
				}else{
					if($this->minutoEnvio == "05"){
						$minutoSeguinte = "20";
					}else{
						$minutoSeguinte = "25";
					}
				}
				$horacontroleLimiteFinal = substr($this->fim,9,2).":".$minutoSeguinte;

				$dia = substr($linhaAtual, 0, 14);
				$diaIncompleto = substr($linhaAtual, 0, 8);
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					
					//$chuva = substr($linhaAtual, $this->colChuva, $this->lenChuva);
					//$chuva = number_format($chuva, 1, '.', '');
					$chuva = $valores2[$this->colChuva];
					$aux = $aux + $chuva;
					
					$this->pluviosidadeDiaria = $aux;
					
					//echo "chegou a". $this->pluviosidadeDiaria."........".$chuva.".......".$aux."......".$dia.".....".$hora."......".$horacontrole."...".$dia.".....".$this->inicio."<br>";
					
					if($hora >= $horacontrole && $hora < ($horacontroleLimiteFinal) && strtotime($dia) >= strtotime($this->inicio)){
						
						
						$diaAux2 = explode("/", $dia);
				
						$dia2= $diaAux2[1]."/".$diaAux2[0]."/".$diaAux2[2];
						
						$tabela .= "<tr><td>".$dia2."</td>";
						$aux = 0;
						//$this->pluviosidadeDiaria = number_format($this->pluviosidadeDiaria, 3, '.','');
						$tabela .="<td>".$this->pluviosidadeDiaria ."</td></tr>";
					
					}

				}
				$diaAux = $dia;
				
			}
			$linhas++;
		}//FECHA WHILE
		$tabela .="</table>";
		return $tabela;
	}
	
	public function lerArquivoChuvaAcumulada(){
		
		$linhas = 0;
		$linhas2 = 0;
		$linhainicio = 0;
		$dataTotal = "";
		$hora = '';
		$horacontrole='';
		$colunas = "";
		$aux = 0;
		$tabela = "";
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		
		$diaAux = $this->primeiroDia;
		
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			if($linhas < 3){
				if($linhas==2){
					$cabecalho =  "Data/Hora           Chuva Acumulada Diária(mm)\r\n";
					fwrite($arquivoExportacao,$cabecalho);
				}
			}
			
			if($linhas >= 3){
				$valores2 = "";
				$valores = explode(" ", $linhaAtual);
				if(isset($valores[1])){
					$valores2 = explode("\t", $valores[1]);
				
				}
				
				if(isset($valores2[0])){
					$dia = $valores[0]." ".$valores2[0];
				}else{
					$dia = substr($linhaAtual, 0, 14);
				}
				$hora = substr($linhaAtual, 9,5);
				$horacontrole = substr($this->fim, 9,2).":".$this->minutoEnvio;
				
				
				if($this->minutoEnvio == "00"){
					$minutoSeguinte = "15";
				}else{
					if($this->minutoEnvio == "05"){
						$minutoSeguinte = "20";
					}else{
						$minutoSeguinte = "25";
					}
				}
				$horacontroleLimiteFinal = substr($this->fim,9,2).":".$minutoSeguinte;
				
				//$dia = substr($linhaAtual, 0, 14);
				$diaIncompleto = substr($linhaAtual, 0, 8);
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					
					//$chuva = substr($linhaAtual, $this->colChuva, $this->lenChuva);
					$chuva = $valores2[$this->colChuva];
					$aux = $aux + $chuva;
					
					$this->pluviosidadeDiaria = $aux;
										
					//if($hora == $horacontrole && strtotime($dia) >= strtotime($this->inicio)){
					if($hora == $horacontrole && $hora < ($horacontroleLimiteFinal) && strtotime($dia) >= strtotime($this->inicio)){	
						$diaAux2 = explode("/", $dia);
				
						$dia2= $diaAux2[1]."/".$diaAux2[0]."/".$diaAux2[2];
					
						fwrite($arquivoExportacao," ".$dia2." ");
						//echo $dia2;
						$aux = 0;
						$this->pluviosidadeDiaria = number_format($this->pluviosidadeDiaria, 3, '.','');
						$line = $this->pluviosidadeDiaria."\r\n";
						fwrite($arquivoExportacao,"    ".$line);
					
					}

				}
				$diaAux = $dia;
				
			}
			$linhas++;
		}//FECHA WHILE
		
	}
	
	public function lerArquivo(){
		
		$linhas = 0;
		$linhas2 = 0;
		$linhainicio = 0;
		$dataTotal = "";
		$colunas = "";
		$aux = 0;
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		
		$diaAux = $this->primeiroDia;
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			if($linhas < 3){
				if($linhas==2){
					switch($this->estacao){
						case 'lucena':
						case 'tocantinia':
							$colunas = "data/hora	----  chuva(mm)     nivel(m)\r\n";
							break;
						case 'jusante':
							$colunas = "data/hora	----   	nivel(m)   -----    vazao(m3)\r\n";	
							break;
						case 'jacinto':
							$colunas = "data/hora 	----   	chuva(mm) 	nivel(m)     ------	vazao(m3)\r\n";
							break;
						case 'barramento':
							$colunas = "data/hora	chuva(mm)     -------       nivel(m)\r\n";
							break;
						case 'ipueiras':
						case 'areias':
							$colunas = "data/hora 	chuva(mm)   -------  	nivel(m)    -----     -----\r\n";
							break;
						case 'geronimo':
							$colunas = "data/hora 	chuva(mm)   -------  	nivel(m)     -----	vazao(m3)\r\n";
							break;
						case 'jurupary':
							$colunas = "data/hora 	--------	chuva(mm)     nivel(m)	-----	vazao(m3)\r\n";
							break;
						case 'mangues':
							$colunas = "data/hora 	chuva(mm)  -------  	nivel(m)   -----\r\n";
							break;
					}
					
					fwrite($arquivoExportacao, $colunas);
				}else{
					fwrite($arquivoExportacao, $linhaAtual);
				}
			}
			
			if($linhas >= 3){
				$dia = substr($linhaAtual, 0, 14);
				$diaIncompleto = substr($linhaAtual, 0, 14);
				
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					if($this->estacao =='barramento'){
						$chuva = substr($linhaAtual, 18, 5);
						$outro = substr($linhaAtual, 24, 5);
						$nivel = substr($linhaAtual, 30, 7);
						//$nivel = floatval($nivel);
						$nivel = number_format($nivel, 2, ".","");
						$linhaBarramento = $dia." ".$chuva." "." ".$outro." ".$nivel."\r\n";
						fwrite($arquivoExportacao, $linhaBarramento);
					}else{
						fwrite($arquivoExportacao, $linhaAtual);
					}
					
					
						
				}
			}
			$linhas++;
		}//FECHA WHILE
		
	}
	
	public function obterMinuto($garrison){
		$minuto = "00";
		switch($garrison){
		
			case('300234062065720'):
			case('300234062063760'):
			case('300234061748290'):
			case('300234062067760'):
			case('300234062062760'):
				$minuto = "05";
			break;
			case('300234062060760'):
			case('300234010074300'):
			case('300234062065740'):
				$minuto = "00";
			break;
			
			case('300234062168020'):
			case('300234062061760'):
			case('300234063416560'):
				$minuto = "10";
			break;
		
		}
		return $minuto;
	
	}
	
	
	public function Download(){
	
		header("Content-Type: application/force-download");
		header("Content-type: application/octet-stream;");
		header("Content-Length: " . filesize( $this->caminho ) );
		header("Content-disposition: attachment; filename=" . $this->fileName );
		header("Pragma: no-cache");
		header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
		header("Expires: 0");
		readfile( $this->caminho );
		flush();
		//FECHA O PONTEIRO DO ARQUIVO
		fclose($this->ponteiro);
	
	
	}
	
	public function DownloadXL($conteudo){
		$arquivo = 'planilha.xls';
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $conteudo;
		exit;
	
	
	}
		public function primeiraLinha(){
		
		$ponteiroAux = fopen($this->destino, 'r');
		for($i=0;$i<4;$i++){
			$conteudo = fgets($ponteiroAux,1024);
			if($i==3){
				$this->diaAuxiliar = substr($conteudo, 0, 14);
				
				if(strtotime($this->dataLimite)>=strtotime($this->diaAuxiliar))
				{
					$this->primeiroDia = $this->dataLimite;
				}else{
					$this->primeiroDia = date('m/d/y H:i', strtotime($this->diaAuxiliar,0,8));
				}
			}
		}
		
		
	}
	
	public function totalDias(){
		$ponteiroAux = fopen($this->destino, 'r');
		$linhas = 0;
		$linha1 = '';
		$linha2 = '';
		while (!feof($ponteiroAux)) {
			$conteudo = fgets($ponteiroAux,1024);
			if($linhas==3){
				$linha1= substr($conteudo, 0, 8);
			}
			if($linhas == $this->linhas){
				$linha2 = substr($conteudo, 0, 8);
			}
			$linhas++;
		}
		$data1 = date_create($linha1);
		$data2 = date_create($linha2);
		$dif = date_diff($data1, $data2);
		return $dif->days;			
		
	
	}
	
	private function diasSemMedicao($dia){
	
		$partes = explode('/', $dia);
		$partesIni = explode('/', $this->inicio);
		$stamp1 = mktime(0, 0, 0, $partes[0], $partes[1], $partes[2]);
		$stamp2 = mktime(0, 0, 0, $partesIni[0], $partesIni[1], $partesIni[2]);
		$dif = $stamp1 - $stamp2;
		$dias = (int)floor( $dif / (60 * 60 * 24));
		$tabela = "";
		if($dias > 0){
			
			$minuto = $this->obterMinuto($this->garrison);
			for($i = 1; $i <= $dias; $i++){
				
				switch($this->colunaSelecionada){
					case('n'):
						$tabela .= "<tr><td> -- </td></tr>";
					break;
					case('n_p'):
						$tabela .= "<tr><td> -- </td><td> -- </td></tr>";					
					break;
					
						
					case('v'):
						$tabela .= "<tr><td> -- </td></tr>";
					break;	
					
				}
			}
		
		}else{
		
			$tabela = "vazio";
		}
		
		return $tabela;
		
	
	
	}
	
}
	
	/*$differenceFormat = '%a';
		$datetime1 = date_create($dia);
		$datetime2 = date_create($this->inicio);
		
		$interval = date_diff($datetime1, $datetime2);
		
		echo $interval->format($differenceFormat);*/
	
	
	
	
	
?>