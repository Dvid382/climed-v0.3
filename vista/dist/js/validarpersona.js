$(document).ready(function() {
    // Validar que el campo nombre solo contenga letras
    $('#nombre').keypress(function(e) {
        var keyCode = e.which;
        if ((keyCode != 8 || keyCode == 32) && (keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122)) {
            e.preventDefault();
            alert('El campo nombre solo permite letras');
        }
    }).focus(function() {
        $(this).after('<div id="nombreHelp" class="text-info">Campo requerido. Solo se permiten letras.</div>');
    }).blur(function() {
        $('#nombreHelp').remove();
    });

    // Validar que el campo apellido solo contenga letras
    $('#apellido').keypress(function(e) {
        var keyCode = e.which;
        if ((keyCode != 8 || keyCode == 32) && (keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122)) {
            e.preventDefault();
            alert('El campo apellido solo permite letras');
        }
    }).focus(function() {
        $(this).after('<div id="apellidoHelp" class="text-info">Campo requerido. Solo se permiten letras.</div>');
    }).blur(function() {
        $('#apellidoHelp').remove();
    });

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

    // Validar que el campo telefono solo contenga números, tenga exactamente 11 caracteres y comience con un prefijo válido
    $('#telefono').keypress(function(e) {
        var keyCode = e.which;
        if ((keyCode < 48 || keyCode > 57)) {
            e.preventDefault();
            alert('El campo telefono solo permite números');
        }
    }).change(function() {
        if (this.value.length != 11 || !/^0412|^0416|^0426|^0414|^0424|^0254/.test(this.value)) {
            alert('El campo telefono debe contener exactamente 11 caracteres y comenzar obligatoriamente por 0412, 0416, 0426, 0414, 0424 o 0254');
        }
    }).focus(function() {
        $(this).after('<div id="telefonoHelp" class="text-info">Campo requerido. Solo se permiten números. Debe contener exactamente 11 caracteres y comenzar obligatoriamente por 0412, 0416, 0426, 0414, 0424 o 0254.</div>');
    }).blur(function() {
        $('#telefonoHelp').remove();
    });

    // Validar que el campo correo sea un correo electrónico válido
    $('#correo').change(function() {
        var regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (!regex.test(this.value)) {
            alert('El campo correo debe ser un correo y tener la expresión nombre@dominio.com');
        }
    }).focus(function() {
        $(this).after('<div id="correoHelp" class="text-info">Campo requerido. Debe ser un correo y tener la expresión nombre@dominio.com.</div>');
    }).blur(function() {
        $('#correoHelp').remove();
    });

    // Validar que el campo sexo esté seleccionado
    $('input[type=radio][name=sexo]').change(function() {
        if (!$('input[type=radio][name=sexo]:checked').val()) {
            alert('El campo sexo debe estar seleccionado');
        }
    });

    // Validar que el campo direccion no exceda los 100 caracteres
    $('#direccion').keypress(function() {
        if(this.value.length > 100) {
            alert('El campo direccion solo permite 100 caracteres');
            return false;
        }
    }).focus(function() {
        $(this).after('<div id="direccionHelp" class="text-info">Campo requerido. Solo permite 100 caracteres.</div>');
    }).blur(function() {
        $('#direccionHelp').remove();
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
