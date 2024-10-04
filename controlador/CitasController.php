<?php
require_once '../modelo/Citas.php';
require_once '../dist/PHPMailer/src/Exception.php';
require_once '../dist/PHPMailer/src/PHPMailer.php';
require_once '../dist/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CitasController {
    private $citasModelo;
    
   // Configuración de correo electrónico
   private $mail_host = 'smtp.office365.com';
   private $mail_username = 'climedY@hotmail.com';
   private $mail_password = '19063494B.';
   private $mail_port = 587; // o 465 si usas SSL/TLS
   private $mail_encryption = 'tls'; // o 'ssl' si usas SSL/TLS

    public function __construct() {
        $conexion = new Conexion();
        $this->citasModelo = new Citas($conexion->Conectar());
    }

    public function crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio) {
        if ($this->citasModelo->verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora)) {
            echo "<script>
            swal({
               title: 'Error',
               text: 'La cita ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'CitasCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        } else {
            if ($this->citasModelo->crearCitas($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion, $fk_consultorio)) {
                echo "<script>
                swal({
                   title: 'Completado',
                   text: 'Cita creada correctamente.',
                   icon: 'success',
                }).then((willRedirect) => {
                   if (willRedirect) {
                      window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
                   }
                });
             </script>";
                exit;
            } else {
                echo "<script>alert('Error al crear la cita.');</script>";
/*                 echo '<script>window.location="CitasCrear.php";</script>'; */
                exit;
            }
        }
    }
    
    

    public function modificar($id, $fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion) {
        $this->citasModelo->modificarCitas($id, $fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora, $estatus, $fk_usuario_sesion);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita modificada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
    }

    public function eliminar($id) {
        $this->citasModelo->eliminarCitas($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Cita eliminada correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'CitasIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el Asignaciones si es necesario
    }

public function EnviarCorreo($citaId)
{
    try {
        $citasModelo = new Citas();

        // Obtener los datos de la cita
        $cita = $citasModelo->obtenerInformacionCitasPorId($citaId);

        // Enviar el correo
        /*
        $to = strtolower($cita['correo_paciente']);
        $subject = "Asignacion de cita";
        $message = "Estimado(a) paciente " . $cita['nombre_paciente'] . " " . $cita['segundo_nombre_paciente'] . " " . $cita['apellido_paciente'] . " " . $cita['segundo_apellido_paciente'] . "  titular de la Cedula de identidad N°:" . $cita['cedula_paciente'] . ", usted tiene una cita programada para el dia " . $cita['fecha'] . " a las " . $cita['hora'] . ", con el doctor " . $cita['nombre_medico'] . " " . $cita['apellido_medico'] . ". Por favor confirmar el recibido, Feliz Dia!!";

        $mail = new PHPMailer(true);
        
        // Configuración del servidor SMTP
        $mail->SMTPDebug = 0; // Cambia a 2 para ver detalles de depuración
        $mail->isSMTP();
        $mail->Host = $this->mail_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->mail_username;
        $mail->Password = $this->mail_password;
        $mail->SMTPSecure = $this->mail_encryption;
        $mail->Port = $this->mail_port;

        // Configuración del correo
        $mail->setFrom($this->mail_username, 'Modulo Humberto Silva');
        $mail->addAddress($to);
        $mail->Subject = ucwords(strtolower($subject)); // Convierte el asunto a minúsculas y luego capitaliza la primera letra de cada palabra
        $mail->Body = strtolower($message); // Convierte el mensaje a minúsculas

        // Envío del correo
        if ($mail->send()) {
        */
            // Actualizar el estatus de la cita
            $citasModelo->actualizarEstatusCitaCorreo($citaId, 2);
    
 
        /*
        } else {
            // Mostrar alerta de error con SweetAlert si no se envió
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo no se pudo enviar. Intenta nuevamente.'
                    });
                </script>";
            return false;
        }
        */
    } catch (Exception $e) {
        // Mostrar alerta de error con SweetAlert incluyendo el mensaje de error
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al enviar el correo: " . addslashes($e->getMessage()) . "'
                });
            </script>";
        return false;
    }
}

    public function ConfirmarCorreo($citaId)
    {
      $citasModelo = new Citas();
      // Actualizar el estatus de la cita
      $citasModelo->actualizarEstatusConfirmarCorreo($citaId, 3);
      return true;
    }

    public function RestaurarCita($citaId)
    {
      $citasModelo = new Citas();
      // Actualizar el estatus de la cita
      $citasModelo->actualizarEstatusConfirmarCorreo($citaId, 1);
      return true;
    }
    



    public function index() {
        $citas = $this->citasModelo->obtenerInformacionCitas();
        return $citas;
    }
    public function indexTodas() {
        $citas = $this->citasModelo->obtenerInformacionTodasCitas();
        return $citas;
    }
    public function indexEnfermeria() {
      $citas = $this->citasModelo->obtenerInformacionCitasEnfermeria();
      return $citas;
  }
  public function indexMedico($usuario_id) {
   $citas = $this->citasModelo->obtenerInformacionCitasMedico($usuario_id);
   return $citas;
}
  public function indexHistoriasMedicas($usuario_id) {
   $citas = $this->citasModelo->obtenerInformacionHistoriasMedicas($usuario_id);
   return $citas;
}
    public function VerDatos($id) {
      $citas = $this->citasModelo->obtenerInformacionCitasPorId($id);
      return $citas;
  }

  public function VerDatosHistoriaMedica($idPaciente) {
    $modeloCitas = new Citas();
    $citasPaciente = $modeloCitas->obtenerHistoriaMedicaPorPaciente($idPaciente);
    
    if ($citasPaciente) {
        $historiaMedica = $modeloCitas->organizarCitasPorFecha($citasPaciente);
        
        // Obtener los datos del paciente de la primera cita (asumiendo que son los mismos para todas)
        $datosPaciente = $citasPaciente[0];
        
        return [
            'datos_paciente' => [
                'cedula_paciente' => $datosPaciente['cedula_paciente'],
                'nombre_paciente' => $datosPaciente['nombre_paciente'],
                'segundo_nombre_paciente' => $datosPaciente['segundo_nombre_paciente'],
                'apellido_paciente' => $datosPaciente['apellido_paciente'],
                'segundo_apellido_paciente' => $datosPaciente['segundo_apellido_paciente'],
                'fecha_nacimiento' => $datosPaciente['fecha_nacimiento'],
                'sexo' => $datosPaciente['sexo'],
            ],
            'historia_medica' => $historiaMedica
        ];
    } else {
        return false;
    }
}
    public function InformacionPacientes() {
        return $this->citasModelo->InformacionPacientes();
    }
    public function verTodas() {
        return $this->citasModelo->verTodasCitas();
    }

    public function verPorId($id) {
        return $this->citasModelo->verCitasId($id);
    }

    public function verCitasEnfermeriaPorId($id) {
        return $this->citasModelo->verCitasEnfermeriaPorId($id);
    }

      public function verCitasEnfermeriaMedicoPorId($id) {
        return $this->citasModelo->verCitasEnfermeriaMedicoPorId($id);
    }

    public function verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora) {
        return $this->citasModelo->verificarCitasExistentes($fk_persona, $fk_servicio, $fk_usuario, $fecha, $hora);
    }


}