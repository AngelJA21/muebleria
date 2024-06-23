<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE PROVEEDORES</title>
    <style>
        body {
            background-image: url('PaginaMuebles/images/fondoagregar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0; /* Agregar margen cero para ocupar todo el espacio */
        }

        .header {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            background-color: rgba(229, 204, 255, 0.8);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: rgba(150, 107, 159, 0.8);
            color: white;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .btn-agregar {
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

        .btn-agregar:hover {
            background-color: #9370db;
        }

        .btn-regresar {
            position: absolute;
            top: 20px;
            right: 20px;
            display: block;
            width: 120px;
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

        .center {
            text-align: center;
            margin-top: 20px;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            margin-right: 5px;
            color: white;
            text-decoration: none;
            background-color: rgba(138, 43, 226, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: rgba(147, 112, 219, 0.7);
        }
    </style>
</head>
<body>
    <h1 class="header">LISTA DE PROVEEDORES</h1> <!-- Agregar título -->
    <?php
    // Incluir archivo de conexión a la base de datos
    include_once "conexion.php";

    // Consulta SQL para obtener la lista de proveedores
    $query = "SELECT * FROM proveedores";
    $result = mysqli_query($conexion, $query);
    ?>

    <table>
        <thead>
            <tr>
                <th>Código Proveedor</th>
                <th>Proveedor</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th class="actions">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar datos en la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['codproveedor'] . "</td>";
                echo "<td>" . $row['proveedor'] . "</td>";
                echo "<td>" . $row['contacto'] . "</td>";
                echo "<td>" . $row['teléfono'] . "</td>";
                echo "<td>" . $row['dirección'] . "</td>";
                echo "<td class='actions'>
                        <a href='eliminar_proveedores.php?id=" . $row['codproveedor'] . "' class='delete'>Eliminar</a>
                        <a href='editar_proveedores.php?id=" . $row['codproveedor'] . "' class='edit'>Editar</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="btn-regresar">Regresar</a>

</body>
</html>
