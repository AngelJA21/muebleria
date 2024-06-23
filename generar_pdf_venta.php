<?php
require('factura/fpdf186/fpdf.php'); // Ajusta la ruta según donde esté tu carpeta FPDF

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['datos_venta'])) {
    $datos_venta = json_decode($_POST['datos_venta'], true);

    if (!$datos_venta) {
        die('No se recibieron datos');
    }

    // Verificar si las claves existen
    $cliente_nombre = isset($datos_venta['cliente_nombre']) ? $datos_venta['cliente_nombre'] : 'N/A';

    // Crear instancia de FPDF con tamaño A4
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 30);

    // Título de la empresa y espacio para el logo
    $pdf->Cell(0, 10, 'MUEBLERIAS "ANGEL"', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, '"LOS DETALLES NO SON SOLO DETALLES, ELLOS HACEN EL DISENO"', 0, 1, 'C'); // Eslogan con diferente tipo de letra
    $pdf->Ln(2);

    // Apartado para el logo (ajustar la posición y tamaño según sea necesario)
    $pdf->Image('PaginaMuebles/images/logoticket.jpg', 10, 10, 20); // Descomentar y ajustar la ruta y tamaño del logo
    $pdf->Ln(10); // Ajusta este valor según el espacio necesario para el logo

    // Datos de la mueblería
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Datos de la Muebleria', 0, 1, 'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Direccion: Av. Luis Donaldo Colosio, Ixtlahuaca.', 0, 1, 'L');
    $pdf->Cell(0, 10, 'Telefono: 71-21-03-71-49', 0, 1, 'L');
    $pdf->Cell(0, 10, 'Correo: info@muebleriasangel.com', 0, 1, 'L');
    $pdf->Ln(10);

    // Fecha y hora
    $fecha_hora = date('d/m/Y H:i:s');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha_hora, 0, 1, 'L');
    $pdf->Ln(2);

    // Datos del Cliente
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Datos del Cliente', 0, 1, 'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 10, 'Nombre:', 0, 0, 'L');
    $pdf->Cell(0, 10, $cliente_nombre, 0, 1, 'L');
    $pdf->Ln(10);

    // Detalles del Producto
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Detalles del Producto', 0, 1, 'C');
    $pdf->Ln(2);

    // Cabecera de la tabla de productos
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10, 'Producto', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Cant', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tipo', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Subtotal', 1, 1, 'C');

    // Datos de los productos
    $pdf->SetFont('Arial', '', 10);
    foreach ($datos_venta['productos_seleccionados'] as $producto) {
        $nombre = isset($producto['nombre']) ? $producto['nombre'] : 'N/A';
        $cantidad = isset($producto['cantidad']) ? $producto['cantidad'] : 'N/A';
        $tipo = isset($producto['tipo']) ? $producto['tipo'] : 'N/A';
        $precio = isset($producto['precio']) ? $producto['precio'] : 'N/A';
        $subtotal = isset($producto['subtotal']) ? $producto['subtotal'] : 'N/A';

        $pdf->Cell(60, 10, $nombre, 1, 0, 'C');
        $pdf->Cell(30, 10, $cantidad, 1, 0, 'C');
        $pdf->Cell(30, 10, $tipo, 1, 0, 'C');
        $pdf->Cell(30, 10, '$' . $precio, 1, 0, 'C');
        $pdf->Cell(40, 10, '$' . $subtotal, 1, 1, 'C');
    }

    // Total de la venta
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Total: $' . $datos_venta['precio_total'], 0, 1, 'C');
    $pdf->Ln(5);

    // Mensaje de agradecimiento
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Gracias por su preferencia', 0, 1, 'C');

    // Otros datos a agregar (ejemplo)
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Visitanos en www.muebleriasangel.com', 0, 1, 'C');

    // Mostrar el PDF en el navegador o descargarlo
    $pdf->Output();
    exit;
} else {
    die('Acceso no autorizado');
}
?>
