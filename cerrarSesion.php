<?php

// Archivo cerrarSesion.php

 // Se reanuda con la sesion que ya se tenia iniciada
session_start(); 

// Se "destruye"  la sesion libera los recursos de esta.  por lo que se redirecciona a la pagina de login
session_destroy();
header("Location:login.php")

?>