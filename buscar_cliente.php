<?php
include "conexion.php";

if (!empty($_POST)) {
    if ($_POST['action'] == 'searchCliente') {
        $dni = $_POST['cliente'];
        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE dni LIKE '$dni' AND estatus = 1");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);
        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo '0';
        exit;
    }
}
?>
