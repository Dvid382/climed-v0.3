document.addEventListener('DOMContentLoaded', function() {
    // Esta función se ejecutará automáticamente cuando el DOM esté completamente cargado
    function limpiarInputs() {
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.value = input.value.trim();
      });
    }
  
    // Llamar a la función para limpiar los inputs al cargar el DOM
    limpiarInputs();
  });