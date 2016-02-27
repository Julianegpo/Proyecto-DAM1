﻿<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");
?>
<html>
 <head>
        <title>Proyecto OhhhMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
    </head>
   <body>
        <header>

            <div id="headerTop" class="withSpace">

                <div class="left">
                    <a href='index.php'><img  id="logo" title="logo OhhhMusic" alt="OhhhMusic" src="img/Logoweb2.png" /></a>
                </div>
                <div class="middle" >
                    <section>
                        <nav>
                                <ul style="list-style-type:none">
                                
                                    <li><a href="#InfoMusic">Conoce OhhhMusic</a></li>
                                    <li><a href="#InfoLocal">¿Tienes un local?</a></li>
                                    <li><a href="#InfoMusico">¿Eres músico?</a></li>
                                    <li><a href="#InfoFan">Encuentra aquí a tus ídolos</a></li>
                                
                                </ul>
                           </nav>
                            <div class="Infolinks">
                                <div id="InfoMusic">OhhhMusic es el mejor portal web que relaciona locales con músicos y fans, ¡una red social de la música definitiva!</div>
                                <div id="InfoLocal">Contacta con músicos y fans</div>
                                <div id="InfoMusico">Contacta con locales y fans</div>
                                <div id="InfoFan">¡Busca y encuentra a tus ídolos!</div>                                                        
                            </div>
                          
                    </section>
                </div>
                
                <div class="right">
                    <span >
                        <a href="#"><img alt="Facebook" src="img/facebook3d.png"/></a>
                        <a href="#"><img alt="Twitter" src="img/twitter-3d-icon.png"/></a>
                    </span>
<?php
				if(!isset($_SESSION['id_user'])){
					echo "<div class='contDesplegable'>
                        <div class='login button'>LOGIN</div>
                        <form class='hidDesplegable' method='post' action='Login.php'>
                            <label for='inputNombre'>Nombre</label>
                            <input name='nombre' id='inputNombre' type='text'>
                            <label for='inputPass'>Contraseña</label>
                            <input name='pass' id='pass' type='password'>
                            <input type='submit'  value='Login'>
                        </form>
                    </div>
					
                    
                    <div class='contDesplegable registre'>
                        <div class='registre button'>REGISTRATE</div>
                        <form id='login_1' class='hidDesplegable'>
                            <a href='Registrolocal.php'><label for='inputLocal'>Local</label></a>
                            <br><a href='RegistroMusico.php'><label for='inputMusico'>Musico</label></a></br>
                            <a href='Registrofan.php'><label for='inputFan'>Fan</label></a>
                        </form>
                    </div>
                </div>";
				}
				else{
				echo "<a href='Logout.php'>Log out</a> <a href='DireccionPerfil.php'>Ir a mi pagina de perfil</a>";
				}
?>
        </div>
                <div></div>
                <div class="withSpace"></div>
            </div>
        </header>
		<br/>
<?php
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
		$codigo_usuario = $_SESSION['id_user'];
		$query="select c.codigo_concierto, c.nombre_concierto, c.fecha_concierto, c.estado_concierto, g.nombre_genero 
		from Concierto c inner join Genero g on c.codigo_genero=g.codigo_genero
		where codigo_usuario=".$_SESSION['id_user'].";";
		$resultado=mysqli_query($con, $query);
		$rows=mysqli_num_rows($resultado);
		if($rows==0){
		echo "No hay conciertos registrados.<br/>";
		}
		else{
		echo "<table border=1>
		<tr><td>Nombre concierto</td><td>Fecha concierto</td><td>Genero</td><td>Estado concierto</td><td>Modificar concierto</td><td>Ver musicos inscritos en este concierto</td></tr>";
		while($fila=mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<tr><td>$nombre_concierto</td><td>$fecha_concierto</td><td>$nombre_genero</td>";
			if($estado_concierto==1){
				echo "<td>En espera</td>";
			}
			if($estado_concierto==2){
				echo "<td>Confirmado</td>";
			}
			if($estado_concierto==3){
				echo "<td>Cancelado</td>";
			}
		echo "<td><a href='Gestionconcierto.php?codigo=$codigo_concierto'>Modifica concierto aqui</a></td><td><a href='MusicosInscritos.php?codigo=$codigo_concierto '>Ver musicos inscritos</a></td>
		</tr>";
		}
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
}
	mysqli_close($con);
				}
					}
?>
        <footer>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
</body>
</html>