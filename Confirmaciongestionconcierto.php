<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");

		if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
				else{
				$tipo_usuario=$_SESSION['tipo_usuario'];
				$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
				or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
				if($tipo_usuario!=1){
					echo "No tienes permisos para acceder a esta página, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
					
				else{
			
		$codigo=$_GET['codigo'];
		//creacion variables de la gestion del concierto
		$nuevo_nombre_concierto=$_POST['nuevo_nombre_concierto'];
		$nueva_fecha_concierto=date('Y/m/d', strtotime($_POST['nueva_fecha_concierto']));
		$nuevo_genero_concierto=$_POST['nuevo_genero_concierto'];
		//ejecucion de la query
		$query="UPDATE Concierto SET nombre_concierto='$nuevo_nombre_concierto', fecha_concierto='$nueva_fecha_concierto'
		where codigo_concierto=$codigo;";
		$resultado = mysqli_query($con, $query);
			echo "Concierto modificado.";
			header("Location: MostrarConciertos.php");

	mysqli_close($con);
				}
				}
?>