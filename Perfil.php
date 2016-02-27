<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");
require_once("database.php");

			if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
				else{
				$tipo_usuario=$_SESSION['tipo_usuario'];
				$codigo_usuario=$_SESSION['id_user'];
				$db=new DataBase();
			//local
			if($tipo_usuario==1){
				$nuevo_nombre=$_POST['nuevo_nombre_usu'];
				$nuevo_tlf=$_POST['nuevo_tlf_usu'];
				$nueva_direc=$_POST['nueva_direccion_usu'];
				$nuevo_genero=$_POST['nuevo_genero_usu'];
				$query="UPDATE Usuario SET telefono_usuario='$nuevo_tlf', direccion_usuario='$nueva_direc', codigo_genero=$nuevo_genero
				where codigo_usuario=$codigo_usuario";
				$db->executer($query);
				echo "La información de tu perfil ha sido actualizada!";
				header("refresh:3; url='index.php'");
			}
			//musico
			if($tipo_usuario==2){
				$nuevo_nombre=$_POST['nuevo_nombre_usu'];
				$nuevo_tlf=$_POST['nuevo_tlf_usu'];
				$nueva_ciudad=$_POST['nueva_ciudad_usu'];
				$query="UPDATE Usuario SET telefono_usuario='$nuevo_tlf', codigo_ciudad=$nueva_ciudad
				where codigo_usuario=$codigo_usuario";
				$db->executer($query);
				echo "La información de tu perfil ha sido actualizada!";
				header("refresh:3; url='index.php'");
			}
			//fan
			if($tipo_usuario==3){
				
				$nueva_ciudad=$_POST['nueva_ciudad_usu'];
				$query="UPDATE Usuario SET codigo_ciudad=$nueva_ciudad
				where codigo_usuario=$codigo_usuario";
				$db->executer($query);
				echo $query;
				echo "La información de tu perfil ha sido actualizada!";
				header("refresh:3; url='index.php'");
			}
				
$db->disconnect();
				}
?>
