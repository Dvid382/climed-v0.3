$(document).ready(function() {
  $('#nombre').on('keypress', function(e) {
    var inputValue = e.key;
    if (!/^[A-Za-z\s]*$/.test(inputValue)) {
      alert('Solo se permiten letras en el campo nombre');
      e.preventDefault();
    }
  });

 

  $('form').submit(function(event) {
    var estado = $('#estado').val();

    if (estado === null) {
      alert('El estado es requerido');
      event.preventDefault();
    }
  });

  $(document).on("contextmenu",function(e){
    e.preventDefault();
    alert('No se permite hacer clic derecho en esta página');
  });

  $(document).on("paste",function(e){
    e.preventDefault();
    alert('No se permite pegar en esta página');
  });
});