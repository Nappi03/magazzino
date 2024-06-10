<?php
session_start();
require "connessione.php";
include 'phpqrcode/qrlib.php';

if (isset($_POST["id"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ottieni i valori inseriti dall'utente

        $id = $_POST["id"];
        $nome = $_POST["nome"];

        if (!controllo($id)) {
            generaQr($id, $nome);
        } else {
            echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-operatore.php' method='GET'>
			<input type='hidden' name='msg' value='Seriale operatore già esistente'>
		</form>
	</body>";
        }

    } else {
        header('location: nuovo-operatore.php');
    }

} else {
    header('location: nuovo-operatore.php');
}

function controllo($id)
{
    global $con;
    $q = "SELECT * FROM operatore WHERE idOperatore = '$id'";
    $result = $con->query($q);
    if ($result && $result->fetch_row() > 0) {
        return true;
    } else {
        return false;
    }
}

function generaQr($id, $nome)
{
    global $con;

    // Directory in cui salvare il QR code
    $directory = 'QRcode/';

    // Nome del file QR code
    $filename = $directory . $id . '-qrcode.png';

    $dimensione = 200;

    // Crea il QR code con la dimensione specificata
    QRcode::png($id, $filename, QR_ECLEVEL_L, $dimensione);

    $q = "INSERT INTO operatore VALUES ('$id','$nome')";
    $con->query($q);
    header('location: nuovo-operatore.php');
}

?>