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
		<form action='nuovo-fornitore.php' method='GET'>
			<input type='hidden' name='msg' value='Seriale fornitore già esistente'>
		</form>
	</body>";
        }

    } else {
        header('location: nuovo-fornitore.php');
    }

} else {
    header('location: nuovo-fornitore.php');
}

function controllo($id)
{
    global $con;
    $q = "SELECT * FROM fornitore WHERE idFornitore = '$id'";
    $result = $con->query($q);
    if ($result && $result->fetchArray(SQLITE3_ASSOC) > 0) {
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

    $q = "INSERT INTO fornitore VALUES ('$id','$nome')";
    $con->query($q);
    header('location: nuovo-fornitore.php');
}

?>