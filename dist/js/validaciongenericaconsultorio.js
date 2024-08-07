$(document).ready(function() {
    // Convertir el campo "nombre" a mayúsculas y validar contenido
    $('#nombre').on('input', function() {
        this.value = this.value.toUpperCase();
        validateField($('#nombre'));
        checkFormValidity();
    });

    // Validar el campo "descripcion", convertir a mayúsculas y limitar longitud
    $('#descripcion').on('input', function() {
        this.value = this.value.toUpperCase();
        if (this.value.length > 100) {
            this.value = this.value.substring(0, 100);
            alert('No puede escribir más de 100 caracteres.');
        }
        validateField($('#descripcion'));
        checkFormValidity();
    });

    // Función para validar un campo individual
    function validateField(field) {
        var fieldLength = $.trim(field.val()).length;
        if (fieldLength == 0 || (field.attr('id') === 'descripcion' && fieldLength < 3)) {
            field.addClass('is-invalid');
            field.next('.text-info').remove();
            var message = field.attr('id') === 'descripcion' && fieldLength < 3 ? '*Debe tener al menos 3 caracteres.' : '*Campo requerido.';
            field.after('<div class="text-info">' + message + '</div>');
        } else {
            field.removeClass('is-invalid');
            field.next('.text-info').remove();
        }
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


