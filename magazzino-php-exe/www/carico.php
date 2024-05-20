<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
?>
<head>
    <title>Carico</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Carico</h2>
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
                <span class="input-group-text" id="basic-addon3">Fornitore</span>
            </div>
            <input required type="text" placeholder="Fornitore" value="" class="form-control" name="fornitore" id="fornitore"
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
