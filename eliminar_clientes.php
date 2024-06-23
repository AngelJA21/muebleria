<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include_once "conexion.php"; // Verifica que la ruta al archivo de conexión sea correcta

// Definir variables para mensaje y tipo de alerta
$message = "";
$type = "";

// Verificar si se recibió el parámetro del ID del cliente a eliminar
if(isset($_POST['id'])) {
    // Obtener el ID del cliente desde el formulario
    $id_cliente = $_POST['id'];

    // Realizar la consulta para eliminar el cliente
    $query_eliminar = mysqli_query($conexion, "DELETE FROM cliente WHERE idcliente = $id_cliente");

    // Verificar si se pudo eliminar el cliente correctamente
    if($query_eliminar) {
        $message = "Cliente eliminado correctamente";
        $type = "success";
    } else {
        $message = "Error al eliminar el cliente";
        $type = "error";
    }
} else {
    $message = "ID de cliente no especificado";
    $type = "error";
}

// Mostrar el mensaje utilizando JavaScript
echo '<script>';
echo 'alert("' . $message . '");';
echo 'window.history.go(-1);'; // Volver a la página anterior
echo '</script>';
?>
