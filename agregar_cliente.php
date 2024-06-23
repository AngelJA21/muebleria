<?php
include_once "conexion.php"; // Incluye el archivo de conexión

$alert = "";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todos los campos son obligatorios
                                </div>';
    } else {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        // Verificar si el DNI ya existe en la base de datos
        $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE dni = '$dni'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            // Si el cliente ya existe, mostrar un mensaje de error
            $alert = '<div class="alert alert-danger" role="alert">
                                    El DNI ya está registrado para otro cliente
                                </div>';
        } else {
            // Insertar nuevo cliente en la base de datos
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni, nombre, telefono, direccion) values ('$dni', '$nombre', '$telefono', '$direccion')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Cliente registrado correctamente
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al guardar el cliente
                                </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="background-image: url('PaginaMuebles/images/fondoagregar.jpg'); background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div class="col-lg-8">
        <div class="card shadow mb-4" style="background-color: rgba(182, 102, 210, 0.6); font-family: Arial;">
            <div class="card-header py-3">
                <h1 class="h3 mb-0 text-gray-800">AGREGAR CLIENTE</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group mb-3">
                        <label for="dni">DNI</label>
                        <input type="text" placeholder="Ingrese DNI" name="dni" id="dni" class="form-control" onchange="buscarCliente()">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="telefono">Teléfono</label>
                        <input type="text" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" placeholder="Ingrese Dirección" name="direccion" id="direccion" class="form-control">
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Guardar Cliente" class="btn btn-primary btn-custom-lilac">
                        <a href="clientes.php" class="btn btn-secondary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Incluir scripts de JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function buscarCliente() {
        var dni = $('#dni').val();
        // Verificar si el campo DNI no está vacío
        if (dni.trim() != '') {
            // Realizar solicitud AJAX para buscar el cliente por DNI
            $.ajax({
                type: 'POST',
                url: 'buscar_cliente.php', // Archivo PHP que realizará la búsqueda del cliente por DNI
                data: { dni: dni },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Llenar los campos del formulario con los datos del cliente encontrado
                        $('#nombre').val(response.data.nombre);
                        $('#telefono').val(response.data.telefono);
                        $('#direccion').val(response.data.direccion);
                    } else {
                        // Mostrar un mensaje si el cliente no se encontró
                        alert('Cliente no encontrado');
                        // Limpiar los campos del formulario
                        $('#nombre').val('');
                        $('#telefono').val('');
                        $('#direccion').val('');
                    }
              
            });
        }
    }
</script>

<style>
    .btn-custom-lilac {
        background: rgba(182, 102, 210, 0.6); /* Lila pastel con 60% de opacidad */
        border: 2px solid #800080; /* Borde morado */
        color: #ffffff; /* Texto blanco */
    }

    .btn-custom-lilac:hover {
        background: rgba(182, 102, 210, 0.8); /* Lila pastel con 80% de opacidad al pasar el mouse */
        border: 2px solid #4B0082; /* Borde más oscuro en hover */
        color: #ffffff; /* Texto blanco */
    }

    .form-group {
        margin-bottom: 20px; /* Ajuste del espacio entre campos */
    }
</style>
