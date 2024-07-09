$(document).ready(function() {
    // Función para verificar la validez del formulario
    function checkFormValidity() {
      var isValid = true;
      $('.form-control, input[name="sexo"]').each(function() {
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
  
    // Validación de campos nombre, segundo nombre, apellido, segundo apellido
    $('.form-control[name="nombre"], .form-control[name="segundo_nombre"], .form-control[name="apellido"], .form-control[name="segundo_apellido"]').on('input', function() {
      var value = $(this).val();
      if (!/^[a-zA-Z]+$/.test(value)) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">Este campo solo acepta letras.</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
      checkFormValidity();
    });
  
    // Validación de campo teléfono
    $('#telefono').on('input', function() {
      var value = $(this).val();
      var regex = /^(0412|0416|0426|0414|0424|0254)\d{7}$/;
      if (value.length !== 11 || !regex.test(value)) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">El teléfono debe tener 11 dígitos y comenzar con 0412, 0416, 0426, 0414, 0424 o 0254.</div>');
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
  
    // Validación de campo correo electrónico
    $('#correo').on('input', function() {
      var value = $(this).val();
      var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!regex.test(value)) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">Ingrese un correo electrónico válido.</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
      checkFormValidity();
    });
  
    // Validación de campo dirección
    $('#direccion').on('input', function() {
      var value = $(this).val();
      if (value.length > 100) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">La dirección no puede tener más de 100 caracteres.</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger').remove();
      }
      checkFormValidity();
    });
  
    // Validación de campo sexo
    $('input[name="sexo"]').on('change', function() {
      if ($('input[name="sexo"]:checked').length === 0) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).parent().after('<div class="text-danger">Debe seleccionar un sexo.</div>');
      } else {
        $(this).removeClass('is-invalid');
        $(this).parent().next('.text-danger').remove();
      }
      checkFormValidity();
    });
  
    // Validación de campo fecha de nacimiento
    $('#f_nacimiento').on('input', function() {
      var value = $(this).val();
      var today = new Date();
      var birthDate = new Date(value);
      var minDate = new Date('1900-01-01');
      if (birthDate > today || birthDate < minDate) {
        $(this).addClass('is-invalid');
        $(this).next('.text-danger').remove();
        $(this).after('<div class="text-danger">La fecha de nacimiento debe estar entre el 1 de enero de 1900 y la fecha actual.</div>');
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
  