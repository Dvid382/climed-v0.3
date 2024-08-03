$(document).ready(function() {
// Convertir todos los caracteres en mayúsculas, excepto en el campo clave
$('input:not(#clave)').on('input', function() {
    this.value = this.value.toUpperCase();
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
