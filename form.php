<?php
echo "<form action='insertar.php' method='post' enctype='multipart/form-data'>
    <input type='file' name='archivo'/>
    <input type='submit'/>
</form>";
?>


// Llamar a la imagen, si no te responde te jodes.

echo "<img src='".$imagen_perfil."'/>";