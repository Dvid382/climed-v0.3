$(document).ready(function() {
    // Validar que el campo cedula solo contenga números y esté entre 1,000,000 y 50,000,000
    $('#cedula').keypress(function(e) {
        var keyCode = e.which;
        if ((keyCode < 48 || keyCode > 57)) {
            e.preventDefault();
            alert('El campo cedula solo permite números');
        }
    }).change(function() {
        if (this.value < 1000000 || this.value > 50000000) {
            alert('El campo cedula debe ser superior a un millón (1,000,000) y menor a cincuenta millones (50,000,000)');
        }
    }).focus(function() {
        $(this).after('<div id="cedulaHelp" class="text-info">Campo requerido. Solo se permiten números. Debe ser superior a un millón (1,000,000) y menor a cincuenta millones (50,000,000).</div>');
    }).blur(function() {
        $('#cedulaHelp').remove();
    });

      // Validar que el campo clave cumpla con todas las condiciones
      $('#clave').keyup(function() {
        var valor = this.value;
        var mensaje = 'Campo requerido. ';

        // Verificar cada condición
        if (valor.length < 8) {
            mensaje += 'Debe tener al menos 8 caracteres. ';
        }
        if (!/[0-9]/.test(valor)) {
            mensaje += 'Debe contener al menos un número. ';
        }
        if (!/[A-Z]/.test(valor)) {
            mensaje += 'Debe contener al menos una letra mayúscula. ';
        }
        if (!/[a-z]/.test(valor)) {
            mensaje += 'Debe contener al menos una letra minúscula. ';
        }
        if (!/[!#$%&/]/.test(valor)) {
            mensaje += 'Debe contener uno de los siguientes caracteres especiales (!#$%&/). ';
        }

        // Si se cumplen todas las condiciones, actualizar el mensaje a 'Clave válida'
        if (valor.length >= 8 && /[0-9]/.test(valor) && /[A-Z]/.test(valor) && /[a-z]/.test(valor) && /[!#$%&/]/.test(valor)) {
            mensaje = 'Clave válida';
        }

        // Actualizar el mensaje de ayuda
        $('#claveHelp').text(mensaje);
    }).focus(function() {
        // Mostrar el mensaje de ayuda cuando el usuario pone el puntero sobre el campo clave
        $(this).after('<div id="claveHelp" class="text-info"></div>');
    }).blur(function() {
        // Eliminar el mensaje de ayuda cuando el usuario quita el puntero del campo clave
        $('#claveHelp').remove();
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

$(document).ready(function() {
  
});
