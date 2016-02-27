<?php
//desplegable tipo usuario musico(tabla usuario) local(tabla usuario) concierto(tabla concierto)
//genero, ciudad, (fecha(conciertos)), nombre
$tipo_busqueda=$_POST['midesplegable']
$sql="";
if($tipo_busqueda == 1){//musico
	$sql="select * from usuario where tipo=1";
}
else if($tipo_busqueda == 2){
	$sql="select * from usuario where tipo=2";
}
else{
$sql="select * from concierto where 1=1";
}
if(!empty($_POST['genero'])){
	$sql=$sql." and codigo_genero=".$_POST['genero'];
}
if(!empty($_POST['nombre'])){
	$sql=$sql." and nombre like '%".$_POST['nombre']."%'";
}
?>