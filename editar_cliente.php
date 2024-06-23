<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include_once "conexion.php"; // Verifica que la ruta al archivo de conexión sea correcta

// Variables iniciales para los datos del cliente
$dni = '';
$nombre = '';
$telefono = '';
$direccion = '';

// Verificar si se recibió el parámetro del ID del cliente a editar
if(isset($_GET['id'])) {
    // Obtener el ID del cliente desde la URL
    $id_cliente = $_GET['id'];

    // Realizar una consulta para obtener los datos del cliente
    $query_cliente = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $id_cliente");

    // Verificar si se encontraron datos del cliente
    if(mysqli_num_rows($query_cliente) == 1) {
        // Obtener los datos del cliente de la consulta
        $cliente = mysqli_fetch_assoc($query_cliente);

        // Asignar los datos del cliente a las variables
        $dni = $cliente['dni'];
        $nombre = $cliente['nombre'];
        $telefono = $cliente['telefono'];
        $direccion = $cliente['direccion'];

        // Verificar si se ha enviado el formulario para actualizar los datos del cliente
        if(isset($_POST['submit'])) {
            // Obtener los nuevos datos del formulario
            $nuevo_dni = $_POST['dni'];
            $nuevo_nombre = $_POST['nombre'];
            $nuevo_telefono = $_POST['telefono'];
            $nueva_direccion = $_POST['direccion'];

            // Actualizar los datos del cliente en la base de datos
            $query_actualizar = mysqli_query($conexion, "UPDATE cliente SET dni = '$nuevo_dni', nombre = '$nuevo_nombre', telefono = '$nuevo_telefono', direccion = '$nueva_direccion' WHERE idcliente = $id_cliente");

            // Verificar si la actualización fue exitosa
            if($query_actualizar) {
                echo '<div class="alert alert-success" role="alert">Cliente actualizado correctamente</div>';
                // Actualizar los valores en las variables
                $dni = $nuevo_dni;
                $nombre = $nuevo_nombre;
                $telefono = $nuevo_telefono;
                $direccion = $nueva_direccion;
            } else {
                echo '<div class="alert alert-danger" role="alert">Error al actualizar el cliente</div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">No se encontró el cliente</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">ID de cliente no especificado</div>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <style>
        body {
            background-image: url('PaginaMuebles/images/fondoagregar.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' por la ruta de tu imagen */
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(182, 102, 210, 0.8); /* Lila pastel con 80% de opacidad */
            padding: 20px;
            border-radius: 10px;
            width: 400px; /* Ancho del formulario */
        }

        .form-group {
            margin-bottom: 20px; /* Espaciado entre elementos del formulario */
        }

        .btn-custom-lilac {
            background: rgba(182, 102, 210, 0.8); /* Lila pastel con 80% de opacidad */
            border: 2px solid #800080; /* Borde morado */
            color: #ffffff; /* Texto blanco */
            padding: 8px 12px; /* Espaciado interno de los botones */
            margin-right: 10px; /* Espacio entre botones */
            transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transición suave de estilos */
        }

        .btn-custom-lilac:hover {
            background: rgba(182, 102, 210, 1); /* Lila pastel al pasar el mouse */
            border: 2px solid #4B0082; /* Borde más oscuro en hover */
        }
    </style>
</head>
<body>
    <!-- Begin Page Content -->
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Editar Cliente</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($dni); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Actualizar" class="btn btn-primary btn-custom-lilac">
                <a href="clientes.php" class="btn btn-secondary btn-custom-lilac">Regresar</a>
            </div>
        </form>
    </div>
    <!-- /.container -->
</body>
</html>
