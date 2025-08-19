<?php
require "../modelo/conexion.php";
require "../librerias/fpdf/fpdf.php"; // asegúrate de tener FPDF en esa ruta

if (!isset($_GET["id_venta"])) {
    die("No se encontró la venta.");
}

$id_venta = $_GET["id_venta"];

// Obtener datos de la venta
$sql = "SELECT * FROM venta WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_venta);
$stmt->execute();
$venta = $stmt->get_result()->fetch_assoc();

// Obtener detalles
$sql_det = "SELECT d.*, p.nombre 
            FROM detalle_venta d 
            INNER JOIN producto p ON d.id_producto = p.id
            WHERE d.id_venta = ?";
$stmt_det = $conexion->prepare($sql_det);
$stmt_det->bind_param("i", $id_venta);
$stmt_det->execute();
$detalles = $stmt_det->get_result();

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Encabezado
$pdf->Cell(0,10,'COMPROBANTE DE VENTA',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'MINIRED - San Juan de Lurigancho',0,1,'C');
$pdf->Ln(5);

// Datos de venta
$pdf->Cell(100,10,"Cliente: " . $venta["cliente"],0,0);
$pdf->Cell(90,10,"Fecha: " . $venta["fecha"],0,1);

// Tabla
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(80,10,'Producto',1);
$pdf->Cell(30,10,'Cant.',1);
$pdf->Cell(40,10,'Precio Unit.',1);
$pdf->Cell(40,10,'Subtotal',1);
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$total = 0;
while($row = $detalles->fetch_assoc()) {
    $subtotal = $row["cantidad"] * $row["precio"];
    $total += $subtotal;

    $pdf->Cell(80,10,$row["nombre"],1);
    $pdf->Cell(30,10,$row["cantidad"],1,0,'C');
    $pdf->Cell(40,10,number_format($row["precio"],2),1,0,'R');
    $pdf->Cell(40,10,number_format($subtotal,2),1,0,'R');
    $pdf->Ln();
}

// Total
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,10,'TOTAL',1);
$pdf->Cell(40,10,'S/ '.number_format($total,2),1,0,'R');

// Mostrar PDF en navegador
$pdf->Output('I', 'comprobante.pdf');
?>
