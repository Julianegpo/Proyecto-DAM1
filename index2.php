<?php
session_start();
if(isset($_SESSION['error'])){
echo $_SESSION['error'];
}
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
                <div></div>
                <div class="withSpace"></div>
            </div>
            <div class="botonsTop">
                <div class="button"><a href="#topLlista1">TOP MUSICOS</a></div>
                <div class="button"><a href="#topLlista2">TOP LOCALES</a></div>
                <div class="button"><a href="topLlista3">CONCIERTOS</a></div>
            </div>
        </header>
        <div id="main">
            <div class="withSpace">
                <div id="mitgPrincipal">
                    <div></div>
                    <section id="topLlista1" class="topTable">
                        <header>TOP MUSICOS</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                            <span class="dreta">
                                            </span>
                                     </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                   </tbody>
                            </table></div>
                    </section>
                    <div></div>
                    <section
                        id="topLlista2" class="topTable">
                        <header>TOP LOCALES</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                            </span>              
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                         </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table></div>
                        <div></div>
                    </section>
                    <div></div>
                    <section 
                        id="topLlista3" class="topTable">
                        <header>CONCIERTOS</header>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                      <td>
                                             
                                            <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                    <tr><td>
                                        <span class="dreta">
                                         </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table></div>
                    </section>
       
                    <div class="withSpace"></div>
                </div><aside id="addPrincipal">
                    <img src="img/Adagio2.jpg">
                    <img src="img/Roland Space2.jpg">
                </aside>
            </div>
        </div>
        <footer>
            <div>¡Contacta con nosotros!</div>
            <span>ohhhmusicempresa@gmail.com</span>
            <span>93 742 67 90</span>
        </footer>
    </body>
</html>