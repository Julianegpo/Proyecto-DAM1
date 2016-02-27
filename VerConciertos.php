<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("datos_basedatos.php");
require_once("database.php");
?>
<html>
    <head>
        <title>Proyecto OhhhMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 990px)" href="CSS/mediabasic.css">
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
				echo "<a href='logout.php'>Log out</a> <a href='DireccionPerfil.php'>Ir a mi pagina de perfil</a>";
				}
?>
                </div>
        </header>
<br/>
<?php
if(!isset($_SESSION['id_user'])){
					header("Location:index.php");
				}
			else{
					$tipo_usuario=$_SESSION['tipo_usuario'];
				$db=new Database();
			if($tipo_usuario!=3){
					header("Location:index.php");
				}
			else{
			$codigo_fan=$_SESSION['id_user'];
				$query="SELECT * FROM Concierto c, Usuario u, Genero g 
				WHERE c.codigo_usuario=u.codigo_usuario and u.codigo_genero=g.codigo_genero and u.tipo=1";
				$db->executer($query);
				$result=$db->getResultados($query);
				echo "<table border=1>";
				echo "<tr><td>Nombre concierto</td><td>Fecha concierto</td><td>Género concierto</td><td>Local organizador</td></tr>";
					foreach($result as $conciertos){
						extract($conciertos);
						$query2="SELECT * FROM votacion_concierto WHERE codigo_fan=$codigo_fan and codigo_concierto=$codigo_concierto";
						$db->executer($query2);
						$rows=$db->getNumRows($query2);
						echo "<tr><td>$nombre_concierto</td><td>$fecha_concierto</td><td>$nombre_genero</td><td>$nombre_usuario</td>";
						if($rows==1){
						echo "<td>Ya has votado este concierto</td>";
						}
						else{
						echo "<td><a href='VotarConcierto.php?codigo=$codigo_concierto'>Votar este concierto</a></td>";
						}
					}
					echo "</tr>";
					echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
					echo "</table>";
					
				}		
$db->disconnect();
	}
?>
 <footer>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
    </body>
</html>