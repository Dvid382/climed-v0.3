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
<?php include('../dist/Plantilla.php'); ?>
</head>
    <body>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

                <?php
                    require_once('../controlador/PatologiasController.php');

                    // Crear una instancia de rolcontroller
                    $patologiascontroller = new PatologiasController();

                    // Verificar si se recibió el ID del Rol a editar
                    if (isset($_GET['id'])) {
                        $patologiaId = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $patologia = $patologiascontroller->verPorId($patologiaId);
                        
                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['valor']) && isset($_POST['descripcion']) && isset($_POST['alerta'])) {
                            $nuevoNombre = $_POST['nombre'];
                            $nuevoEstado = $_POST['estado'];
                            $nuevoValor = $_POST['valor'];
                            $nuevoDescripcion = $_POST['descripcion'];
                            $nuevoAlerta = $_POST['alerta'];
                            

                            // Actualizar los datos del Rol con los nuevos valores
                            $patologiascontroller->modificar($patologiaId, $nuevoNombre, $nuevoEstado, $nuevoValor, $nuevoDescripcion, $nuevoAlerta);
                            
                            exit();
                        }
                    }
                ?>

                <center><h1>Editar Patologia</h1></center>
                <form method="POST">

                <div class="form-floating mb-3">  
                    <input class="form-control " type="text" name="nombre" id="nombre" value="<?php echo $patologia['nombre']; ?> ">
                    <label  for="nombre">Nombre:</label>
                </div>

                <div class="form-floating mb-3">  
                <input type="hidden" class="form-control" name="estado" id="estado" value="1">
                </div>

                <div class="form-floating mb-3">  
                    <select class="form-select" name="valor" id="valor">
                    <?php if ($patologia['valor'] == 1) {
                    echo' <option value="1">Enfermedades infecciosas</option>';
                    echo '<option value="2">Enfermedades no infecciosas</option>';
                    echo' <option value="3">Traumatismos</option>';
                    echo' <option value="4">Enfermedades congénitas</option>';
                    echo' <option value="5">Trastornos mentales</option>';
                        } else {
                            if ($patologia['valor'] == 2) {
                                echo' <option value="2">Enfermedades no infecciosas</option>';
                                echo '<option value="1">Enfermedades infecciosas</option>';
                                echo' <option value="3">Traumatismos</option>';
                                echo' <option value="4">Enfermedades congénitas</option>';
                                echo' <option value="5">Trastornos mentales</option>';
                                } else {
                                        if ($patologia['valor'] == 3) {
                                            echo' <option value="3">Traumatismos</option>';
                                            echo '<option value="1">Enfermedades infecciosas</option>';
                                            echo' <option value="2">Enfermedades no infecciosas</option>';
                                            echo' <option value="4">Enfermedades congénitas</option>';
                                            echo' <option value="5">Trastornos mentales</option>';
                                } else{
                                    if ($patologia['valor'] == 4) {
                                        echo' <option value="4">Enfermedades congénitas</option>';
                                        echo '<option value="1">Enfermedades infecciosas</option>';
                                        echo' <option value="2">Enfermedades no infecciosas</option>';
                                        echo' <option value="3">Traumatismos</option>';
                                        echo' <option value="5">Trastornos mentales</option>';
                        } else{
                            if ($patologia['valor'] == 5) {
                                echo' <option value="5">Trastornos mentales</option>';
                                echo '<option value="1">Enfermedades infecciosas</option>';
                                echo' <option value="2">Enfermedades no infecciosas</option>';
                                echo' <option value="3">Traumatismos</option>';
                                echo' <option value="4">Enfermedades congénitas</option>';
                                }
                    }}}}                       
                    ?>
                    </select>
                    <label  for="valor">Taxonomía de patologías:</label> 
                </div>

                <div class="form-floating mb-3">  
                    <input class="form-control " type="text" name="descripcion" id="descripcion" value="<?php echo $patologia['descripcion']; ?> ">
                    <label  for="nombre">Descripcion:</label>  
                </div>

                <div class="col-sm-10">
                <label>Alerta Epidemiologica</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="alerta" id="alerta-positivo" value="1" checked="">
                        <label class="form-check-label" for="alerta">
                            Positivo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="alerta" id="alerta-negativo" value="0">
                        <label class="form-check-label" for="alerta">
                            Negativo
                        </label>
                    </div>
            </div>

                <div class="form-floating mb-3">  
                    <button class="btn btn-outline-success" type="submit">Guardar patologia <i class="fa fa-check"></i></button>
                    <a class="btn btn-outline-info" href="PatologiasIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
                </div>
                </form>
                

            </div>
        </div>
        <!-- libreries JS -->
    <script src="../dist/js/jquery-3.7.1.min.js"></script>
            <script src="../dist/plantilla/lib/bootstrap.bundle.min.js"></script>
                <script src="../dist/plantilla/lib/chart/chart.min.js"></script>
                    <script src="../dist/plantilla/lib/easing/easing.min.js"></script>
                        <script src="../dist/plantilla/lib/waypoints/waypoints.min.js"></script>
                    <script src="../dist/plantilla/lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="../dist/plantilla/lib/tempusdominus/js/moment.min.js"></script>
            <script src="../dist/plantilla/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="../dist/plantilla/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="../dist/js/LimpiarInput.js"></script>
        <script src="../dist/plantilla/js/main.js"></script>
            <script src="../dist/js/buscar.js"></script>
        <script src="../dist/js/validaciongenerica.js"></script>
        <script src="../dist/js/validacionseguridad.js"></script>
    </body>
</html>
