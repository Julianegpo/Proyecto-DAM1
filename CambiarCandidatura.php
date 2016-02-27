<?php
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
                    <img  id="logo" title="logo OhhhMusic" alt="OhhhMusic" src="img/Logoweb2.png" />    
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
	$codigo_concierto=$_GET['codigo_concierto'];
	$codigo_musico=$_GET['codigo_musico'];
	//rechazados cuando aceptas
	$query="UPDATE Subasta SET estado_subasta=3 where codigo_usuario!=$codigo_musico and codigo_concierto=$codigo_concierto;";
	$result=mysqli_query($con, $query);
	//concierto pasa a aceptado
	$query3="UPDATE Concierto SET estado_concierto=2 where codigo_concierto=$codigo_concierto;";
	$result3=mysqli_query($con, $query3);
	//aceptacion musico
	$query4="UPDATE Subasta SET estado_subasta=2 where codigo_usuario=$codigo_musico and codigo_concierto=$codigo_concierto;";
	$result4=mysqli_query($con, $query4);
	$query5="UPDATE Concierto SET codigo_musico=$codigo_musico;";
	$result5=mysqli_query($con, $query5);

	
header("refresh:3; url='MostrarConciertos.php'");


mysqli_close($con);
				}
		}
?>
 <footer>
		<br/>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
</body>
</html>