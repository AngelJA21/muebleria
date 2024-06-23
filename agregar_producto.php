<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

$alert = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $proveedor = $_POST["proveedor"];
    $precio = $_POST["precio"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];

    // Procesar la imagen
    $imagen = $_FILES["imagen"]["name"];
    $temp_name = $_FILES["imagen"]["tmp_name"];
    $folder = "uploads/";

    // Mover la imagen a la carpeta de destino
    if (move_uploaded_file($temp_name, $folder . $imagen)) {
        // Insertar datos en la base de datos
        $query_insert = "INSERT INTO productos (nombre, descripcion, proveedor, precio, tipo, cantidad_disponible, imagen) VALUES ('$nombre', '$descripcion', '$proveedor', '$precio', '$tipo', '$cantidad', '$imagen')";
        if (mysqli_query($conexion, $query_insert)) {
            $alert = '<div class="alert alert-success" role="alert">
                        Producto agregado con éxito.
                      </div>';
            // Limpiar los campos después de agregar el producto
            $nombre = $descripcion = $proveedor = $precio = $tipo = $cantidad = "";
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                        Error al agregar el producto: ' . mysqli_error($conexion) . '
                      </div>';
        }
    } else {
        $alert = '<div class="alert alert-danger" role="alert">
                    Error al subir la imagen.
                  </div>';
    }
}

// Cerrar conexión
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR PRODUCTO</title>
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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .formulario {
            background-color: rgba(200, 162, 200, 0.9); /* Color lila pastel con más transparencia */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Sombra */
            width: 400px;
            max-width: 90%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 2px solid #6c757d; /* Borde del campo de entrada */
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }

        .btn-primary {
            background-color: #6c757d; /* Color de fondo del botón */
            border: 2px solid #6c757d; /* Borde del botón */
            color: white; /* Color del texto */
        }

        .btn-primary:hover {
            background-color: #495057; /* Cambio de color al pasar el cursor sobre el botón */
            border-color: #495057; /* Cambio de color del borde al pasar el cursor sobre el botón */
        }

        .btn-secondary {
            background-color: #ffffff; /* Color de fondo del botón secundario */
            border: 2px solid #6c757d; /* Borde del botón secundario */
            color: #6c757d; /* Color del texto del botón secundario */
        }

        .btn-secondary:hover {
            background-color: #f8f9fa; /* Cambio de color al pasar el cursor sobre el botón secundario */
            border-color: #495057; /* Cambio de color del borde al pasar el cursor sobre el botón secundario */
            color: #495057; /* Cambio de color del texto al pasar el cursor sobre el botón secundario */
        }
    </style>
</head>
<body>
    <div class="formulario">
        <h2 style="text-align: center;">AGREGAR PRODUCTO</h2>
        <?php echo $alert; ?>
        <form id="productForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="proveedor">Proveedor:</label>
                <input type="text" name="proveedor" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" class="form-control" required>
                    <option value="cristaleria">Cristalería</option>
                    <option value="muebleria">Mueblería</option>
                    <option value="linea_blanca">Línea Blanca</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad Disponible:</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
</body>
</html>
