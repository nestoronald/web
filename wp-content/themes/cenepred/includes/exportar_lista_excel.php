<?php // session_start();

require_once("define.php");
require_once('classes/excel/Worksheet.php');
require_once('classes/excel/Workbook.php');


 function HeaderingExcel($filename) {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
 }
          
        // HTTP headers
		HeaderingExcel('Lista_solicitudes.xls');
		// Creating a workbook
		$workbook = new Workbook("-");
		// Creating the first worksheet
		
		// CREANDO ESTILOS
		$formatot =& $workbook->add_format();
		$formatot->set_size(8);
		$formatot->set_align('center');
		//$formatot->set_color('WHITE');
		$formatot->set_pattern();
		$formatot->set_fg_color('BLACK');
		$formatot->set_bold();
        
		$formatot2 =& $workbook->add_format();
		$formatot2->set_size(8);
	//	$formatot2->set_align('vcenter');
	//	$formatot2->set_align('center');
	//	$formatot2->set_align('vjustify'); 
        
//**************************** HOJA 01 *******************************************//		
  $worksheetname = "Lista Solicitudes";
  $worksheet1 =& $workbook->add_worksheet($worksheetname);		
 // $worksheet1->set_column(1, 1, 40);
  $worksheet1->set_row(0, 20);
  
  $worksheet1->write(0,0,"Item",$formatot);
  $worksheet1->write(0,1,"Fecha de Presentacion de la solicitud",$formatot);
  $worksheet1->write(0,2,"Nombre del Solicitante",$formatot);
  $worksheet1->write(0,3,"Informacion Solicitada",$formatot);
  $worksheet1->write(0,4,"Tipo de respuesta",$formatot);
  $worksheet1->write(0,5,"Duracion del Tramite",$formatot);
  $worksheet1->write(0,6,"Razones por las que se denego la solicitud",$formatot);
  
  $worksheet1->set_column(0, 0, 5);
  $worksheet1->set_column(0, 1, 25);
  $worksheet1->set_column(0, 2, 50);
  $worksheet1->set_column(0, 3, 50);
  $worksheet1->set_column(0, 4, 55);
  $worksheet1->set_column(0, 5, 20);
  $worksheet1->set_column(0, 6, 50);
  
  $x=1;$num=1;
  
  $vSQL_select="SELECT s.i_codsolicitud,s.v_solicitante,s.v_desunidad,s.v_tipodoc,s.v_numdoc,s.v_desrepre,s.v_direccion,s.v_departamento,s.v_provincia,s.v_distrito,s.v_telefono,s.v_email,
  		       s.v_solicitud,s.d_fecsolicitud,s.v_duracion,s.v_razonnegacion     
               FROM tr_cntbc_solicitudes s       
			   WHERE s.I_ESTREG=1 ORDER BY 1 DESC";

$rs_select = &$conn->Execute($vSQL_select);  //  echo '<br>'.$vSQL_select;
$nr_select = $rs_select->RecordCount();

 while (!$rs_select->EOF)
 {
	$i_codsolicitud = $rs_select->fields[0];
	$v_solicitante = $rs_select->fields[1];
	$v_desunidad = $rs_select->fields[2];
	$v_tipodoc = $rs_select->fields[3]; 
	$v_numdoc = $rs_select->fields[4];
	$v_desrepre = $rs_select->fields[5];
	$v_direccion = $rs_select->fields[6];
	$v_departamento = $rs_select->fields[7]; 
	$v_provincia = $rs_select->fields[8];    
	$v_distrito = $rs_select->fields[9];    
	$v_telefono = $rs_select->fields[10];  			 
	$v_email = $rs_select->fields[11]; 
	$v_solicitud = $rs_select->fields[12]; 
	$d_fecsolicitud = $rs_select->fields[13];
    $v_duracion = $rs_select->fields[14]; 
    $v_razonnegacion = $rs_select->fields[15];
            
      $vSQL_selectU="SELECT f.V_DESFORMATO FROM tr_cntbd_formato f WHERE f.i_codsolicitud='$i_codsolicitud'";	  
	  $rs_selectU = &$conn->Execute($vSQL_selectU); 
	  $formato = $rs_selectU->fields[0];
	  
	  $vSQL_selectP="SELECT p.V_DESPLANO FROM tr_cntbd_plano p WHERE p.i_codsolicitud='$i_codsolicitud'";
	  $rs_selectP = &$conn->Execute($vSQL_selectP);
	  $plano = $rs_selectP->fields[0];
    	
	$worksheet1->write($x,0,$num,$formatot2);
	$worksheet1->write($x,1,$d_fecsolicitud,$formatot2);
	$worksheet1->write($x,2,$v_solicitante,$formatot2);
	$worksheet1->write($x,3,$v_solicitud,$formatot2);
	$worksheet1->write($x,4,$formato,$formatot2);
    $worksheet1->write($x,5,$v_duracion,$formatot2);    
    $worksheet1->write($x,6,$v_razonnegacion,$formatot2);
    
	$num++; $x++;
	$rs_select->MoveNext();
 }  
 $rs_select->Close();
  
$workbook->close();

?>