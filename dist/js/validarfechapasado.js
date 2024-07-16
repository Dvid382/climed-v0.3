
$(document).ready(function() {
    // Validar fecha al cambiar el valor del campo
    $('#fecha').on('change', function() {
        var fechaSeleccionada = new Date($(this).val());
        var fechaActual = new Date();

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
