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
<?php include('../dist/Plantilla.php');?>
</head>
<body>
    <div class="container-fluid pt-4 px-4">

        <?php
            require_once '../controlador/MedicamentosController.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre_comercial = ucfirst($_POST['nombre_comercial']);
                $descripcion = ucfirst($_POST['descripcion']);
                $cantidad = ucfirst($_POST['cantidad']);
                $fk_unidadpeso = ucfirst($_POST['fk_unidadpeso']);
                $fk_tipo_medicamento = ucfirst($_POST['fk_tipo_medicamento']);
                $fk_unidadmedida = ucfirst($_POST['fk_unidadmedida']);
                $fk_componentesactivos = ucfirst($_POST['fk_componentesactivos']);
               
                
                

                $medicamentoscontroller = new MedicamentosController();

                // Verificar si el Medicamento ya existe
                $existemedicamentos = $medicamentoscontroller->verificarMedicamentosExistente($nombre_comercial);

                if ($existemedicamentos) {
                    echo "<script> alert ('Error: El Medicamento ya existe.')</script>";
                } else {
                    $resultado = $medicamentoscontroller->crear($nombre_comercial, $descripcion, $cantidad, $fk_componentesactivos, $fk_tipo_medicamento, $fk_unidadmedida, $fk_unidadpeso);

                    if ($resultado) {
                        echo "<script> alert '(Error: Estado creado exitosamente.)'</script>";
                        header("Location: MedicamentosIndex.php"); 
                    } else {
                        echo "Error al crear el Medicamento.";
                    }
                }
            }
            
        ?>

<div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">

            <center><h1>Crear medicamento</h1></center>

            <form method="POST" autocomplete="off">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="nombre_comercial" id="nombre_comercial" required>
        <label for="nombre_comercial">Nombre Comercial:</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Descripcion" id="descripcion" name="descripcion" style="height: 150px;" required></textarea>
        <label for="descripcion">Descripción:</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Cantidad" id="cantidad" name="cantidad" style="height: 150px;" required></textarea>
        <label for="cantidad">Cantidad:</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_unidadpeso" aria-label="Default select example" name="fk_unidadpeso" required>
            <option value="">Seleccione Unidad de Peso</option>
            <?php
                require_once '../controlador/UnidadPesosController.php';
                $UnidadPesosController = new UnidadPesosController();
                $unidadpesos = $UnidadPesosController->verTodos();

                foreach ($unidadpesos as $unidadpeso) {
                    echo "<option value='" . $unidadpeso['id'] . "'>" . $unidadpeso['nombre'] . "</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_componentesactivos" aria-label="Default select example" name="fk_componentesactivos" required>
            <option value="">Seleccione Componente Activo</option>
            <?php
                require_once '../controlador/ComponentesActivosController.php';
                $ComponentesActivosController = new ComponentesActivosController();
                $componentesactivos = $ComponentesActivosController->verTodos();

                foreach ($componentesactivos as $componenteactivo) {
                    echo "<option value='" . $componenteactivo['id'] . "'>" . $componenteactivo['nombre'] . "</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_tipo_medicamento" aria-label="Default select example" name="fk_tipo_medicamento" required>
            <option value="">Seleccione El tipo de Medicamento</option>
            <?php
                require_once '../controlador/Tipo_MedicamentosController.php';
                $Tipo_MedicamentosController = new Tipo_MedicamentosController();
                $tipo_medicamentos = $Tipo_MedicamentosController->verTodos();

                foreach ($tipo_medicamentos as $tipo_medicamento) {
                    echo "<option value='" . $tipo_medicamento['id'] . "'>" . $tipo_medicamento['nombre'] . "</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_unidadmedida" aria-label="Default select example" name="fk_unidadmedida" required>
            <option value="">Seleccione la Forma Farmacéutica</option>
            <?php
                require_once '../controlador/UnidadMedidasController.php';
                $UnidadMedidasController = new UnidadMedidasController();
                $unidadmedidas = $UnidadMedidasController->verTodos();

                foreach ($unidadmedidas as $unidadmedida) {
                    echo "<option value='" . $unidadmedida['id'] . "'>" . $unidadmedida['nombre'] . "</option>";
                }
            ?>
        </select>
    </div>


    <div class="form-floating mb-3">
        <button class="btn btn-outline-success" type="submit">Guardar medicamento. <i class="fa fa-check"></i></button>
        <a class="btn btn-outline-info" href="MedicamentosIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
    </div>
</form>
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
    <script src="../dist/plantilla/js/main.js"></script>
        <script src="../dist/js/buscar.js"></script>
      <!--   <script src="../dist/js/validaciongenerica.js"></script> -->
 <!--    <script src="../dist/js/validacionseguridad.js"></script> -->
</body>
</html>
