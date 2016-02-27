<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("Encriptacionhash.php");
require_once("datos_basedatos.php");
	
		if(isset($_SESSION['id_user'])){
					echo "¡Ya has iniciado sesion!";
					header("refresh:3; url='index.php'");
				}
				else{
	$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
	or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
		
	
	
	$user=$_POST['nombre'];
	$passwd=$_POST['pass'];
	
	$options = ['cost' => 7, 'salt' => 'BCryptRequires22Chrcts'];
	$pass_encriptado = password_hash($passwd, PASSWORD_BCRYPT, $options);
	$query="select codigo_usuario, nombre_usuario, tipo, codigo_genero from Usuario where nombre_usuario='$user' and contrasenya='$pass_encriptado'";
	$resultado = mysqli_query($con, $query);
	$rows=mysqli_num_rows($resultado);
	
	if($rows==1){
	$object=mysqli_fetch_array($resultado);
	extract($object);
	$_SESSION['genero_usuario']=$codigo_genero;
	$_SESSION['id_user']=$codigo_usuario;
	$_SESSION['nombre_usuario']=$user;
	$_SESSION['tipo_usuario']=$tipo;
	echo "Login correcto! Bienvenido a OhhhMusic.";
	if($tipo==1){
	header("Location:Paginaperfillocal.php");
	}
	if($tipo==2){
	header("Location:Paginaperfilmusico.php");
	}
	if($tipo==3){
	header("Location:Paginaperfilfan.php");
	}
	}
	else{
	echo "Login incorrecto!";
	header("Location:index.php");
	}
	mysqli_close($con);
				}
?>