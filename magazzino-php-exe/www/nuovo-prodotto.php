<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
include 'phpqrcode/qrlib.php';
// Verifica se il form è stato inviato
if (isset($_GET["msg"])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Ottieni i valori inseriti dall'utente
        $msg = $_GET["msg"];
        echo "<script type='text/javascript'>alert('$msg');</script>";

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i valori inseriti dall'utente
    $qrCode = $_POST["qrCode"];
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];

    // Gestione del caricamento dell'immagine
    $imgFileName = $_FILES["img"]["name"];
    $imgTmpName = $_FILES["img"]["tmp_name"];
    $imgSize = $_FILES["img"]["size"];
    $imgError = $_FILES["img"]["error"];

    // Verifica se l'utente ha selezionato un'immagine
    if ($imgError === UPLOAD_ERR_OK) {
        if (!controllo($qrCode)) {
            generaQr($qrCode);

            $imgFilePath = salvaImg($imgFileName, $imgTmpName, $qrCode);

            $q = "INSERT INTO prodotto VALUES ('$qrCode','$nome','$categoria')";
            $con->query($q);

        } else {
            echo "<body onload='document.forms[0].submit()'>
            <form action='nuovo-prodotto.php' method='GET'>
                <input type='hidden' name='msg' value='Seriale prodotto già esistente'>
            </form>
        </body>";
        }

    } else {
        // Handle errors, if any, related to file upload
        echo "Errore durante il caricamento dell'immagine.";
    }
}

function controllo($id)
{
    global $con;
    $q = "SELECT * FROM prodotto WHERE QRcode = '$id'";
    $result = $con->query($q);
    if ($result && $result->fetch_row() > 0) {
        return true;
    } else {
        return false;
    }
}

function generaQr($id)
{

    // Directory in cui salvare il QR code
    $directory = 'QRcode/';

    // Nome del file QR code
    $filename = $directory . $id . '-qrcode.png';

    $dimensione = 200;

    // Crea il QR code con la dimensione specificata
    QRcode::png($id, $filename, QR_ECLEVEL_L, $dimensione);

}

function salvaImg($imgFileName, $imgTmpName, $qrCode)
{
    // Directory in cui salvare l'immagine
    $imgDirectory = 'img/';

    // Ottieni l'estensione del file
    $imgExtension = pathinfo($imgFileName, PATHINFO_EXTENSION);

    // Rinomina il file per evitare sovrascritture
    $imgFilePath = $imgDirectory . $qrCode . '.' . $imgExtension;

    // Sposta l'immagine nella directory del progetto
    move_uploaded_file($imgTmpName, $imgFilePath);

    return $imgFilePath;

}

?>
<head>
    <title>Registra nuovo prodotto</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Registra nuovo prodotto</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">QrCode</span>
            </div>
            <input required type="text" placeholder="QrCode" class="form-control" name="qrCode" id="qrCode"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nome</span>
            </div>
            <input required type="text" placeholder="Nome" class="form-control" name="nome" id="nome"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Categoria</span>
            </div>
            <input required type="text" placeholder="Categoria" class="form-control" id="categoria" name="categoria"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Immagine</span>
            </div>
            <input required type="file" placeholder="Seleziona immagine" class="form-control" id="img" name="img"
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Inserisci Prodotto">
        </div>
    </form>
</div>
</body>
<?php require "footer.php"; ?>
</html>
