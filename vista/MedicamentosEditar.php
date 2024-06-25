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
    <div class="bg-white rounded h-25 p-4" style="width: 50%; margin:auto;">
                <center><h1>Editar medicamento</h1></center>

                <?php
                    require_once('../controlador/MedicamentosController.php');

                        // Crear una instancia de rolcontroller
                        $medicamentoscontroller = new MedicamentosController();

                        // Verificar si se recibió el ID del Rol a editar
                        if (isset($_GET['id'])) {
                        $medicamentoID = $_GET['id'];

                        // Obtener los datos del Rol con el ID proporcionado
                        $medicamento = $medicamentoscontroller->verPorId($medicamentoID);

                        // Verificar si se enviaron los datos actualizados del Rol
                        if (isset($_POST['nombre_comercial']) && isset($_POST['descripcion']) && isset($_POST['cantidad']) && isset($_POST['fk_componentesactivos']) && isset($_POST['fk_tipo_medicamento']) && isset($_POST['fk_unidadmedida']) && isset($_POST['fk_unidadpeso'])) {
                            $nuevoNombre_comercial = $_POST['nombre_comercial'];
                            $nuevoDescripcion = $_POST['descripcion'];
                            $nuevoCantidad = $_POST['cantidad'];
                            $nuevofk_componentesactivos = $_POST['fk_componentesactivos'];
                            $nuevofk_tipo_medicamento = $_POST['fk_tipo_medicamento'];
                            $nuevofk_unidadmedida = $_POST['fk_unidadmedida'];
                            $nuevofk_unidadpeso = $_POST['fk_unidadpeso'];


                            // Actualizar los datos del Rol con los nuevos valores
                            $medicamentoscontroller->modificar($medicamentoID, $nuevoNombre_comercial, $nuevoDescripcion, $nuevoCantidad, $nuevofk_componentesactivos, $nuevofk_tipo_medicamento, $nuevofk_unidadmedida, $nuevofk_unidadpeso);

                            exit();
                        }
                    }
                ?>

<form method="POST" autocomplete="off">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="nombre_comercial" id="nombre_comercial" value="<?php echo $medicamento['nombre_comercial']; ?>" required>
        <label for="nombre_comercial">Nombre Comercial:</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Descripcion" id="descripcion" name="descripcion" style="height: 150px;" value="<?php echo $medicamento['descripcion']; ?>" required><?php echo $medicamento['descripcion']; ?></textarea>
        <label for="descripcion">Descripción:</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Cantidad" id="cantidad" name="cantidad" style="height: 150px;" value="<?php echo $medicamento['cantidad']; ?>" required><?php echo $medicamento['cantidad']; ?></textarea>
        <label for="cantidad">Cantidad:</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="fk_unidadpeso" aria-label="Default select example" name="fk_unidadpeso" value="<?php echo $medicamento['fk_unidadpeso']; ?>" required>
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
        <select class="form-select" id="fk_componentesactivos" aria-label="Default select example" name="fk_componentesactivos" value="<?php echo $medicamento['fk_componentesactivos']; ?>" required>
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
        <select class="form-select" id="fk_tipo_medicamento" aria-label="Default select example" name="fk_tipo_medicamento" value="<?php echo $medicamento['fk_tipo_medicamentos']; ?>" required>
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
        <select class="form-select" id="fk_unidadmedida" aria-label="Default select example" name="fk_unidadmedida" value="<?php echo $medicamento['fk_unidadmedida']; ?>" required>
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
                <?php /* var_dump($nombre, $estatus, $valor, $descripcion ); */?>
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
