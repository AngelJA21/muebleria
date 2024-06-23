<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENÚ PRINCIPAL</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('PaginaMuebles/images/fondoindex.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .navbar {
            background-color: rgba(200, 162, 200, 0.7);
            color: #000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 50px;
            margin-left: 20px;
        }

        .nav-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu ul li {
            display: inline;
        }

        .nav-menu ul li a {
            color: #000;
            text-decoration: none;
            margin-left: 20px;
        }

        .nav-menu ul li:first-child {
            margin-left: 0;
        }

        .centered-text {
            text-align: center;
            margin-top: 20px;
        }

        .header-message {
            font-size: 36px;
            font-weight: bold;
            font-style: italic;
            color: #3b5998;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .welcome-message {
            font-size: 24px;
            font-style: italic;
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .logout-btn {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #495057;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .image-container img {
            width: 200px;
            margin: 0 10px;
            animation: slideIn 1s ease-in-out infinite alternate;
        }

        @keyframes slideIn {
            0% { transform: translateX(-20px); }
            100% { transform: translateX(20px); }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <img src="PaginaMuebles/images/logoticket.jpg" alt="Logo de la empresa" class="logo">
        <h1>Menú principal</h1>
        <nav class="nav-menu">
            <ul>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="agregar_producto.php">Agregar Producto</a></li>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="agregar_cliente.php">Agregar Cliente</a></li>
                <li><a href="proveedores.php">Proveedores</a></li>
                <li><a href="agregar_proveedores.php">Agregar Proveedor</a></li>
                <li><a href="agregar_venta.php">Agregar Venta</a></li>
            </ul>
        </nav>
    </header>
    <div class="centered-text">
        <p class="header-message">MUEBLERÍAS "ANGEL"</p>
        <p class="welcome-message">BIENVENIDO</p>
        <p class="welcome-message"> ISC-0802</p>
        <p class="welcome-message">ANGEL DE JESÚS ARGUETA</p>
        <p class="welcome-message">ANGÉLICA PAMELA MARTÍNEZ ARIAS</p>
    </div>
    <div class="image-container">
        <img src="PaginaMuebles/images/Imagen1.jpg" alt="Imagen 1">
        <img src="PaginaMuebles/images/imagen2.jpg"  alt="Imagen 2">
        <img src="PaginaMuebles/images/imagen3.jpg"  alt="Imagen 3">
        <img src="PaginaMuebles/images/imagen4.jpeg"  alt="Imagen 4">
        <img src="PaginaMuebles/images/imagen5.jpg"  alt="Imagen 5">
        <img src="PaginaMuebles/images/imagen6.jpeg"  alt="Imagen 6">
    </div>
    <a href="salir.php" class="logout-btn">Salir</a>
</body>
</html>
