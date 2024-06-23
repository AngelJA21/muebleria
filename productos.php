<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Consulta a la base de datos para obtener los productos
$query = "SELECT * FROM productos";
$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTOS</title>
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
            justify-content: flex-start;
            min-height: 100vh;
        }

        #contenido {
            background-color: rgba(200, 162, 200, 0.9); /* Color lila pastel con más transparencia */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Sombra */
            width: 95%; /* Aumentamos el ancho al 95% */
            max-width: 1200px; /* Ajustamos el ancho máximo */
            margin-top: 20px;
            overflow-x: auto; /* Agregamos scroll horizontal si la tabla se desborda */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px; /* Incrementamos el padding para mejor distribución */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            display: block; /* Aseguramos que la imagen se muestre correctamente */
            margin: 0 auto; /* Centramos la imagen dentro de su celda */
        }

        .cantidad {
            width: 80px; /* Ancho específico para la columna de cantidad disponible */
        }

        .acciones {
            white-space: nowrap; /* Evitamos que los enlaces se dividan en varias líneas */
            text-align: center; /* Centramos los enlaces de acciones */
        }

        .editar, .borrar {
            background-color: #6c757d; /* Color de fondo de los botones */
            color: white; /* Color del texto */
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 5px; /* Espaciado entre botones */
            display: inline-block; /* Alineamos los botones en línea */
        }

        .editar:hover, .borrar:hover {
            background-color: #495057; /* Cambio de color al pasar el cursor sobre los botones */
        }

        .titulo {
            text-align: center;
            margin-bottom: 20px;
        }

        .regresar {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #6c757d;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2 class="titulo">LISTA DE PRODUCTOS</h2>
    <a href="index.php" class="regresar">Regresar</a>
    <div id="contenido">
        <div class="tabla-container"> <!-- Agregamos un contenedor para la tabla -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th class="cantidad">Cantidad Disponible</th> <!-- Añadimos la clase para controlar el ancho -->
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['proveedor']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['tipo']; ?></td>
                            <td><?php echo $row['cantidad_disponible']; ?></td>
                            <td><img src="uploads/<?php echo $row['imagen']; ?>" alt="Imagen del producto"></td>
                            <td class="acciones">
                                <a href="editar_producto.php?id=<?php echo $row['id']; ?>" class="editar">Editar</a>
                                <a href="eliminar_productos.php?id=<?php echo $row['id']; ?>" class="borrar">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
