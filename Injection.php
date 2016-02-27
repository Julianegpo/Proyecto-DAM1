<?php
	$username=$_POST['username'];
	$pass = $_POST['pass'];
//procedimientos	
$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "bbdd");

$stmt=mysqli_prepare($con, "select * from Usuario
					where nombre_usuario=? and contrasenya=?;");
mysqli_stmt_bind_param($stmt, 'ss', $username, $pass);

mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
//objetos
$db=new mysqli("localhost", "root", "Juegpo13295kksbbdd", "bbdd");
$stmt=$db->prepare("select * from usuario where username=? and contrasenya=?;");
$stmt->bind_param('ss', $username, $pass);
$stmt->execute();
$result=$stmt->get_result();

function ejecutar($query, $formato, $datos){
}
?>