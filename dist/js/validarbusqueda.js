$(document).ready(function() {
   $('#nombre').on('keypress', function(e) {
        var inputValue = e.key;
        if (/\d/.test(inputValue)) {
            alert('Solo se permiten letras en este campo');
            e.preventDefault();
        }
        
    }).on('paste', function(e) {
        e.preventDefault();
        alert('No se permite pegar en este campo');
    });

    $(document).ready(function() {
    $('#codigo_barras').on('keypress', function(e) {
        var inputValue = e.key;
        if (/[a-zA-Z]/.test(inputValue)) {
            alert('Solo se permiten números en este campo');
            e.preventDefault();
        }
    });

    
    
    }).on('paste', function(e) {
        e.preventDefault();
        alert('No se permite pegar en este campo');
    });
});