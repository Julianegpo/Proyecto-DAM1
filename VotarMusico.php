<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");
require_once("database.php");



if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, seras redireccionado a la pagina principal.";
					echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
				}
				else{
					$tipo_usuario=$_SESSION['tipo_usuario'];
				$db=new Database();
				if($tipo_usuario!=3){
					echo "No tienes permisos para ver esta página, serás redireccionado a la página principal.";
				echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
				}
				else{
				$codigo=$_GET['codigo'];
				$codigo_fan=$_SESSION['id_user'];
				$query="INSERT INTO votacion_usuario(codigo_fan, codigo_votado)
				values ($codigo_fan, $codigo)";
				$db->executer($query);
				echo "<meta http-equiv='Refresh' content='0;url=BuscadorFan.php'>";
				/*header("Location: VerMusicos.php");*/			
				}		
$db->disconnect();
	}
?>