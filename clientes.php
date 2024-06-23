<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include_once "conexion.php"; // Verifica que la ruta al archivo de conexión sea correcta
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE CLIENTES</title>
    <style>
        body {
            background: url('PaginaMuebles/images/fondoagregar.jpg') no-repeat center center fixed; /* Imagen de fondo */
            background-size: cover; /* Ajustar el tamaño de la imagen de fondo para cubrir toda la página */
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco con transparencia */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .btn-custom-lilac {
            background: rgba(182, 102, 210, 0.6); /* Lila pastel con 60% de opacidad */
            border: 2px solid #800080; /* Borde morado */
            color: #ffffff; /* Texto blanco */
            padding: 8px 12px; /* Espaciado interno de los botones */
            margin-right: 10px; /* Espacio entre botones */
            transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transición suave de estilos */
        }

        .btn-custom-lilac:hover {
            background: rgba(182, 102, 210, 0.8); /* Lila pastel al pasar el mouse */
            border: 2px solid #4B0082; /* Borde más oscuro en hover */
        }

        .table-responsive {
            background: rgba(182, 102, 210, 0.4); /* Fondo lila pastel con 40% de opacidad */
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto; /* Agregar scroll horizontal si es necesario */
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .custom-table th {
            background-color: rgba(182, 102, 210, 0.8); /* Lila pastel con 80% de opacidad */
            color: white;
            text-align: center;
        }

        .custom-table td {
            text-align: center;
        }

        .thead-dark th {
            background-color: rgba(182, 102, 210, 0.8); /* Lila pastel con 80% de opacidad */
            color: white;
        }
    </style>
</head>
<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">LISTA DE CLIENTES</h1>
            <a href="index.php" class="btn btn-primary btn-custom-lilac float-right">Regresar</a> <!-- Botón de regreso -->
            <a href="agregar_cliente.php" class="btn btn-primary btn-custom-lilac">Nuevo</a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered custom-table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>DNI</th>
                                <th>NOMBRE</th>
                                <th>TELÉFONO</th>
                                <th>DIRECCIÓN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Verificar la conexión a la base de datos
                            if ($conexion) {
                                $query = mysqli_query($conexion, "SELECT * FROM cliente");
                                $result = mysqli_num_rows($query);
                                if ($result > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?php echo $data['idcliente']; ?></td>
                                            <td><?php echo $data['dni']; ?></td>
                                            <td><?php echo $data['nombre']; ?></td>
                                            <td><?php echo $data['telefono']; ?></td>
                                            <td><?php echo $data['direccion']; ?></td>
                                            <td>
                                                <a href="editar_cliente.php?id=<?php echo $data['idcliente']; ?>" class="btn btn-success btn-custom-lilac">Editar</a>
                                                <form action="eliminar_clientes.php" method="post" style="display: inline-block;">
                                                    <input type="hidden" name="id" value="<?php echo $data['idcliente']; ?>">
                                                    <button class="btn btn-danger btn-custom-lilac" type="submit">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    echo '<tr><td colspan="6">No se encontraron clientes.</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6">Error en la conexión a la base de datos.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</body>
</html>
