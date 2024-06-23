<?php
include_once "conexion.php";

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    
    // Actualizar el producto en la base de datos
    $query = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', proveedor='$proveedor', precio='$precio', tipo='$tipo', cantidad_disponible='$cantidad_disponible' WHERE id=$id";
    $result = mysqli_query($conexion, $query);
    
    if ($result) {
        // Redirigir al usuario a la lista de productos después de la actualización
        header("Location: productos.php");
        exit;
    } else {
        // Manejar el caso en que ocurra un error durante la actualización
        echo "Error al actualizar el producto.";
    }
}

// Obtener el ID del producto a editar de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para obtener los detalles del producto
    $query = "SELECT * FROM productos WHERE id=$id";
    $result = mysqli_query($conexion, $query);

    // Verificar si la consulta fue exitosa y obtener los detalles del producto
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No se encontró el producto.";
        exit; // Terminar la ejecución del script si no se encontró el producto
    }
} else {
    echo "ID de producto no especificado.";
    exit; // Terminar la ejecución del script si no se especificó el ID del producto en la URL
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR PRODUCTO</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('PaginaMuebles/images/fondoagregar.jpg'); /* Ruta de tu imagen de fondo */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        form {
            background-color: rgba(200, 162, 200, 0.8); /* Lila pastel con transparencia */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Sombra */
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: rgba(182, 102, 210, 0.8); /* Lila pastel con transparencia */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: rgba(182, 102, 210, 1); /* Lila pastel al pasar el mouse */
        }

        .regresar {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #333; /* Cambia el color del texto si lo deseas */
        }

        h2 {
            text-align: center;
            margin-top: 0;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <h2>EDITAR PRODUCTOS</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $row['descripcion']; ?></textarea><br>
        <label for="proveedor">Proveedor:</label>
        <input type="text" id="proveedor" name="proveedor" value="<?php echo $row['proveedor']; ?>" required><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo $row['precio']; ?>" required><br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo $row['tipo']; ?>" required><br>
        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" id="cantidad_disponible" name="cantidad_disponible" value="<?php echo $row['cantidad_disponible']; ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="productos.php" class="regresar">Regresar</a>
</body>
</html>
