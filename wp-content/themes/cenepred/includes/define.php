<?php		
$hostname = "localhost";
$username = "root";    // prevengo_cenep 
$password = "";   // 2KA1Pf09s3NtcY
$database = "db_transparencia";
//-----------------------------------------------------------------------------------
/*CONEXION A DB*/
$adodb_dir="adodb5/";
include_once $adodb_dir."adodb.inc.php";
$conn = &ADONewConnection("mysql");
$conn->connectSID = true;
$conn->Connect($hostname,$username,$password,$database);
/*FIN CONEXION A DB*/
include ("adodb5/adodb.inc.php"); 