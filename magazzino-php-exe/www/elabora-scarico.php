<?php
session_start();
require "connessione.php";
// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["tipo"])) {
        $tipo = $_POST["tipo"];
        $qrCode = $_POST["qrCode"];
        $qt = 1;
        $dataOdierna = $dataOdierna = date("Y-m-d H:i:s");
        $id = $_SESSION["USER_ID"];

        $operatore = $_POST["operatore"];

        $q = "SELECT * FROM prodotto WHERE QRcode = '$qrCode'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $nomeProd = $row['nomeProd'];
            $categoriaProd = $row['categoria'];
        }


        $q = "INSERT INTO scarico (dataOraScarico, idOperatore , idUtente )  VALUES('$dataOdierna','$operatore',$id)";

        $con->query($q);
        $q = "SELECT idScarico FROM scarico WHERE dataOraScarico = '$dataOdierna'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $idScarico = $row['idScarico'];
        }
        $q = "INSERT INTO scarico_prodotti VALUES ('$qrCode', $idScarico , $qt)";
        $con->query($q);

        header('location: scarico-continuo.php');
    } else {
        $qrCode = $_POST["qrCode"];
        $qt = $_POST["quantita"];
        $dataOdierna = $dataOdierna = date("Y-m-d H:i:s");
        $id = $_SESSION["USER_ID"];


        $operatore = $_GET["idOp"];


        $q = "INSERT INTO scarico (dataOraScarico, idOperatore , idUtente )  VALUES('$dataOdierna','$operatore',$id)";

        $con->query($q);
        $q = "SELECT idScarico FROM scarico WHERE dataOraScarico = '$dataOdierna'";
        $result = $con->query($q);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $idScarico = $row['idScarico'];
        }
        $q = "INSERT INTO scarico_prodotti VALUES ('$qrCode', $idScarico , $qt)";
        $con->query($q);

        header('location: scarico.php');
    }

}
?>