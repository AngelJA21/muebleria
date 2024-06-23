<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se ha enviado un ID válido para eliminar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del proveedor a eliminar
    $id = $_GET['id'];

    // Consulta SQL para eliminar el proveedor
    $query = "DELETE FROM proveedores WHERE codproveedor = '$id'";
    $result = mysqli_query($conexion, $query);

    // Verificar si la eliminación fue exitosa
    if ($result) {
        // Redirigir de vuelta a la lista de proveedores con un mensaje de éxito
        header("Location: proveedores.php?deleted=1");
        exit();
    } else {
        // Redirigir de vuelta a la lista de proveedores con un mensaje de error
        header("Location: proveedores.php?error=1");
        exit();
    }
} else {
    // Redirigir de vuelta a la lista de proveedores si no se proporcionó un ID válido
    header("Location: proveedores.php");
    exit();
}
?>
