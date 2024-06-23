<?php
include_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Consulta para obtener los detalles del producto por su ID
    $query = "SELECT * FROM productos WHERE id = '$id_producto'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $producto = mysqli_fetch_assoc($resultado);
        // Convertir a JSON y enviar respuesta
        echo json_encode($producto);
    } else {
        // Si no se encuentra el producto, enviar error
        echo json_encode(['error' => 'Producto no encontrado']);
    }
} else {
    // Si no se reciben datos por POST, enviar error
    echo json_encode(['error' => 'Petición no válida']);
}
?>
