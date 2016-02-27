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
//variables
$nombre_buscado=$_POST['nombre_buscado'];
$ciudad_buscada=$_POST['ciudad_buscada'];
$genero_buscado=$_POST['genero_buscado'];
$tipo_buscado=$_POST['tipo_buscado'];
$codigo_fan=$_SESSION['id_user'];
//tabla
$sql="";
if($tipo_buscado == 1){//local
	$sql="select * from Usuario where tipo=1";
}
else if($tipo_buscado == 2){//musico
	$sql="select * from Usuario where tipo=2";
}
else{
$sql="select * from Concierto where 1=1 and estado_concierto=2";
}
if(!empty($_POST['genero_buscado'])){
	$sql=$sql." and codigo_genero=".$_POST['genero_buscado'];
}
if(!empty($_POST['ciudad_buscada'])){
	$sql=$sql." and codigo_genero=".$_POST['ciudad_buscada'];
}
if(!empty($_POST['nombre_buscado'])){
	$sql=$sql." and nombre_usuario like '%".$_POST['nombre_buscado']."%'";
}

if($tipo_buscado == 1){//local
	$db->executer($sql);
	$result=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No hay resultados con estos criterios";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre</td></tr>";
					foreach($result as $locales){
						extract($locales);
						echo "<tr><td>$nombre_usuario</td>";
						$query2="SELECT * FROM votacion_usuario WHERE codigo_fan=$codigo_fan and codigo_votado=$codigo_usuario";
						$db->executer($query2);
						$rows=$db->getNumRows($query2);
						if($rows==1){
							echo "<td>Ya has votado a este local</td>";
						}
						else{
						echo "<td><a href='VotarMusico.php?codigo=$codigo_usuario'>Votar a este usuario</a></td>";
						}
					}
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
else if($tipo_buscado == 2){//musico
	$db->executer($sql);
	$result=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No hay resultados con estos criterios";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre</td></tr>";
					foreach($result as $locales){
						extract($locales);
						echo "<tr><td>$nombre_usuario</td>";
						$query2="SELECT * FROM votacion_usuario WHERE codigo_fan=$codigo_fan and codigo_votado=$codigo_usuario";
						$db->executer($query2);
						$rows=$db->getNumRows($query2);
						if($rows==1){
							echo "<td>Ya has votado a este músico</td>";
						}
						else{
						echo "<td><a href='VotarMusico.php?codigo=$codigo_usuario'>Votar a este usuario</a></td>";
						}
					}
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
else{//concierto
	$db->executer($sql);
	$result=$db->getResultados($sql);
	$rows=$db->getNumRows($sql);
	if($rows==0){
		echo "No hay resultados con estos criterios";
	}
	else{
		echo "<table border=1>";
				echo "<tr><td>Nombre</td></tr>";
					foreach($result as $locales){
						extract($locales);
						echo "<tr><td>$nombre_concierto</td>";
						$queryX="SELECT * FROM votacion_concierto WHERE codigo_fan=$codigo_fan and codigo_concierto=$codigo_concierto;";
						$db->executer($queryX);
						$rows=$db->getNumRows($queryX);
						if($rows==1){
						echo "<td>Ya has votado este concierto</td></tr>";
						}
						else{
						echo "<td><a href='VotarConcierto.php?codigo_concierto=$codigo_concierto'>Votar este concierto</a></td></tr>";
						}
					}
					
		echo "</tr>";
		echo "<tr><td colspan='5' style='text-align:right;'></td></tr>";
		echo "</table>";
	}
}
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