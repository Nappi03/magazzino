<?php
session_start();
require "connessione.php";

// Include la libreria FPDF
require('fpdf186/fpdf.php');

$id = $_GET['id'];

$q = "SELECT * FROM fornitore WHERE idFornitore = '$id'";

$magazzino = $con->query($q);

// Creazione di un nuovo oggetto FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Ln(5); // Vai alla riga successiva

// Impostazione del font
$pdf->SetFont('Arial', 'B', 20);

// Intestazione della tabella
$pdf->Cell(100, 20, utf8_decode('QrCode'), 1, 0, 'C');
$pdf->Cell(90, 20, utf8_decode('Nome'), 1, 0, 'C');
$pdf->Ln(); // Vai alla riga successiva
$pdf->Ln(5); // Vai alla riga successiva

// Popolamento della tabella con i dati dal database
while ($row = $magazzino->fetch_object()) {
    $imgQR = 'QRcode/' . $row->idFornitore . '-qrcode.png';

    // Aggiunge una cella con un'immagine più grande
    $pdf->Cell(100, 100, '', 1, 0, 'C');  // Cella vuota per il QR Code
    $pdf->Image($imgQR, $pdf->GetX()-99, $pdf->GetY()+1, 98, 98);  // Aggiungi l'immagine sovrapposta alla cella
    $pdf->Cell(90, 100, utf8_decode($row->nominativo), 1, 0, 'C');
    $pdf->Ln(); // Vai alla riga successiva
    $pdf->Ln(5); // Vai alla riga successiva
}

// Salva il PDF in una variabile
$pdf->Output('fornitori_report.pdf', 'D');
?>
