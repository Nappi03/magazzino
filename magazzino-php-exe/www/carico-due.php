<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["qrCode"])) {
        $qrCode = $_POST["qrCode"];
        $fornitore = $_POST["fornitore"];
        $q = "SELECT * FROM prodotto WHERE QRcode = '$qrCode'";
        $result = $con->query($q);
        while ($row = $result->fetch_assoc()) {
            $nomeProd = $row['nomeProd'];
            $categoriaProd = $row['categoria'];
        }
        $q = "SELECT * FROM fornitore WHERE idFornitore = '$fornitore'";
        $result = $con->query($q);
        while ($row = $result->fetch_assoc()) {
            $nominativo = $row['nominativo'];
        }
    }
}

?>
<head>
    <title>Carico</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Carico</h2>
    <form method="post" action="elabora-carico.php">
        <div class="input-group mb-3" hidden="hidden">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">QrCode</span>
            </div>
            <input type="text" placeholder="<?php echo $qrCode ?>" value="<?php echo $qrCode ?>" class="form-control"
                   name="qrCode" id="qrCode"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nome</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $nomeProd ?>" value="<?php echo $nomeProd ?>"
                   class="form-control" name="nome" id="nome"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Categoria</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $categoriaProd ?>" value="<?php echo $categoriaProd ?>"
                   class="form-control" id="categoria"
                   name="categoria"
                   aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Fornitore</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $nominativo ?>" value="<?php echo $nominativo ?>"
                   class="form-control" id="nominativo"
                   name="nominativo"
                   aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3" hidden="hidden">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">QrCode</span>
            </div>
            <input type="text" placeholder="<?php echo $fornitore ?>" value="<?php echo $fornitore ?>" class="form-control"
                   name="fornitore" id="fornitore"
                   aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Quantità</span>
            </div>
            <input required type="text" placeholder="Quantità" class="form-control" id="quantita" name="quantita"
                   value=''
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Carica Prodotto">
        </div>
    </form>
</div>

</body>
</html>
