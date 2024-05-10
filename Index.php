<?php
/*session_start();*/

// Verificar si hay una sesión activa y válida
if(isset($_SESSION['cedula']) && isset($_SESSION['clave'])) {
    // Aquí deberías verificar las credenciales del usuario
    $cedula = $_SESSION['cedula'];
    $clave = $_SESSION['clave'];
    
    // Realiza la verificación de las credenciales aquí
    $credencialesValidas = verificarCredenciales($cedula, $clave);

    if($credencialesValidas) {
        // Si las credenciales son válidas, redirige al usuario a la página de inicio
        header('Location: vista/home.php');
        exit;
    } else {
        // Si las credenciales no son válidas, destruye la sesión
        session_destroy();
    }
}
?>

<?php
include 'login.php';