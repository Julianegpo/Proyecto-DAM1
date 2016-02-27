<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");
require_once("database.php");

$tipo_usuario=$_SESSION['tipo_usuario'];
				$codigo_usuario=$_SESSION['id_user'];
				$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
				or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
	
				if($tipo_usuario==1){
				header("Location: Paginaperfillocal.php");
				}
				if($tipo_usuario==2){
				header("Location: Paginaperfilmusico.php");
				}
				if($tipo_usuario==3){
				header("Location: Paginaperfilfan.php");
				}
				
				
				
mysqli_close($con);
?>