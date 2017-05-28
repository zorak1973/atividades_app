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
	public $diaAuxiliar;
	public $colunasDaEstacao;
	public $colunaSelecionada;
	public $garrison;
	public $zeroRegua;
	public $colChuva;
	public $lenChuva;
	public $colNivel;
	public $lenNivel;
	public $conVazao;
	public $lenVazao;
	public $pluviosidadeDiaria;
	public $minutoEnvio;
	public $arrEfetivos;
	public $strEfetivos;
	
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
		$this->colCota   = $colunas[6];
		$this->lenCota   = $colunas[7];
		
	}
	
	public function identificaCampos($colunas)
	{
		$this->colChuva = $colunas[0];
		$this->colNivel = $colunas[1];
		$this->colVazao = $colunas[2];
		$this->colCota  = $colunas[3];
		
	}
	
	public function setGarrison($garrison)
	{
		
		$this->garrison = $garrison;
		
	}
	
	public function setZeroRegua($zeroRegua)
	{
		
		$this->zeroRegua = $zeroRegua;
		
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
		
		switch($this->strEfetivos){
			case('n'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>N&iacute;vel(m)</b></td></tr>';
				break;
			case('c'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Cota(m)</b></td></tr>';
				break;
			case('p'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td></tr>';
				break;
			case('p_n'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td><b>N&iacute;vel(m)</b></td></tr>';
				break;
			case('p_c'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td><b>Cota(m</b></td></tr>';
				break;
			case('p_n_c'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td><b>Cota(m)</b></td><td><b>N&iacute;vel(m)</b></td></tr>';
				break;
			case('n_v_c'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>N&iacute;vel(m)</b></td><td><b>Cota(m)</b></td><td>Vaz&atilde;o(m3/s)</td></tr>';
				break;
			case('v'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td>Vaz&atilde;o(m3/s)</td></tr>';
				break;
			case('p_v'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td>Vaz&atilde;o(m3/s)</td></tr>';
				break;	
			case('p_n_v_c'):
				$tabela .=  '<tr><td><b>Data/Hora</b></td><td><b>Chuva(mm)</b></td><td><b>N&iacute;vel(m)</b></td><td><b>Cota(m)</b></td><td>Vaz&atilde;o(m3/s)</td></tr>';
				break;
			case(''):
				$tabela .=  "<tr><td>A estação não possui os dados solicitados.</td></tr>";
				break;
			
		}
		
		
		
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgets($this->ponteiro, 4096);
			
			
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
				
				$diaIncompleto = substr($linhaAtual, 0, 14);
								
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					
					
					
					$diaAux = explode("/", $dia);
				
					$dia2= $diaAux[1]."/".$diaAux[0]."/".$diaAux[2];
					
					$tabela .= "<tr><td>".$dia2."</td>";
					
					switch($this->strEfetivos){
						case('n'):
							if(isset($valores2[$this->colNivel])){
								$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
						break;
						case('c'):
							if(isset($valores2[$this->colCota])){
								$tabela .= "<td>".trim($valores2[$this->colCota])."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
						break;
						case('v'):
							if(isset($valores2[$this->colVazao])){
								$tabela .= "<td>".$valores2[$this->colVazao]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}					
						break;
						case('p'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
						break;
						case('p_n'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colNivel])){
								$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
											
						break;
						case('p_c'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colCota])){
								$tabela .= "<td>".trim($valores2[$this->colCota])."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
											
						break;
						case('p_n_c'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colCota])){
								$tabela .= "<td>".trim($valores2[$this->colCota])."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colNivel])){
								$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							
						break;
						case('n_v_c'):
							if(isset($valores2[$this->colNivel])){
								$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colCota])){
								$tabela .= "<td>".trim($valores2[$this->colCota])."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colVazao])){
								$tabela .= "<td>".$valores2[$this->colVazao]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}	
							
						break;
						case('p_v'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colVazao])){
								$tabela .= "<td>".$valores2[$this->colVazao]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}	
						break;
						case('p_n_v_c'):
							if(isset($valores2[$this->colChuva])){
								$tabela .= "<td>".$valores2[$this->colChuva]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colNivel])){
								$tabela .= "<td>".$valores2[$this->colNivel]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colCota])){
								$tabela .= "<td>".trim($valores2[$this->colCota])."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							if(isset($valores2[$this->colVazao])){
								$tabela .= "<td>".$valores2[$this->colVazao]."</td>";
							}else{
								$tabela .= "<td>&nbsp;</td>";
							}
							
						break;
						case(''):
							$tabela .="</tr></table>";
							return $tabela;
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
		
		
		switch($this->strEfetivos){
			case('n'):
				$tabela =  "Data/Hora    Nivel(m)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('c'):
				$tabela =  "Data/Hora    Cota(m)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('p'):
				$tabela =  "Data/Hora    Chuva(mm)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('p_n'):
				$tabela =  "Data/Hora    Chuva(mm)      Nivel(m)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('p_c'):
				$tabela =  "Data/Hora    Chuva(mm)      Cota(m)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('p_n_c'):
				$tabela =  "Data/Hora    Chuva(mm)      Cota(m)      Nivel(m)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('n_v_c'):
				$tabela =  "Data/Hora    Nivel(m)      Cota(m)     Vazão(m3/s)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('v'):
				$tabela ="Data/Hora    Vazão(m3/s)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case('p_v'):
				$tabela =  "Data/Hora    Chuva(mm)      Vazão(m3/s)\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;	
			case('p_n_v_c'):
				$tabela =  "Data/Hora \t";
				$tabela.= "Chuva(mm)\t";
				$tabela.= "Nivel(m) ";
				$tabela.= "Cota(m) ";
				$tabela.= "Vazão(m3/s)";
				$tabela.= "\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			case(''):
				$tabela =  "A estação não possui os dados solicitados.\r\n";
				fwrite($arquivoExportacao, $tabela);
				break;
			
		}
		
		
		//LÊ O ARQUIVO ATÉ CHEGAR AO FIM 
		while (!feof($this->ponteiro)) {
		  
		//LÊ UMA LINHA DO ARQUIVO
			$linhaAtual = fgetss($this->ponteiro,4096);
			
			
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
					
					switch($this->strEfetivos){
						case('n'):
							if(isset($teste2[$this->colNivel])){
								$tabela = " ".$dia2."    ".$teste2[$this->colNivel]."\r\n";
							}else{
								$tabela = " ".$dia2."    \r\n";
							}
							fwrite($arquivoExportacao, $tabela);
						break;
						case('c'):
							if(isset($teste2[$this->colCota])){
								$tabela = " ".$dia2."    ".trim($teste2[$this->colCota])."\r\n";
							}else{
								$tabela = " ".$dia2."    \r\n";
							}
							fwrite($arquivoExportacao, $tabela);
						break;
						case('v'):
							if(isset($teste2[$this->colVazao])){
								$tabela = " ".$dia2."    ".$teste2[$this->colVazao]."\r\n";
							}else{
								$tabela = " ".$dia2."    \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p'):
							if(isset($teste2[$this->colChuva])){
								$tabela = " ".$dia2."    ".$teste2[$this->colChuva]."\r\n";
							}else{
								$tabela = " ".$dia2."    \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p_n'):
							if(isset($teste2[$this->colChuva])){
								$tabela = " ".$dia2."    ".$teste2[$this->colChuva]."\t";
							}else{
								$tabela = " ".$dia2." \t";
							}
							if(isset($teste2[$this->colNivel])){
								$tabela.= "  ".$teste2[$this->colNivel]."\r\n";
							}else{
								$tabela.= "     \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p_c'):
							if(isset($teste2[$this->colChuva])){
								$tabela = " ".$dia2."    ".$teste2[$this->colChuva]."\t";
							}else{
								$tabela = " ".$dia2." \t";
							}
							if(isset($teste2[$this->colCota])){
								$tabela.= "    ".trim($teste2[$this->colCota])."\r\n";
							}else{
								$tabela.= "     \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p_n_c'):
							if(isset($teste2[$this->colChuva])){
								$tabela = " ".$dia2."    ".$teste2[$this->colChuva]."\t";
							}else{
								$tabela = " ".$dia2." \t";
							}
							if(isset($teste2[$this->colCota])){
								$tabela.= "    ".trim($teste2[$this->colCota])."\t";
							}else{
								$tabela.= " \t";
							}
							if(isset($teste2[$this->colNivel])){
								$tabela.= "    ".$teste2[$this->colNivel]."\r\n";
							}else{
								$tabela.= "       \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('n_v_c'):
							if(isset($teste2[$this->colNivel])){
								$tabela = " ".$dia2."    ".$teste2[$this->colNivel]."\t";
							}else{
								$tabela = " ".$dia2."   \t";
							}
							if(isset($teste2[$this->colVazao])){
								$tabela.= "    ".$teste2[$this->colVazao]."\t";
							}else{
								$tabela.= " \t";
							}
							if(isset($teste2[$this->colCota])){
								$tabela.= "    ".trim($teste2[$this->colCota])."\r\n";
							}else{
								$tabela.= "    \r\n";
							}
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p_v'):
							if(isset($teste2[$this->colChuva])){
								$tabela = " ".$dia2."    ".$teste2[$this->colChuva]."\t";
							}else{
								$tabela = " ".$dia2."    \t";
							}
							if(isset($teste2[$this->colVazao])){
								$tabela.= "    ".$teste2[$this->colVazao]."\r\n";
							}else{
								$tabela.= "    \r\n";
							}			
							fwrite($arquivoExportacao, $tabela);	
						break;
						case('p_n_v_c'):
							if(isset($teste2[$this->colChuva])){
								$tabela = $dia2."    ".$teste2[$this->colChuva]."\t";
							}else{
								$tabela = $dia2."  \t";
							}
							if(isset($teste2[$this->colNivel])){
								$tabela.= $teste2[$this->colNivel]."\t";
							}else{
								$tabela.= "\t";
							}
							if(isset($teste2[$this->colCota])){
								$tabela.= trim($teste2[$this->colCota])."\t ";
							}else{
								$tabela.= "\t";
							}
							if(isset($teste2[$this->colVazao])){
								$tabela.= $teste2[$this->colVazao]."\r\n";
							}else{
								$tabela.= "\r\n";
							}
										
							fwrite($arquivoExportacao, $tabela);	
						break;
						case(''):
							$this->Download();
							exit;
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
		$minutoFinal='';
		$colunas = "";
		$aux = 0;
		$tabela = "";
		$arquivoExportacao = fopen($this->estacao."_file.txt", "w");
		$diretorio = getcwd();
		$caminho = $diretorio."/".$this->estacao."_file.txt";
		$this->caminho = $caminho;
		$fileName = $this->estacao."_file.txt";
		$this->fileName = $fileName;
		//echo $this->linhas; exit;
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
			if($this->garrison === '300234063416560'){
				$tabela .="<tr><td>Estação não possui dados pluviométricos</td></tr>";
				$tabela .="</table>";
				return $tabela;
			
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
				//echo $hora;
				//$horacontrole = "00:00";
				
				if($this->minutoEnvio == "00"){
					$minutoSeguinte = "15";
					$minutoFinal = "23:45";
				}else{
					if($this->minutoEnvio == "05"){
						$minutoSeguinte = "20";
						$minutoFinal = "23:50";
					}else{
						$minutoSeguinte = "25";
						$minutoFinal = "23:55";
					}
				}
				$horacontroleLimiteFinal = substr($this->fim,9,2).":".$minutoSeguinte;
				//echo $horacontroleLimiteFinal;exit;
				$dia = substr($linhaAtual, 0, 14);
				$diaIncompleto = substr($linhaAtual, 0, 8);
							
				if((strtotime($dia) >= strtotime($this->inicio)) && (strtotime($dia) <= strtotime($this->fim)))
				{
					 
					$chuva = $valores2[$this->colChuva];
					$aux = $aux + $chuva;
					
					$this->pluviosidadeDiaria = $aux;
					
					if(($hora == $minutoFinal)&& strtotime($dia) >= strtotime($this->inicio)){	
						
						$diaAux2 = explode("/", $dia);
						$anoFim = substr($diaAux2[2],0,2);
						
						//$dia2= $diaAux2[1]."/".$diaAux2[0]."/".$diaAux2[2];
						
						$dia2 = $diaAux2[1]."/".$diaAux2[0]."/".$anoFim." 23:59";
						
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
		$minutoFinal='';
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
			if($this->garrison === '300234063416560'){
				$erro = "Estação não possui dados pluviométricos";
				fwrite($arquivoExportacao,$erro);
				return;
			
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
					$minutoFinal = "23:45";
				}else{
					if($this->minutoEnvio == "05"){
						$minutoSeguinte = "20";
						$minutoFinal = "23:50";
					}else{
						$minutoSeguinte = "25";
						$minutoFinal = "23:55";
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
					//if($hora == $horacontrole && $hora < ($horacontroleLimiteFinal) && strtotime($dia) >= strtotime($this->inicio)){
					
					if(($hora == $minutoFinal)&& strtotime($dia) >= strtotime($this->inicio)){		

						$diaAux2 = explode("/", $dia);
						$anoFim = substr($diaAux2[2],0,2);
						
						//$dia2= $diaAux2[1]."/".$diaAux2[0]."/".$diaAux2[2];
						$dia2 = $diaAux2[1]."/".$diaAux2[0]."/".$anoFim." 23:59";
				
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
							$colunas = "data/hora	----   	nivel(m)   -----    vazao(m3/s)\r\n";	
							break;
						case 'jacinto':
							$colunas = "data/hora 	----   	chuva(mm) 	nivel(m)     ------	vazao(m3/s)\r\n";
							break;
						case 'barramento':
							$colunas = "data/hora	chuva(mm)     -------       nivel(m)\r\n";
							break;
						case 'ipueiras':
						case 'areias':
							$colunas = "data/hora 	chuva(mm)   -------  	nivel(m)    -----     -----\r\n";
							break;
						case 'geronimo':
							$colunas = "data/hora 	chuva(mm)   -------  	nivel(m)     -----	vazao(m3/s)\r\n";
							break;
						case 'jurupary':
							$colunas = "data/hora 	--------	chuva(mm)     nivel(m)	-----	vazao(m3/s)\r\n";
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
		
			//case('300234062065720'):
			//case('300234062063760'):
			case('300234061748290'):
			case('300234062067760'):
			case('300234062062760'):
			case('300234061748080'):
				$minuto = "05";
			break;
			//case('300234062060760'):
			case('300234062063760'): //barramento
			case('300234062068740'): //jacinto
			case('300234010074300'):
			case('300234062065740'):
				$minuto = "00";
			break;
			case('300234061749250'):
			//case('300234062168020'):  //jacinto antigo
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
	
	
	
	
	public function comparaColunas($solicitados, $disponiveis){
		$arraySolicitados = explode("_", $solicitados);
		$arrayDisponiveis = explode("_", $disponiveis);
		
		$numSolicitados = count($arraySolicitados);
		$numDisponiveis = count($arrayDisponiveis);
		$arrayEfetivos = array();
		$stringEfetivos='';
		
		for($i=0;$i<count($arrayDisponiveis);$i++){
			if(strstr($solicitados,$arrayDisponiveis[$i])){
				$arrayEfetivos[] = $arrayDisponiveis[$i];
				if(strlen($stringEfetivos) > 0){
					$stringEfetivos .= "_".$arrayDisponiveis[$i];
				}else{
					$stringEfetivos .= $arrayDisponiveis[$i];
				}
			}
		}
		if(strstr($solicitados,"c") && in_array("n", $arrayDisponiveis) && !(in_array("c", $arrayEfetivos))){
			$arrayEfetivos[] ="c";
			if(strlen($stringEfetivos) > 0){
				$stringEfetivos .= "_c";
			}else{
				$stringEfetivos .= "c";
			}
		}
		$this->arrEfetivos = $arrayEfetivos;
		$this->strEfetivos = $stringEfetivos;
	}
	
}
	
?>