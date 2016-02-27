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
		<div id='perfil_musico'>
<?php
if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, serás redireccionado a la página principal";
					header("refresh:5; url='index.php'");
				}
				else{
				$tipo_usuario=$_SESSION['tipo_usuario'];
				$codigo_usuario=$_SESSION['id_user'];
				$db=new Database();
				//local
			if($tipo_usuario==1){
			//$query2="select * from Usuario where codigo_usuario=$codigo_usuario";
				echo "Bienvenido, en esta página podras modificar algunos campos de tu perfil que no te gusten.";
				echo "<form method='post' action='Perfil.php'>";
				echo "Nuevo telefono de contacto:<input type='text' name='nuevo_tlf_usu'><br/>
				Nueva direccion:<input type='text' name='nueva_direccion_usu'><br/>
				Nuevo género del local:<select name='nuevo_genero_usu'><br/>";
				$query="select * from Genero;";
				$resultado=$db->executer($query);
				$resultado=$db->getResultados();
				foreach($resultado as $genero){
					echo "<option value='$genero[0]'>$genero[1]</option>";
				}
				echo "</select><br/>
				<input type='submit' name='modificar_perfil' value='Lets Rock!'/><br/>
				</form>";
			}
			//musico
			if($tipo_usuario==2){
			//$query2="select * from Usuario where codigo_usuario=$codigo_usuario";
				echo "Bienvenido, en esta página podras modificar algunos campos de tu perfil que no te gusten.";
				echo "<form method='post' action='Perfil.php'>";
				echo "Nuevo telefono de contacto:<input type='text' name='nuevo_tlf_usu'><br/>
				Nueva ciudad:<select name='nueva_ciudad_usu'><br/>";
				$query="select * from Ciudad;";
				$resultado2=$db->executer($query);
				$resultado2=$db->getResultados();
				foreach($resultado2 as $ciudad){
					echo "<option value='$ciudad[0]'>$ciudad[1]</option>";
				}
				echo "</select><br/>
				<input type='submit' name='modificar_perfil' value='Lets Rock!'/><br/>
				</form>";
			}
			//fan
			if($tipo_usuario==3){
			//$query2="select * from Usuario where codigo_usuario=$codigo_usuario";
				echo "Bienvenido, en esta página podras modificar algunos campos de tu perfil que no te gusten.";
				echo "<form method='post' action='Perfil.php'>";
				echo "Nueva ciudad:<select name='nueva_ciudad_usu'><br/>";
				$query="select * from Ciudad;";
				$resultado2=$db->executer($query);
				$resultado2=$db->getResultados();
				foreach($resultado2 as $ciudad){
					echo "<option value='$ciudad[0]'>$ciudad[1]</option>";
				}
				echo "</select><br/>
				<input type='submit' name='modificar_perfil' value='Lets Rock!'/><br/>
				</form>";				
			}
				
$db->disconnect();
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