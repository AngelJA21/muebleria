<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <style>
        body {
            background-image: url('PaginaMuebles/images/fondoagregar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(229, 204, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #8a2be2;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #9370db;
        }

        .center {
            text-align: center;
            margin-top: 20px;
        }

        .btn-regresar {
            display: block;
            width: 120px;
            margin: 20px auto;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #8a2be2;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .btn-regresar:hover {
            background-color: #9370db;
        }
    </style>
</head>
<body>
    <h1 class="header">EDITAR PROVEEDOR</h1>

    <?php
    // Incluir archivo de conexión a la base de datos
    include_once "conexion.php";

    // Variables para manejar los mensajes y la actualización
    $mensaje = '';

    // Verificar si se ha enviado un ID válido para editar
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
        // Obtener el ID del proveedor a editar
        $id = $_GET['id'];

        // Consulta SQL para obtener los datos del proveedor
        $query = "SELECT * FROM proveedores WHERE codproveedor = '$id'";
        $result = mysqli_query($conexion, $query);

        // Verificar si se encontró el proveedor
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            $mensaje = "<p class='center'>Proveedor no encontrado.</p>";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se ha enviado el formulario de actualización

        // Obtener los datos del formulario
        $id = $_POST['id'];
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $teléfono = $_POST['teléfono'];
        $dirección = $_POST['dirección'];

        // Consulta SQL para actualizar el proveedor
        $query = "UPDATE proveedores SET proveedor='$proveedor', contacto='$contacto', teléfono='$teléfono', dirección='$dirección' WHERE codproveedor='$id'";
        $result = mysqli_query($conexion, $query);

        // Verificar si la actualización fue exitosa
        if ($result) {
            $mensaje = "<p class='center'>Proveedor actualizado correctamente.</p>";
        } else {
            $mensaje = "<p class='center'>Error al actualizar el proveedor.</p>";
        }
    } else {
        $mensaje = "<p class='center'>ID de proveedor no proporcionado.</p>";
    }
    ?>

    <?php echo $mensaje; ?>

    <?php if (isset($row)) : ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['codproveedor']; ?>">
            <label for="proveedor">Proveedor:</label>
            <input type="text" id="proveedor" name="proveedor" value="<?php echo $row['proveedor']; ?>"><br>
            <label for="contacto">Contacto:</label>
            <input type="text" id="contacto" name="contacto" value="<?php echo $row['contacto']; ?>"><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="tel´rfono" name="teléfono" value="<?php echo $row['teléfono']; ?>"><br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="dirección" name="dirección" value="<?php echo $row['dirección']; ?>"><br>
            <input type="submit" value="Actualizar">
        </form>
    <?php endif; ?>

    <a href="proveedores.php" class="btn-regresar">Regresar</a>
</body>
</html>
