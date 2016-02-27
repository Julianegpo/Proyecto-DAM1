<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("Encriptacionhash.php");
require_once("datos_basedatos.php");
?>
<html>
 <head>
        <title>Proyecto OhhhMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/basic.css"/>
		<link rel="stylesheet" href="CSS/registros.css"/>

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
            <div class="botonsTop">
                <div class="button"><a href="#topLlista1">TOP MUSICS</a></div>
                <div class="button"><a href="#topLlista2">TOP LOCALS</a></div>
                <div class="button"><a href="topLlista3">CONCERTS</a></div>
            </div>
        </header>
<br/>

<?php
	if(isset($_SESSION['id_user'])){
					echo "¡Ya has iniciado sesion!";
					header("refresh:5; url='index.php'");
				}
				else{
					echo "<div id='formulario_registro'>";
		$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
			or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
		
	
		echo"El equipo de OhhhMusic te da la bienvenida!<br/>
		A continuacion deberas rellenar los siguientes campos para completar el registro:";
		
		echo "<form method='post' action='Registromusicofinalizado.php'><br/>
		Nombre de usuario:<input type='text' name='nombre_musico'/><br/>";
		if(isset($_SESSION['error_nombre'])){
		echo "Nombre de usuario ya existente. Elije otro.<br/>";
		}
		echo "<br/>";
		echo "Password:<input type='password' name='contrasenya_musico'/><br/>";
		echo "<br/>";
		echo "Correo electronico:<input type='text' name='correo_musico'><br/>";
		if(isset($_SESSION['error_correo'])){
		echo "Correo electronico ya registrado. Elije otro.<br/>";
		}
		echo "<br/>";
		echo "Telefono de contacto:<input type='text' name=telefono_musico><br/>
		<br/>
		Genero:<select name='genero_musico'><br/>";
		$query="select * from Genero;";
		$resultado=mysqli_query($con, $query);
		while($fila=mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<option value='$codigo_genero'>$nombre_genero</option>";
		}
		echo "</select><br/>
		<br/>
		Ciudad:<select name='ciudad_musico'><br/>";
		$query2="select * from Ciudad;";
		$resultado2=mysqli_query($con, $query2);
		while($fila=mysqli_fetch_array($resultado2)){
		extract($fila);
		echo "<option value='$codigo_ciudad'>$nombre_ciudad</option>";
		}
		echo "</select><br/>
		<br/>
		<input type='submit' name='registro_musico' value='Lets Rock!'/><br/>
		</form>";
		echo "</div>";
mysqli_close($con);
				}
?>
</div>

        <footer>
		<br/>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
</body>
</html>