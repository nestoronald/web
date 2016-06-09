<?php 

$ruta=$_REQUEST["imagen"];
$ancho=$_REQUEST["ancho"]; //=1300; //690
$alto=$_REQUEST["alto"]; //=600;  //300
$extension=$_REQUEST["ext"];
if($extension=='jpg'){
$fuente = @imagecreatefromjpeg($ruta);
}
if($extension=='png'){
$fuente = @imagecreatefrompng($ruta);
}
$imgAncho = imagesx ($fuente);
$imgAlto =imagesy($fuente);
$imagen = imagecreatetruecolor($ancho,$alto);

imagecopyresized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);

header("Content-type: image/gif");
imagejpeg($imagen);

?>