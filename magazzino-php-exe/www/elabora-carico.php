<?php
session_start();
require "connessione.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["tipo"])) {
        $tipo = $_POST["tipo"];
        $qrCode = $_POST["qrCode"];
        $fornitore = $_POST["fornitore"];
        $qt = 1;
        $dataOdierna = $dataOdierna = date("Y-m-d H:i:s");
        $id = $_SESSION["USER_ID"];
        $q = "SELECT * FROM prodotto WHERE QRcode = '$qrCode'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $nomeProd = $row['nomeProd'];
            $categoriaProd = $row['categoria'];
        }
        $q = "SELECT * FROM fornitore WHERE idFornitore = '$fornitore'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $nominativo = $row['nominativo'];
        }

        $q = "INSERT INTO carico (dataOraCarico, idUtente, idFornitore)  VALUES('$dataOdierna', $id, '$fornitore')";
        $con->query($q);
        $q = "SELECT idCarico FROM carico WHERE dataOraCarico = '$dataOdierna'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $idCarico = $row['idCarico'];
        }
        $q = "INSERT INTO carico_prodotti VALUES ('$qrCode', $idCarico , $qt)";
        $con->query($q);

        header('location: carico-continuo.php');

    }
    else{
        $qrCode = $_POST["qrCode"];
        $nome = $_POST["nome"];
        $categoria = $_POST["categoria"];
        $fornitore = $_POST["fornitore"];
        $qt = $_POST["quantita"];
        $dataOdierna = $dataOdierna = date("Y-m-d H:i:s");
        $id = $_SESSION["USER_ID"];

        $q = "INSERT INTO carico (dataOraCarico, idUtente, idFornitore)  VALUES('$dataOdierna', $id, '$fornitore')";
        $con->query($q);
        $q = "SELECT idCarico FROM carico WHERE dataOraCarico = '$dataOdierna'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $idCarico = $row['idCarico'];
        }
        $q = "INSERT INTO carico_prodotti VALUES ('$qrCode', $idCarico , $qt)";
        $con->query($q);

        header('location: carico.php');
    }


}
?>