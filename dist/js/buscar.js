function buscarEnTabla() {
    // Obtiene el valor del campo de búsqueda
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("buscador");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabla");
    tr = table.getElementsByTagName("tr");
  
    // Variable para rastrear si se encontraron coincidencias
    var seEncontraronCoincidencias = false;
  
    // Recorre todas las filas y celdas de la tabla para realizar la búsqueda
    for (i = 1; i < tr.length; i++) { // Comienza desde la segunda fila
      var mostrarFila = false;
      td = tr[i].getElementsByTagName("td");
      for (j = 0; j < td.length; j++) {
        var cell = td[j];
        if (cell) {
          txtValue = cell.textContent || cell.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            mostrarFila = true;
            seEncontraronCoincidencias = true; // Se encontró al menos una coincidencia
          }
        }
      }
      // Muestra u oculta la fila según si se encontró coincidencia en alguna celda
      if (mostrarFila) {
        tr[i].style.display = "table-row"; // Muestra la fila
      } else {
        tr[i].style.display = "none"; // Oculta la fila
      }
    }
  
  // Mostrar o eliminar el mensaje si no se encontraron coincidencias
  var mensaje = document.getElementById("mensajeNoCoincidencias");
  if (!seEncontraronCoincidencias) {
    if (!mensaje) {
      mensaje = document.createElement("h2");
      mensaje.id = "mensajeNoCoincidencias";
      mensaje.appendChild(document.createTextNode("No se encontraron coincidencias"));
      mensaje.style.textAlign = "center"; // Centrar el mensaje
      mensaje.style.width = "100%"; // Ajustar el ancho
      mensaje.style.marginTop = "20px"; // Agregar margen superior
      mensaje.style.marginBottom = "20px"; // Agregar margen inferior
      table.parentNode.insertBefore(mensaje, table.nextSibling); // Agregar el mensaje después de la tabla
    }
  } else {
    if (mensaje) {
      mensaje.parentNode.removeChild(mensaje); // Eliminar el mensaje si se encontraron coincidencias
    }
  }
}