$(document).ready(function() {
    // Convertir todos los caracteres en mayúsculas
    
    // Validar que el campo nombre solo contenga letras
    $('#nombre').keypress(function(e) {
        var keyCode = e.which;
        if ((keyCode != 8 || keyCode == 32) && (keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122)) {
            e.preventDefault();
        }
    }).focus(function() {
        // Mostrar un mensaje cuando el usuario pone el puntero sobre el campo nombre
        $(this).after('<div id="nombreHelp" class="text-info">*Campo requerido. Solo se permiten letras.</div>');
    }).blur(function() {
        // Eliminar el mensaje cuando el usuario quita el puntero del campo nombre
        $('#nombreHelp').remove();
    });

    // Validar que el campo descripción no exceda los 100 caracteres
    $('#descripcion').keypress(function() {
        if(this.value.length > 100) {
            alert('El campo descripción permite un máximo de 100 caracteres');
            return false;
        }
    }).focus(function() {
        // Mostrar un mensaje cuando el usuario pone el puntero sobre el campo descripción
        $(this).after('<div id="descripcionHelp" class="text-info">Campo requerido. Máximo 100 caracteres.</div>');
    }).blur(function() {
        // Eliminar el mensaje cuando el usuario quita el puntero del campo descripción
        $('#descripcionHelp').remove();
    });

    // Validar que todos los campos estén llenos antes de enviar el formulario
    $('form').submit(function(e) {
        $('input').each(function() {
            if ($.trim(this.value).length == 0) {
                e.preventDefault();
                alert('Todos los campos son requeridos');
            }
        });
        $('select').each(function() {
            if (this.value == '') {
                e.preventDefault();
                alert('Todos los campos son requeridos');
            }
        });
    });
});