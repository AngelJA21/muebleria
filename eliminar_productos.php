<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se recibió el parámetro ID a través de GET
if (isset($_GET['id'])) {
    // Sanitizar y asegurar el ID del producto
    $id = mysqli_real_escape_string($conexion, $_GET['id']);

    // Consulta SQL para eliminar el producto
    $query = "DELETE FROM productos WHERE id = '$id'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        // Éxito al eliminar el producto
        echo "Producto eliminado correctamente.";
        // Redireccionar a la página principal o a donde sea necesario
        header("Location: index.php");
        exit();
    } else {
        // Error al ejecutar la consulta
        echo "Error al intentar eliminar el producto: " . mysqli_error($conexion);
    }
} else {
    // Si no se proporcionó el ID, mostrar un mensaje de error
    echo "No se proporcionó un ID válido para eliminar el producto.";
}
?>
