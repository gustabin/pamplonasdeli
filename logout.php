<?php 
// Inicializamos sesion 
session_start(); 
// Borramos la variable


// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"] 
    );
   
}

require_once('tools/mypathdb.php');
$sql = mysql_query("DELETE FROM tbl_temporal WHERE email='".$_SESSION['email']."'");

// Borramos toda la sesion
session_destroy();
header("Location: index.php");
?>
