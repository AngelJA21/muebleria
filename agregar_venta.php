<?php
session_start();
include_once "conexion.php";

$alertaDNIIncorrecto = false; // Variable para controlar la alerta de DNI incorrecto

// Handle AJAX request for product search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $query_producto = "SELECT * FROM productos WHERE id = '$id_producto'";
    $resultado_producto = mysqli_query($conexion, $query_producto);

    if (mysqli_num_rows($resultado_producto) > 0) {
        $producto = mysqli_fetch_assoc($resultado_producto);
        echo json_encode($producto);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
    exit;
}

$cliente = null;
$productos_seleccionados = [];
$precio_total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dni_cliente'])) {
    $dni_cliente = $_POST['dni_cliente'];
    $query_cliente = "SELECT * FROM cliente WHERE dni = '$dni_cliente'";
    $resultado_cliente = mysqli_query($conexion, $query_cliente);

    if (mysqli_num_rows($resultado_cliente) > 0) {
        $cliente = mysqli_fetch_assoc($resultado_cliente);
    } else {
        $alertaDNIIncorrecto = true; // Activar alerta si el DNI no se encuentra
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR VENTA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-image: url('PaginaMuebles/images/fondoagregar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            background-color: rgba(230, 220, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .table-lila {
            background-color: rgba(230, 220, 255, 0.7);
        }

        .thead-lila {
            background-color: #b39ddb;
            color: #fff;
        }

        .btn-lila {
            background-color: #b39ddb;
            color: #fff;
        }

        .btn-lila:hover {
            background-color: #9575cd;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .cliente-info {
            background-color: rgba(230, 220, 255, 0.7);
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
            color: #000;
        }

        .title {
            text-transform: uppercase;
            color: #000;
            font-weight: bold;
        }

        .btn-remove-producto {
            background-color: #d1c4e9;
            color: #333;
        }

        .btn-remove-producto:hover {
            background-color: #b39ddb;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4 title">AGREGAR VENTA</h2>
        <div class="row mb-4">
            <div class="col-lg-6">
                <form action="agregar_venta.php" method="post">
                    <div class="form-group">
                        <label for="dni_cliente" class="title">Ingrese DNI del Cliente:</label>
                        <input type="text" id="dni_cliente" name="dni_cliente" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-lila btn-block">Buscar Cliente</button>
                    </div>
                </form>
                <?php if ($alertaDNIIncorrecto): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        El DNI ingresado es incorrecto. Por favor, verifique.
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if ($cliente): ?>
                    <div class="cliente-info">
                        <h4 class="text-center title">Datos del Cliente</h4>
                        <p><strong>ID Cliente:</strong> <?php echo $cliente['idcliente']; ?></p>
                        <p><strong>Nombre:</strong> <?php echo $cliente['nombre']; ?></p>
                        <p><strong>Teléfono:</strong> <?php echo $cliente['telefono']; ?></p>
                        <p><strong>Dirección:</strong> <?php echo $cliente['direccion']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <hr>

        <?php if ($cliente): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-center title">Datos de la Venta</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-lila">
                            <thead class="thead-lila">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Precio Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="detalle_venta">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right"><strong>Total:</strong></td>
                                    <td id="total_venta">$ 0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <form id="form_agregar_producto" class="mt-4">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="id_producto" class="title">ID Producto:</label>
                                    <input type="text" class="form-control" id="id_producto" name="id_producto" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="cantidad_producto" class="title">Cantidad:</label>
                                    <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" min="1" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-lila btn-block mt-4"><i class="fas fa-plus"></i> Agregar Producto</button>
                            </div>
                        </div>
                    </form>

                    <form id="form_generar_pdf" action="generar_pdf_venta.php" method="post" target="_blank">
                        <input type="hidden" id="datos_venta" name="datos_venta" value="">
                        <button type="submit" class="btn btn-lila btn-block mt-4"><i class="fas fa-file-pdf"></i> Generar PDF de Venta</button>
                    </form>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="index.php" class="btn btn-lila btn-block mt-4"><i class="fas fa-arrow-left"></i> Regresar a Inicio</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        $(document).ready(function () {
            let productosSeleccionados = [];

            function actualizarTablaProductos() {
                let html = '';
                let total = 0;

                productosSeleccionados.forEach((producto, index) => {
                    html += `<tr>
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td>${producto.descripcion}</td>
                                <td>${producto.tipo}</td>
                                <td>${producto.cantidad}</td>
                                <td>${producto.precio}</td>
                                <td>${producto.subtotal}</td>
                                <td><button class='btn btn-remove-producto btn-sm' data-index='${index}'><i class='fas fa-trash'></i> Eliminar</button></td>
                            </tr>`;
                    total += parseFloat(producto.subtotal);
                });

                $('#detalle_venta').html(html);
                $('#total_venta').text(`$ ${total.toFixed(2)}`);

                $('#datos_venta').val(JSON.stringify({
                    productos_seleccionados: productosSeleccionados,
                    cliente_nombre: '<?php echo $cliente['nombre']; ?>',
                    precio_total: total.toFixed(2)
                }));
            }

            $('#form_agregar_producto').submit(function (event) {
                event.preventDefault();
                const id_producto = $('#id_producto').val();
                const cantidad_producto = $('#cantidad_producto').val();

                $.ajax({
                    url: 'agregar_venta.php',
                    method: 'POST',
                    data: { id_producto: id_producto },
                    success: function (response) {
                        const producto = JSON.parse(response);

                        if (producto.error) {
                            alert(producto.error);
                        } else {
                            const subtotal = producto.precio * cantidad_producto;
                            productosSeleccionados.push({
                                id: producto.id,
                                nombre: producto.nombre,
                                descripcion: producto.descripcion,
                                tipo: producto.tipo,
                                cantidad: cantidad_producto,
                                precio: producto.precio,
                                subtotal: subtotal.toFixed(2)
                            });
                            actualizarTablaProductos();
                        }
                    },
                    error: function () {
                        alert('Error al agregar el producto. Intente nuevamente.');
                    }
                });
            });

            $(document).on('click', '.btn-remove-producto', function () {
                const index = $(this).data('index');
                productosSeleccionados.splice(index, 1);
                actualizarTablaProductos();
            });
        });
    </script>
</body>
</html>
