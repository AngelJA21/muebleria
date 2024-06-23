<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

        .login-container {
            background-color: rgba(182, 102, 210, 0.5); /* Lila pastel con transparencia */
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
            background-color: rgba(182, 102, 210, 0.8); /* Lila pastel con transparencia */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(182, 102, 210, 1); /* Lila pastel al pasar el mouse */
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>MUEBLERIAS ANGEL</h1>
        <img src="PaginaMuebles/images/logoticket.jpg" alt="Logo Mueblerías Ángel" style="width: 100px; height: auto; margin-bottom: 20px;">
        <h2>Iniciar Sesión</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Aquí puedes agregar la lógica para verificar el usuario y la contraseña
            // con tu base de datos o sistema de autenticación.

            // Si la autenticación es exitosa, redirige al usuario a la página index.php
            header("Location: index.php");
            exit; // Asegúrate de detener la ejecución del script después de la redirección
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <div class="register-link">
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
