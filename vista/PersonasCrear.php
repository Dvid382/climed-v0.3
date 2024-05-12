<?php
require_once '../controlador/UsuariosController.php';
$controladorUsuario = new UsuariosController();
$usuarios = $controladorUsuario->verTodosUsuarios();
$vistas = $controladorUsuario->Vistas();
$controlar = $controladorUsuario->controlarAcceso(__FILE__);
?>

<!DOCTYPE html>
<html>
<head>
<?php include('dist/Plantilla.php');?>
</head>
<body>
<div class="container-sm pt-4 px-4">

     <?php
        require_once '../controlador/PersonasController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = ucfirst($_POST['nombre']);
            $apellido = ucfirst($_POST['apellido']);
            $cedula = ucfirst($_POST['cedula']);
            $telefono = ucfirst($_POST['telefono']);
            $correo = ucfirst($_POST['correo']);
            $sexo = ucfirst($_POST['sexo']);
            $direccion = ucfirst($_POST['direccion']);
            $f_nacimiento = ucfirst($_POST['f_nacimiento']);
            $estatus = ucfirst($_POST['estatus']);
            
            
            

            $personascontroller = new PersonasController();

            // Verificar si la persona ya existe
            $existepersonas = $personascontroller->verificarPersonaExistente($cedula);

            if ($existepersonas) {
                echo "<script> alert ('Error: La Persona ya existe.')</script>";
            } else {
                $resultado = $personascontroller->crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus,);

                if ($resultado) {
                    echo "<script> alert '(Error: Persona guardada exitosamente.)'</script>";
                     header("Location: PersonasIndex.php"); 
                } else {
                    echo "Error al crear la persona.";
                }
            }
        }
        
     ?>


    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

        <center><h1>Crear Persona</h1></center>

        <form method="POST">

            <div class="form-floating mb-3">
            <input class="form-control" type="text" name="nombre" id="nombre" required>
            <label  for="nombre">Nombre:</label>
            </div>


            <div class="form-floating mb-3">
                <input class="form-control " type="text" name="apellido" id="apellido" required>
                <label  for="apellido">Apellido:</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control " type="text" name="cedula" id="cedula" required>
                <label  for="cedula">Cedula:</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control " type="text" name="telefono" id="telefono" required>
                <label  for="telefono">Telefono:</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control " type="text" name="correo" id="correo" required>
                <label  for="correo">Correo:</label>
            </div>

            <div class="form-floating mb-3">

                <div class="form-floating mb-3">
                <p>Sexo:</p>
                </div>

                <div class="form-check">
                <input class="form-check-input" type="radio" id="masculino" name="sexo" value="1">
                <label class="form-check-label" for="masculino">Masculino</label>
                </div>

                <div class="form-check">
                <input class="form-check-input" type="radio" id="femenino" name="sexo" value="0">
                <label class="form-check-label" for="femenino">Femenino</label>
                </div>
            
            </div>

            <div class="form-floating mb-3">
                <input class="form-control " type="text" name="direccion" id="direccion" required>
                <label  for="direccion">Direccion:</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control " type="date" name="f_nacimiento" id="f_nacimiento" required>
                <label  for="f_nacimiento">Fecha Nacimiento:</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" name="estatus" id="estatus">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                <label  for="estatus">Estatus:</label>                    
            </div>

            <div class="form-floating mb-3">
                <button class="btn btn-outline-success" type="submit">Crear Persona. <i class="fa fa-check"></i></button>
                <a class="btn btn-outline-info" href="PersonasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>

        </form>
        
    </div>    
</div>
    <!-- libreries JS -->
<script src="dist/js/jquery-3.7.1.min.js"></script>
        <script src="dist/plantilla/lib/bootstrap.bundle.min.js"></script>
            <script src="dist/plantilla/lib/chart/chart.min.js"></script>
                <script src="dist/plantilla/lib/easing/easing.min.js"></script>
                    <script src="dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                <script src="dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
        <script src="dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="dist/plantilla/js/main.js"></script>
        <script src="dist/js/buscar.js"></script>
    <script src="dist/js/validarpersona.js"></script>
    <script src="dist/js/validacionseguridad.js"></script>
</body>
</html>
