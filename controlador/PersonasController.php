<?php
require_once '../config/Conexion.php';
require_once '../modelo/Personas.php';

session_start();
class PersonasController  {
    private $personasModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->personasModelo = new Persona($conexion->conectar());
    }

    public function crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido) {
        if ($this->verificarPersonaExistente($cedula)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'La Personas ya existe.')</',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'personasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    
        $this->personasModelo->setId('id');
        $this->personasModelo->setNombre('nombre');
        $this->personasModelo->setApellido('apellido');
        $this->personasModelo->setCedula('cedula');
        $this->personasModelo->setTelefono('telefono');
        $this->personasModelo->setCorreo('correo');
        $this->personasModelo->setSexo('sexo');
        $this->personasModelo->setDireccion('direccion');
        $this->personasModelo->setF_nacimiento('f_nacimiento');
        $this->personasModelo->setEstatus('estatus');
        $this->personasModelo->setSegundo_nombre('segundo_nombre');
        $this->personasModelo->setSegundo_apellido('segundo_apellido');
        
    
        /* // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/PersonasFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino);
    
        // Asignar la nueva ruta de la foto
        $this->personasModelo->setFoto($rutaFotoDestino); */
    
        if ($this->personasModelo->crearPersona($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido)) {
            echo "<script>
            swal({
               title: 'Completado',
               text: 'Persona creada correctamente.',
               icon: 'success',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'personasIndex.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Error al crear la Persona.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'PersonasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
    }

    public function InsertarPersonaCitas($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido) {
      if ($this->verificarPersonaExistente($cedula)) {
          echo "<script>
          swal({
             title: 'Error',
             text: 'La Personas ya existe.')</',
             icon: 'error',
          }).then((willRedirect) => {
             if (willRedirect) {
                window.location.href = 'InsertarPersona.php'; // Redirige a tu página PHP
             }
          });
       </script>";
          exit;
      }
  
      $this->personasModelo->setId('id');
      $this->personasModelo->setNombre('nombre');
      $this->personasModelo->setApellido('apellido');
      $this->personasModelo->setCedula('cedula');
      $this->personasModelo->setTelefono('telefono');
      $this->personasModelo->setCorreo('correo');
      $this->personasModelo->setSexo('sexo');
      $this->personasModelo->setDireccion('direccion');
      $this->personasModelo->setF_nacimiento('f_nacimiento');
      $this->personasModelo->setEstatus('estatus');
      $this->personasModelo->setSegundo_nombre('segundo_nombre');
      $this->personasModelo->setSegundo_apellido('segundo_apellido');
      
  
      if ($this->personasModelo->InsertarPersonaCitas($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido)) {
         echo "<script>
         swal({
             title: 'Completado',
             text: 'Persona creada correctamente.',
             icon: 'success',
         }).then((willRedirect) => {
             if (willRedirect) {
                 window.location.href = 'CitasCrear.php?cedula=" . $cedula . "'; // Redirige a CitasCrear.php y pasa la cédula como parámetro
             }
         });
         </script>";
         exit;
      } else {
          echo "<script>
          swal({
             title: 'Error',
             text: 'Error al crear la Persona.',
             icon: 'error',
          }).then((willRedirect) => {
             if (willRedirect) {
                window.location.href = 'InsertarPersona.php'; // Redirige a tu página PHP
             }
          });
       </script>";
          exit;
      }
  }
    
  public function InsertarPersonaUsuario($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido) {
   if ($this->verificarPersonaExistente($cedula)) {
       echo "<script>
       swal({
          title: 'Error',
          text: 'La Personas ya existe.')</',
          icon: 'error',
       }).then((willRedirect) => {
          if (willRedirect) {
             window.location.href = 'InsertarPersona.php'; // Redirige a tu página PHP
          }
       });
    </script>";
       exit;
   }

   $this->personasModelo->setId('id');
   $this->personasModelo->setNombre('nombre');
   $this->personasModelo->setApellido('apellido');
   $this->personasModelo->setCedula('cedula');
   $this->personasModelo->setTelefono('telefono');
   $this->personasModelo->setCorreo('correo');
   $this->personasModelo->setSexo('sexo');
   $this->personasModelo->setDireccion('direccion');
   $this->personasModelo->setF_nacimiento('f_nacimiento');
   $this->personasModelo->setEstatus('estatus');
   $this->personasModelo->setSegundo_nombre('segundo_nombre');
   $this->personasModelo->setSegundo_apellido('segundo_apellido');
   

   if ($this->personasModelo->InsertarPersonaUsuario($nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus, $segundo_nombre, $segundo_apellido)) {
      echo "<script>
      swal({
          title: 'Completado',
          text: 'Persona creada correctamente.',
          icon: 'success',
      }).then((willRedirect) => {
          if (willRedirect) {
              window.location.href = 'UsuariosCrear.php?cedula=" . $cedula . "'; // Redirige a UsuariosCrear.php y pasa la cédula como parámetro
          }
      });
      </script>";
      exit;
   } else {
       echo "<script>
       swal({
          title: 'Error',
          text: 'Error al crear la Persona.',
          icon: 'error',
       }).then((willRedirect) => {
          if (willRedirect) {
             window.location.href = 'InsertarPersona.php'; // Redirige a tu página PHP
          }
       });
    </script>";
       exit;
   }
}
    
    public function eliminarPersona($id) {
        $this->personasModelo->eliminarPersona($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Persona eliminada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'personasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }
    
    public function modificarPersona($id, $nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento , $estatus, $segundo_nombre, $segundo_apellido) {
    
        $this->personasModelo->setId('id');
        $this->personasModelo->setNombre('nombre');
        $this->personasModelo->setApellido('apellido');
        $this->personasModelo->setCedula('cedula');
        $this->personasModelo->setTelefono('telefono');
        $this->personasModelo->setCorreo('correo');
        $this->personasModelo->setSexo('sexo');
        $this->personasModelo->setDireccion('direccion');
        $this->personasModelo->setF_nacimiento('f_nacimiento');
        $this->personasModelo->setEstatus('estatus');
        $this->personasModelo->setSegundo_nombre('segundo_nombre');
        $this->personasModelo->setSegundo_apellido('segundo_apellido');

        /* // Ruta de la carpeta de destino
        $carpetaDestino = '../vista/PersonasFoto/';
    
        // Verificar si la carpeta de destino no existe, crearla
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }
    
        // Mover la foto a la carpeta de destino
        $rutaFotoDestino = $carpetaDestino . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $rutaFotoDestino); */

        if ($this->personasModelo->modificarPersona($id, $nombre, $apellido, $cedula, $telefono, $correo, $sexo, $direccion, $f_nacimiento, $estatus,  $segundo_nombre, $segundo_apellido)) {
             echo "<script>
             swal({
                title: 'Completado',
                text: 'Persona modificada correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'personasIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            
            exit;

        } else {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Error al modificar a la Persona.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'EditarPersona.php?id='". $id."'; // Redirige a tu página PHP
               }
            });
         </script>";
            
            exit;
        }
    }
    
    

    //maneja el acceso a las vistas
    public function Vistas(){
        if (!isset($_SESSION['rol'])) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Usted debe iniciar sesión para acceder a esta página.',
               icon: 'warning',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = '../Index.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
        
        if ( $_SESSION['valor_rol']==false) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'Usted no tiene permiso para acceder a esta página.',
               icon: 'warning',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'Home.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        
        }
    }

    public function cerrarSesion() {
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        // Redirigir a la página de inicio de sesión
        header("Location: ../Index.php");
    }

    public function verTodosPersonas() {
        return $this->personasModelo->verTodosPersonas();
    }

    public function verPersonaPorId($id) {
        return $this->personasModelo->verPersonaPorId($id);
    }

    public function verPersonaPorCedula($cedula) {
        return $this->personasModelo->verPersonaPorCedula($cedula);
    }
    
    public function buscarPersonaPorNombre($nombre) {
        return $this->personasModelo->buscarPersonaPorNombre($nombre);
    }

    public function verificarPersonaExistente($nombre) {
        return $this->personasModelo->verificarPersonaExistente($nombre);
    }
}
