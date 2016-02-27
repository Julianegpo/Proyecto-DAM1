<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
require_once("database.php");
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
        </header>
		<br/>
<?php
if(!isset($_SESSION['id_user'])){
					echo "No has iniciado sesion, seras redireccionado a la pagina principal.";
					echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
					//echo "<script language='javascript'>window.location='index.php'</script>"; 
				}
else{
		$tipo_usuario=$_SESSION['tipo_usuario'];
		if($tipo_usuario!=3){
				echo "No tienes permisos para ver esta página, serás redireccionado a la página principal.";
				echo "<meta http-equiv='Refresh' content='5;url=index.php'>";
				}
else{
$db=new Database();
echo "<form method='post' action='BuscadorVerFan.php'>";
echo "Nombre:<input type='text' name='nombre_buscado'><br/>";
echo "Genero:<select name='genero_buscado'><br/>";
		$query="select * from Genero;";
		$resultado2=$db->executer($query);
		$resultado2=$db->getResultados();
		echo "<option></option>";
		foreach($resultado2 as $genero){
			echo "<option value='$genero[0]'>$genero[1]</option>";
		}
		echo "</select><br/>";
echo "Ciudad:<select name='ciudad_buscada'><br/>";
		$query2="select * from Ciudad;";
		$resultado2=$db->executer($query2);
		$resultado2=$db->getResultados();
		echo "<option></option>";
		foreach($resultado2 as $ciudad){
			echo "<option value='$ciudad[0]'>$ciudad[1]</option>";
		}
		echo "</select><br/>";
echo "Tipo:<select name='tipo_buscado'>";
echo "<option value=1>Local</option>
	  <option value=2>Musico</option>
	  <option value=3>Concierto</option>";
echo "</select><br/>";
echo "<input type='submit' name='submit' value='Lets Rock!'/>
	  </form>";
	 
$db->disconnect();
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
