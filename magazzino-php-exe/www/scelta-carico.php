<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
?>
<head>
    <title>Scelta carico</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Scelta tipo carico</h2>
    <br>
    <div style="zoom: 150%; align-content: center">
        <a type="submit" class="btn btn-success" href="carico.php">Carico quantitativo</a>
        <a type="submit" class="btn btn-success" href="carico-continuo.php">Carico continuo</a>
    </div>
</div>

</body>
</html>
