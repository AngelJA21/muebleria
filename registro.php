<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('PaginaMuebles/images/fondologin.png'); /* Ruta a tu imagen de fondo */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: rgba(182, 102, 210, 0.8); /* Lila pastel con transparencia */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #fff; /* Color blanco para que contraste con el fondo */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #7d55ff; /* Color lila pastel */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5f3dba; /* Color lila pastel más oscuro en hover */
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>MUEBLERIAS ANGEL</h1>
        <img src="PaginaMuebles/images/logoticket.jpg" alt="Logo Mueblerías Ángel" style="width: 100px; height: auto; margin-bottom: 20px;">
        <h2>Registro de Usuario</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost"; // Cambia esto si tu servidor es diferente
            $username = "root"; // Cambia esto si tu nombre de usuario de la BD es diferente
            $password = ""; // Cambia esto si tu contraseña de la BD es diferente
            $dbname = "paginamuebles"; // Cambia esto al nombre de tu base de datos

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Comprobar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña

            $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$name', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso";
                // Redirigir a la página de inicio de sesión
                header("Location: login.php");
                exit(); // Terminar el script después de la redirección
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
