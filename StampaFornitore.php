<?php
session_start();
require "connessione.php";

// Include la libreria FPDF
require('fpdf186/fpdf.php');

$q = "SELECT * FROM fornitore";

$magazzino = $con->query($q);

// Creazione di un nuovo oggetto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Impostazione del font
$pdf->SetFont('Arial', 'B', 20);

// Aggiungi il titolo sopra la tabella
$pdf->Cell(0, 10, 'Lista Fornitori', 0, 1, 'C');  // Larghezza 0 indica una cella che occupa l'intera larghezza
$pdf->Ln(5);  // Aggiungi uno spazio dopo il titolo

$pdf->SetFont('Arial', 'B', 12);

// Intestazione della tabella
//$pdf->Cell(20, 15, utf8_decode('Logo'), 1, 0, 'C');
$pdf->Cell(30, 15, utf8_decode('QrCode'), 1, 0, 'C');
$pdf->Cell(65, 15, utf8_decode('Nome'), 1, 0, 'C');
$pdf->Ln(); // Vai alla riga successiva
$pdf->Ln(5); // Vai alla riga successiva
// Popolamento della tabella con i dati dal database
while ($row = $magazzino->fetch_object()) {
    $imgQR = 'QRcode/' . $row->idFornitore . '-qrcode.png';

    // Aggiunge una cella con un'immagine
    $pdf->Cell(30, 30, '', 1, 0, 'C');  // Cella vuota per il QR Code
    $pdf->Image($imgQR, $pdf->GetX() - 27.5, $pdf->GetY() + 2.5, 25, 25);  // Aggiungi l'immagine sovrapposta alla cella
    $pdf->Cell(65, 30, utf8_decode($row->nominativo), 1, 0, 'C');
    $pdf->Ln(); // Vai alla riga successiva
    $pdf->Ln(5); // Vai alla riga successiva
}

// Salva il PDF in una variabile
$pdf->Output('fornitori_report.pdf', 'D');
?>
