$(document).ready(function() {
    // Validar fecha al cambiar el valor del campo
    $('#fecha').on('blur', function() {
        var fechaSeleccionada = new Date($(this).val());
        var fechaActual = new Date();
        // Establecer la hora de la fecha actual a 00:00:00 para la comparación
        fechaActual.setHours(0, 0, 0, 0);

        if (fechaSeleccionada < fechaActual) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha seleccionada no puede ser anterior a la fecha actual.'
            });
            $(this).val('');
        }
    });
});
