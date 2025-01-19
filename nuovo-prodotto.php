<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];

    $q = "INSERT INTO prodotto (nome, qt)  VALUES ('$nome', 0)";
    $con->query($q);

    //Header('location: dashboard.php');

}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registra nuovo prodotto</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container">
    <h2>Registra nuovo prodotto</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nome</span>
            </div>
            <input required type="text" placeholder="Nome" class="form-control" name="nome" id="nome"
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Inserisci Prodotto">
        </div>
    </form>
</div>
</body>
</html>
