<?php
session_start();
require_once("datosconexion.php");
$con = mysqli_connect("$server", "$user", "$password", "$basededatos")
	or die("No se ha podido conectar con la base de datos.");

$id=$_SESSION['id_user'];
	
function sube_imagen(){
    //Obtenemos la extensi�n del archivo a subir
    global $nombre_archivo;
    $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
    $extensiones_aceptadas = array("png", "jpg", "gif", "JPG");
    //Compruebo si la extensi�n del archivo que quiero subir coincide con las aceptadas
    if(array_search($extension, $extensiones_aceptadas)){
        if(is_uploaded_file($_FILES["archivo"]["tmp_name"])){
            //Guardo el archivo en la carpeta "imagenes" cambiando el nombre
            $nombre_archivo = "imagenes/".time().".".$extension;
	    move_uploaded_file($_FILES["archivo"]["tmp_name"], $nombre_archivo);
	    return 0;
        }
	else{
	    return 1;
	}
    }
    else{
	return 2;
    }
}
	
$resultado = sube_imagen();
if($resultado == 0){
    echo "Imagen subida";
    //Aqu� faltar�a hacer el INSERT en la base de datos. Guarda el valor de la variable $nombre_archivo
	//$query=" insert into Usuario(imagen_perfil) values('$nombre_archivo')";
	$query="UPDATE Usuario SET imagen_perfil='$nombre_archivo' where codigo_usuario=$id";
	mysqli_query($con, $query);
	echo $query;
}
else if($resultado == 1){
    echo "Imagen NO subida";
}
else{
    echo "Extension no v�lida";
}
mysqli_close($con);
?>