<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
if (isset($_GET["msg"])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Ottieni i valori inseriti dall'utente
        $msg = $_GET["msg"];
        echo "<script type='text/javascript'>alert('$msg');</script>";

    }
}
?>
<head>
    <title>Scarico</title>
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
    <h2>Scarico</h2>
    <form method="post" action="scarico-due.php">
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
        <div>
            <input type="submit" class="btn btn-success" value="Avanti">
        </div>
    </form>
</div>

</body>
<?php require "footer.php"; ?>
</html>
