$(document).ready(function() {
    // Función para manejar la paginación
    function paginacion() {
      // Obtener la tabla con el ID "tabla"
      var tabla = $("#tabla");
  
      // Obtener todas las filas de la tabla
      var filas = tabla.find("tr");
  
      // Calcular el número total de páginas
      var totalPaginas = Math.ceil(filas.length / 10);
  
      // Crear los elementos de paginación
      var paginacion = $("<div>").addClass("paginacion");
  
      // Crear los botones de paginación
      for (var i = 1; i <= totalPaginas; i++) {
        var boton = $("<button class='btn btn-outline-primary'>").text(i).click(function() {
          mostrarPagina($(this).text());
        });
        paginacion.append(boton);
      }
  
      // Agregar la paginación a la tabla
      tabla.after(paginacion);
  
      // Mostrar la primera página por defecto
      mostrarPagina(1);
    }
  
    // Función para mostrar una página específica
    function mostrarPagina(numeroPagina) {
      // Obtener la tabla con el ID "tabla"
      var tabla = $("#tabla");
  
      // Obtener todas las filas de la tabla
      var filas = tabla.find("tr");
  
      // Ocultar todas las filas
      filas.hide();
  
      // Mostrar las filas correspondientes a la página seleccionada
      var inicio = (numeroPagina - 1) * 10;
      var fin = inicio + 10;
      filas.slice(inicio, fin).show();
  
      // Resaltar el botón de la página actual
      $(".paginacion button").removeClass("active");
      $(".paginacion button:nth-child(" + numeroPagina + ")").addClass("active");
    }
  
    // Llamar a la función de paginación cuando la página se carga
    paginacion();
  });
  