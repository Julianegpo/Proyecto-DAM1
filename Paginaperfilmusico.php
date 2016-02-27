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
		<link rel="stylesheet" href="CSS/perfiles.css"/>

 
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
				echo "<a href='Logout.php'>Log out</a>";
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
		<div id='perfil_musico'>
<?php
				if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
	else{
				$tipo_usuario=$_SESSION['tipo_usuario'];
				$con=mysqli_connect("localhost", "root", "Juegpo13295kksbbdd", "Proyecto_Multiplataforma_Inicial")
				or die("No se ha podido conectar con la base de datos. Inténtalo más tarde.");
				if($tipo_usuario!=2){
					echo "No tienes permisos para acceder a esta página, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
				
				else{
				$nombre = $_SESSION['nombre_usuario'];
				$genero_usuario=$_SESSION['genero_usuario'];
				$query="select u.nombre_usuario, c.nombre_ciudad, u.correo_usuario, u.telefono_usuario, u.direccion_usuario, g.nombre_genero 
				from Usuario u, Genero g, Ciudad c 
				where u.codigo_genero=g.codigo_genero and c.codigo_ciudad=u.codigo_ciudad and nombre_usuario='$nombre';";
				$resultado=mysqli_query($con, $query);
				while($fila=mysqli_fetch_array($resultado)){
				extract($fila);
				}
				echo "Nombre de usuario: $nombre_usuario
				<br/>
				Correo de contacto: $correo_usuario
				<br/>
				Telefono de contacto: $telefono_usuario
				<br/>
				Ciudad: $nombre_ciudad
				<br/>
				Genero favorito: $nombre_genero
				<br/>
				<a href='PaginacionConciertos.php'>Buscar conciertos con tu genero</a><br/>
				<a href='VerCandidaturas.php'>Ver mis candidaturas</a><br/>
				<a href='ModificarPerfil.php'>Modificar mi perfil</a>";
				}
				mysqli_close($con);
				}

?>
</div>
        <footer>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
           
        </footer>
</body>
</html>