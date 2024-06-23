<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO PROVEEDOR</title>
    <style>
        body {
            background-image: url('PaginaMuebles/images/fondoagregar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Agregar margen cero para ocupar todo el espacio */
        }

        .card {
            background-color: rgba(229, 204, 255, 0.8);
            border-radius: 10px;
            width: 400px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            position: relative; /* Agregar posición relativa para el posicionamiento absoluto del botón */
        }

        .card-header {
            background-color: rgba(150, 107, 159, 0.8);
            text-align: center;
            color: white;
            font-size: 24px;
            padding: 10px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: #4b0082;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 40px); /* Reducir el ancho para evitar que los bordes se salgan del formulario */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #8a2be2;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #9370db;
        }

        .btn-danger {
            background-color: #8a2be2;
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background-color: #9370db;
        }

        .alert {
            margin-bottom: 20px; /* Agregar espacio debajo de la alerta */
        }

        /* Estilos para el botón Regresar */
        .btn-regresar {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";

$alert = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos del formulario
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['teléfono']) || empty($_POST['dirección'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                        Todos los campos son obligatorios
                    </div>';
    } else {
        // Obtener datos del formulario
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $teléfono = $_POST['teléfono'];
        $dirección = $_POST['dirección'];

        // Verificar si el contacto ya está registrado
        $query = mysqli_query($conexion, "SELECT * FROM proveedores where contacto = '$contacto'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El contacto ya está registrado
                    </div>';
        } else {
            // Insertar datos en la base de datos
            $query_insert = mysqli_query($conexion, "INSERT INTO proveedores(proveedor, contacto, teléfono, dirección) values ('$proveedor', '$contacto', '$teléfono', '$dirección')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Proveedor registrado exitosamente
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                           Error al registrar proveedor
                        </div>';
            }
        }
    }
}
// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>

<div class="card">
    <div class="card-header">
        Registro de Proveedor
    </div>
    <div class="card-body">
        <form action="" autocomplete="off" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
                <label for="nombre">Proveedor</label>
                <input type="text" placeholder="Ingrese proveedor" name="proveedor" id="nombre">
            </div>
            <div class="form-group">
                <label for="contacto">Contacto</label>
                <input type="text" placeholder="Ingrese nombre del contacto" name="contacto" id="contacto">
            </div>
            <div class="form-group">
                <label for="teléfono">Teléfono</label>
                <input type="number" placeholder="Ingrese teléfono" name="teléfono" id="teléfono">
            </div>
            <div class="form-group">
                <label for="dirección">Dirección</label>
                <input type="text" placeholder="Ingrese Dirección" name="dirección" id="dirección">
            </div>
            <div class="text-center">
                <input type="submit" value="Guardar Proveedor" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<div class="btn-regresar">
    <a href="proveedores.php" class="btn btn-primary">Regresar</a>
</div>

</body>
</html>
