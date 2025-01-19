<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
?>
<head>
    <title>Scelta scarico</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Scelta tipo scarico</h2>
    <br>
    <div style="zoom: 150%; align-content: center">
        <a type="submit" class="btn btn-success" href="scarico.php">Scarico quantitativo</a>
        <a type="submit" class="btn btn-success" href="scarico-continuo.php">Scarico continuo</a>
    </div>
</div>

</body>
<?php require "footer.php"; ?>
</html>
