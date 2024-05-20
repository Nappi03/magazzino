<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
// Verifica se il form è stato inviato
if (isset($_GET["msg"])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Ottieni i valori inseriti dall'utente
        $msg = $_GET["msg"];
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
}
?>
<head>
    <title>Registra nuovo Operatore</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Registra nuovo operatore</h2>
    <form method="post" action="controllo-seriale-operatore.php">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nominativo Operatore</span>
            </div>
            <input type="text" placeholder="Nominativo" class="form-control" name="nome" id="nome"
                   aria-describedby="basic-addon3" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Seriale Operatore</span>
            </div>
            <input type="text" placeholder="Inserire la stringa che permette di generare il qr code" class="form-control" name="id" id="id"
                   aria-describedby="basic-addon3" required>
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Inserisci Operatore">
        </div>
    </form>
</div>
</body>
<?php require "footer.php"; ?>
</html>
