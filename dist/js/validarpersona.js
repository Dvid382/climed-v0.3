$(document).ready(function() {
    // Validar que el campo nombre solo contenga letras
    $('#nombre, #segundo_nombre, #apellido, #segundo_apellido').on('input', function() {
        var fieldName = $(this).attr('id');
        var fieldValue = $(this).val();
        if (!/^[a-zA-Z\s]*$/.test(fieldValue)) {
            $(this).addClass('is-invalid');
            $(this).after('<div class="text-danger">Este campo solo permite letras.</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').remove();
        }
        checkFormValidity();
    });

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

    // Validar que el campo telefono solo contenga números, tenga exactamente 11 caracteres y comience con un prefijo válido
    $('#telefono').on('input', function() {
        var telefonoValue = $(this).val();
        if (!/^\d+$/.test(telefonoValue) || telefonoValue.length !== 11 || !/^0412|^0416|^0426|^0414|^0424|^0254/.test(telefonoValue)) {
            $(this).addClass('is-invalid');
            $(this).after('<div class="text-danger">El teléfono debe contener solo números, tener 11 caracteres y comenzar con un prefijo válido.</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').remove();
        }
        checkFormValidity();
    });

    // Validar que el campo correo sea un correo electrónico válido
    $('#correo').on('input', function() {
        var correoValue = $(this).val();
        var regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (!regex.test(correoValue)) {
            $(this).addClass('is-invalid');
            $(this).after('<div class="text-danger">El correo debe ser un correo válido (nombre@dominio.com).</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').remove();
        }
        checkFormValidity();
    });

    // Validar que el campo direccion no exceda los 100 caracteres
    $('#direccion').on('input', function() {
        var direccionValue = $(this).val();
        if (direccionValue.length > 100) {
            $(this).addClass('is-invalid');
            $(this).after('<div class="text-danger">La dirección no puede exceder los 100 caracteres.</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').remove();
        }
        checkFormValidity();
    });

    // Validar que el campo sexo esté seleccionado
    $('input[type=radio][name=sexo]').change(function() {
        if (!$('input[type=radio][name=sexo]:checked').val()) {
            alert('El campo sexo debe estar seleccionado');
        }
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