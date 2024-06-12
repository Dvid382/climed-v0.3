$(document).ready(function() {
// Convertir todos los caracteres en mayúsculas, excepto en el campo clave
$('input:not(#clave)').on('input', function() {
    this.value = this.value.toUpperCase();
});


    // Deshabilitar la función de copiar y pegar
    $('input').bind('copy paste', function(e) {
        e.preventDefault();
        alert('No está permitido copiar y pegar');
    });

    // Deshabilitar el clic derecho
    $(document).bind('contextmenu', function(e) {
        e.preventDefault();
        alert('No está permitido abrir el menú contextual');
    });

    // Deshabilitar la tecla F5 (recargar la página)
    $(document).bind('keydown', function(e) {
        if(e.keyCode == 116) {
            e.preventDefault();
            alert('No está permitido recargar la página');
        }
    });

    // Deshabilitar la tecla F12 (herramientas de desarrollo)
    $(document).bind('keydown', function(e) {
        if(e.keyCode == 123) {
            e.preventDefault();
            alert('No está permitido inspeccionar el código');
        }
    });

    // Deshabilitar la función de arrastrar y soltar
    $(document).bind('dragstart drop', function(e) {
        e.preventDefault();
        alert('No está permitido arrastrar y soltar');
    });
});
