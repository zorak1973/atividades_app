<?php 
class CI_Toexcel {
/*
* Excel library for Code Igniter applications
* Author: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
*/

function to_excel($query, $filename='exceloutput', $titulo)
{
	 $inicio = "<table><tr><td colspan='5'><b>".$titulo."</b></td></tr></table>";
     $inicio .= "<table border='1px'><tr>";
	 $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below

     $obj =& get_instance();

     $fields = $query->field_data();
	 
	//var_dump($fields); exit;
     if ($query->num_rows() == 0) {
          //echo '<p>The table appears to have no data.</p>';
     } else {
          foreach ($fields as $field) {
             //$headers .= $field->name . "\t";
			 $headers .= "<td bgcolor='#cccccc'><b>".strtoupper($field->name) ."</b></td>";
          }

          foreach ($query->result() as $row) {
              // $line = '';
			   $line = "<tr>";
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         //$value = "\t";
						 $value = "<td>&nbsp;</td>";
                    } else {
                         //$value = str_replace('"', '""', $value);
                         //$value = '"' . $value . '"' . "\t";
						 $value = "<td>".$value."</td>";
                    }
                    $line .= $value;
               }
			   $line .= "</tr>";
               //$data .= trim($line)."\n";
			   $data .= $line;
          }
		  $data .= "</table>";
          //$data = str_replace("\r","",$data);
		  /*echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

		  echo '<html xmlns="http://www.w3.org/1999/xhtml">';
		  echo "<head>";*/
		 /* header("Content-type: application//octet-stream");
		  header("Content-Disposition: attachment; filename=$filename.xls");
		  header("Pragma: no-cache");
		  header("Expires: 0");*/
		  //header('Content-Type: text/html; charset=UTF-8');
		  /*echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >';*/
		  
		 /* echo "</head><body>";*/
          //header("Content-type: application/x-msdownload");
          
		  //echo $headers."\n".$data;  
		  $conteudo = $inicio.$headers.$data;
		  return $conteudo;
		 /* echo "</body></html>";*/
     }
}

}
