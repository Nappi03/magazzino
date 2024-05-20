<?php
session_start();
require "connessione.php";

if (isset($_POST["qrCode"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ottieni i valori inseriti dall'utente

        $qrCode = $_POST["qrCode"];

        //CONTROLLO SCARICO
        if (isset($_POST["operatore"])) {
            $operatore = $_POST["operatore"];
            $tipo = $_POST["tipo"];
            if (controlloQr($qrCode) && controlloOperatore($operatore)) {
                echo "<body onload='document.forms[0].submit()'>
		<form action='elabora-scarico.php' method='post'>
			<input type='hidden' name='qrCode' value='$qrCode'>
			<input type='hidden' name='operatore' value='$operatore'>
			<input type='hidden' name='tipo' value='$tipo'>
		</form>
	</body>";
            }
            if (!controlloQr($qrCode)) {
                echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-prodotto.php' method='GET'>
			<input type='hidden' name='msg' value='Prodotto non ancora inizializzato, registrarlo tramite questa form'>
		</form>
	</body>";
            }
        }

        if (isset($_POST["fornitore"])) {
            $fornitore = $_POST["fornitore"];

            //CONTROLLO CARICO
            if (isset($_POST["tipo"])) {
                $tipo = $_POST["tipo"];
                if (controlloQr($qrCode) && controlloFornitore($fornitore)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='elabora-carico.php' method='post'>
			<input type='hidden' name='qrCode' value='$qrCode'>
			<input type='hidden' name='fornitore' value='$fornitore'>
			<input type='hidden' name='tipo' value='$tipo'>
		</form>
	</body>";
                }
                if (!controlloQr($qrCode)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-prodotto.php' method='GET'>
			<input type='hidden' name='msg' value='Prodotto non ancora inizializzato, registrarlo tramite questa form'>
		</form>
	</body>";
                }
                if (!controlloFornitore($fornitore)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-fornitore.php' method='GET'>
			<input type='hidden' name='msg' value='Fornitore non ancora inizializzato, registrarlo tramite questa form'>
		</form>
	</body>";
                }
            } else {
                if (controlloQr($qrCode) && controlloFornitore($fornitore)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='carico-due.php' method='post'>
			<input type='hidden' name='qrCode' value='$qrCode'>
			<input type='hidden' name='fornitore' value='$fornitore'>
		</form>
	</body>";
                }
                if (!controlloQr($qrCode)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-prodotto.php' method='GET'>
			<input type='hidden' name='msg' value='Prodotto non ancora inizializzato, registrarlo tramite questa form'>
		</form>
	</body>";
                }
                if (!controlloFornitore($fornitore)) {
                    echo "<body onload='document.forms[0].submit()'>
		<form action='nuovo-fornitore.php' method='GET'>
			<input type='hidden' name='msg' value='Fornitore non ancora inizializzato, registrarlo tramite questa form'>
		</form>
	</body>";
                }
            }
        }

    } else {
        header('location: carico.php');
    }

} else {
    header('location: carico.php');
}

function controlloQr($qr)
{
    global $con;
    $q = "SELECT * FROM prodotto WHERE QRcode = '$qr'";
    $result = $con->query($q);
    if ($result && $result->fetch_row() > 0) {
        return true;
    } else {
        return false;
    }
}

function controlloFornitore($id)
{
    global $con;
    $q = "SELECT * FROM fornitore WHERE idFornitore = '$id'";
    $result = $con->query($q);
    if ($result && $result->fetch_row() > 0) {
        return true;
    } else {
        return false;
    }
}

function controlloOperatore($id)
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

?>