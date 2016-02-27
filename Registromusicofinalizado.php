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
		<link rel="stylesheet" href="CSS/registrosfinalizados.css"/>

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
	$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
	or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
		
		
	
			//creacion variables del formulario
			$user=$_POST['nombre_musico'];
			$passwd_musico=$_POST['contrasenya_musico'];
			$correo_musico=$_POST['correo_musico'];
			$tlf_musico=$_POST['telefono_musico'];
			$genero_musico=$_POST['genero_musico'];
			$ciudad_musico=$_POST['ciudad_musico'];
		
		//comprobacion nombre de usuario
			$query3="select * from Usuario where nombre_usuario='$user'";
			$result3=mysqli_query($con, $query3);
			if(mysqli_num_rows($result3)>=1){
			// ERROR
			$_SESSION['error_nombre']="Este nombre de usuario ya existe! Elije otro.";
			header("Location: RegistroMusico.php");
			}
			//comprobacion correo electronico de usuario
			$query4="select * from Usuario where correo_usuario='$correo_musico'";
			$result4=mysqli_query($con, $query4);
			if(mysqli_num_rows($result4)==1){
			//ERROR
			$_SESSION['error_correo']="El correo introducido ya esta asociado a un usuario! Elije otro.";
			header("Location: RegistroMusico.php");
			}
			//cuando tanto el correo como el nombre de usuario no estan repetidos
			else{
				unset($_SESSION['error']);
				$options = ['cost' => 7, 'salt' => 'BCryptRequires22Chrcts'];
				$pass_encriptado = password_hash($passwd_musico, PASSWORD_BCRYPT, $options);
				$query5="insert into Usuario(nombre_usuario, contrasenya, correo_usuario, telefono_usuario, codigo_ciudad, codigo_genero, tipo) 
				values ('$user', '$pass_encriptado', '$correo_musico', '$tlf_musico', '$ciudad_musico', '$genero_musico', 2)";
				$resultado5 = mysqli_query($con, $query5);
				echo "Registro finalizado! Bienvenido a OhhhMusic!";
				header("refresh: 3; url= index.php");
			}
				
	mysqli_close($con);			
?>
<br/>
        <footer>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
</body>
</html>