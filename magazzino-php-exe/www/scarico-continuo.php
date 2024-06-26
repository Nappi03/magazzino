<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
?>
<head>
    <title>Scarico continuo</title>
    <?php require "include.php" ?>

    <script>
        window.onload = function() {
            document.getElementById("qrCode").focus();
        };
    </script>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Scarico continuo</h2>
    <form method="post" action="controllo-qr.php">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">QrCode</span>
            </div>
            <input required type="text" placeholder="QrCode" value="" class="form-control" name="qrCode" id="qrCode"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Operatore</span>
            </div>
            <input required type="text" placeholder="Operatore" value="" class="form-control" name="operatore"
                   id="oepratore"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3" hidden>
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Fornitore</span>
            </div>
            <input type="text" placeholder="Fornitore" value="1" class="form-control" name="tipo" id="tipo"
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Avanti">
        </div>
    </form>
</div>

</body>
<?php require "footer.php"; ?>
</html>
