$(document).ready(function() {
    // Validar que el campo cedula solo contenga números y esté entre 1,000,000 y 50,000,000
    $('#cedula').on('input', function() {
        var cedulaValue = $(this).val();
        if (!/^\d+$/.test(cedulaValue) || cedulaValue < 1000000 || cedulaValue > 50000000) {
            $(this).addClass('is-invalid');
            $(this).after('<div class="text-danger">La cédula debe contener solo números y estar entre 1,000,000 y 50,000,000.</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').remove();
        }
        checkFormValidity();
    });

    // Validar que el campo clave cumpla con todas las condiciones
    $('#clave').on('input', function() {
        var claveValue = $(this).val();
        var mensaje = 'Campo requerido. ';

        // Verificar cada condición
        if (claveValue.length < 8) {
            mensaje += 'Debe tener al menos 8 caracteres. ';
        }
        if (!/[0-9]/.test(claveValue)) {
            mensaje += 'Debe contener al menos un número. ';
        }
        if (!/[A-Z]/.test(claveValue)) {
            mensaje += 'Debe contener al menos una letra mayúscula. ';
        }
        if (!/[a-z]/.test(claveValue)) {
            mensaje += 'Debe contener al menos una letra minúscula. ';
        }
        if (!/[!#$%&/]/.test(claveValue)) {
            mensaje += 'Debe contener uno de los siguientes caracteres especiales (!#$%&/). ';
        }

        // Si se cumplen todas las condiciones, actualizar el mensaje a 'Clave válida'
        if (claveValue.length >= 8 && /[0-9]/.test(claveValue) && /[A-Z]/.test(claveValue) && /[a-z]/.test(claveValue) && /[!#$%&/]/.test(claveValue)) {
            mensaje = 'Clave válida';
        }

        // Actualizar el mensaje de ayuda
        $('#claveHelp').text(mensaje);
        checkFormValidity();
    });

    // Validar que todos los campos estén llenos antes de enviar el formulario
    function checkFormValidity() {
        var isValid = true;
        $('input, select').each(function() {
            if ($(this).hasClass('is-invalid') || $(this).val() === '') {
                isValid = false;
            }
        });
        $('button[type="submit"]').prop('disabled', !isValid);
    }

    // Inicialmente desactivar el botón de envío
    checkFormValidity();

    // Validar el formulario antes de enviarlo
    $('form').submit(function(e) {
        if ($('button[type="submit"]').prop('disabled')) {
            e.preventDefault();
            alert('Por favor complete todos los campos correctamente.');
        }
    });
});