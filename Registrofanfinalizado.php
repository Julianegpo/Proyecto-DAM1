<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("Encriptacionhash.php");
require_once("database.php");


	$db=new Database();
		
		
	
			//creacion variables del formulario
			$user=$_POST['nombre_fan'];
			$passwd_fan=$_POST['contrasenya_fan'];
			$correo_fan=$_POST['correo_fan'];
			$ciudad_fan=$_POST['ciudad_fan'];
			$fecha_fan= date('Y/m/d', strtotime($_POST['fecha_fan']));
		
			//comprobacion nombre de usuario
			$query3="select * from Usuario where nombre_usuario='$user'";
			$result3=$db->executer($query3);
			if($db->getNumRows($result3)==1){
			// ERROR
			$_SESSION['error_nombre']="Este nombre de usuario ya existe! Elije otro.";
			header("Location: Registrofan.php");
			}
			//comprobacion correo electronico de usuario
			$query4="select * from Usuario where correo_usuario='$correo_fan'";
			$result4=$db->executer($query4);
			if($db->getNumRows($result4)==1){
			//ERROR
			$_SESSION['error_correo']="El correo introducido ya esta asociado a un usuario! Elije otro.";
			header("Location: Registrofan.php");
			}			
			//cuando tanto el correo como el nombre de usuario no estan repetidos
			else{
				unset($_SESSION['error']);
				$options = ['cost' => 7, 'salt' => 'BCryptRequires22Chrcts'];
				$pass_encriptado = password_hash($passwd_fan, PASSWORD_BCRYPT, $options);
				$query5="insert into Usuario(nombre_usuario, contrasenya, correo_usuario, codigo_ciudad, fecha_nacimiento, tipo) 
				values ('$user', '$pass_encriptado', '$correo_fan', '$ciudad_fan', '$fecha_fan', 3)";
				$db->executer($query5);
				echo "Registro finalizado! Bienvenido a OhhhMusic!";
				//header("refresh: 5; url= index.php");
			}
				
$db->disconnect();		
?>
