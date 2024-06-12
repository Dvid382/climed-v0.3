$(document).ready(function() {
    // Ocultar filas con estatus inactivo al cargar la página
    $("table tr").each(function() {
        if ($(this).find("td:eq(3)").text().trim() === "INACTIVO") {
            $(this).hide();
        }
    });

    // Manejar clic en el botón
    $("#btnMostrarInactivos").click(function() {
        if ($(this).hasClass("btn btn-outline-success m-2")) {
            // Mostrar filas inactivas
            $("table tr").each(function() {
                if ($(this).find("td:eq(3)").text().trim() === "INACTIVO") {
                    $(this).show();
                }
            });
            $(this).removeClass("btn btn-outline-success m-2").addClass("btn btn-outline-danger m-2").text("Ocultar inactivos");
        } else {
            // Ocultar filas inactivas
            $("table tr").each(function() {
                if ($(this).find("td:eq(3)").text().trim() === "INACTIVO") {
                    $(this).hide();
                }
            });
            $(this).removeClass("btn btn-outline-danger m-2").addClass("btn btn-outline-success m-2").text("Mostrar inactivos");
        }
    });
});