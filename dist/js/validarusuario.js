$(document).ready(function() {
    // Función para verificar la validez del formulario
    function checkFormValidity() {
      var isValid = true;
      $('.form-control').each(function() {
        if ($(this).hasClass('is-invalid')) {
          isValid = false;
          return false;
        }
      });
      return isValid;
    }
  
    // Validación de campo cédula
    $('#cedula').on('input', function() {
      var cedulaValue = $(this).val();
      if (!/^\d+$/.test(cedulaValue) || cedulaValue < 1000000 || cedulaValue > 50000000) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">La cédula debe contener solo números y estar entre 1,000,000 y 50,000,000.</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
      checkFormValidity();
    }).on('keypress', function(e) {
      var key = String.fromCharCode(e.which);
      if (!/\d/.test(key)) {
        e.preventDefault();
      }
    });
  
    // Validación de campo contraseña
    $('#clave').on('input', function() {
      var password = $(this).val();
      var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&/()=])[a-zA-Z\d!"#$%&/()=]{8,}$/;
      if (!regex.test(password)) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">La contraseña debe tener al menos 8 caracteres, 1 mayúscula, 1 minúscula y 1 carácter especial (!"#$%&/()=).</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
      checkFormValidity();
    });
  
    // Validación del formulario antes de enviar
    $('form').submit(function(e) {
      if (!checkFormValidity()) {
        e.preventDefault();
      }
    });
  });
  