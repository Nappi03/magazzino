<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
$id = $_GET["id"];
$qt = $_GET["qt"];
$q = "SELECT * FROM prodotto WHERE QRcode = '$id'";
$prodotto = $con->query($q);
while ($row = $prodotto->fetchArray(SQLITE3_ASSOC)) {
    $nome = $row['nomeProd'];
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Prodotto: <?php echo $nome . ' - Quantità: ' . $qt ?></title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container">

    <h1 class="mt-5 mb-4">Prodotto: <?php echo $nome ?></h1>
    <h3 class="mt-3 mb-2">Quantità in magazzino: <?php echo $qt ?></h3>
    <!--<a type="submit" class="btn btn-success mt-3 mb-2" href="modifica-prodotto.php/?id=<?//php echo $id ?>">Modifica
        Prodotto</a> -->

    <h2 class="mt-4 mb-4">Carico</h2>
    <!-- TABELLA DI CARICO -->
    <div class="container">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID Carico</th>
                <th>Utente</th>
                <th>Data e ora</th>
                <th>Fornitore</th>
                <th>Quantità</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT c.idCarico, c.dataOraCarico, u.nome AS nomeUtente, f.nominativo AS nomeFornitore, p.nomeProd AS nomeProdotto, cp.QRcode, cp.qt AS quantita_in_carico FROM carico c 
    JOIN utente u ON c.idUtente = u.idUtente 
    JOIN fornitore f ON c.idFornitore = f.idFornitore 
    JOIN carico_prodotti cp ON c.idCarico = cp.idCarico 
    JOIN prodotto p ON cp.QRcode = p.QRcode
    WHERE cp.QRcode = '$id'";
            $carico = $con->query($q);
            while ($row = $carico->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['idCarico']}</td>";
                echo "<td>{$row['nomeUtente']}</td>";
                echo "<td>" . date('d/m/Y H:i:s', strtotime($row['dataOraCarico'])) . "</td>";
                echo "<td>{$row['nomeFornitore']}</td>";
                echo "<td>{$row['quantita_in_carico']}</td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- TABELLA DI SCARICO -->
    <h2 class="mt-5 mb-4">Scarico</h2>
    <div class="container">
        <table id="myTable2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID Scarico</th>
                <th>Utente</th>
                <th>Data e ora</th>
                <th>Quantità</th>
                <th>Operatore</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT s.idScarico, s.dataOraScarico, u.nome AS nomeUtente, p.nomeProd AS nomeProdotto, sp.QRcode, sp.qt AS quantita_in_scarico,  o.nominativo AS nomeOperatore FROM scarico s 
    JOIN utente u ON s.idUtente = u.idUtente 
    JOIN scarico_prodotti sp ON s.idScarico = sp.idScarico 
    JOIN prodotto p ON sp.QRcode = p.QRcode 
    JOIN operatore o ON s.idOperatore = o.idOperatore

    WHERE sp.QRcode = '$id'";
            $scarico = $con->query($q);
            while ($row = $scarico->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['idScarico']}</td>";
                echo "<td>{$row['nomeUtente']}</td>";
                echo "<td>" . date('d/m/Y H:i:s', strtotime($row['dataOraScarico'])) . "</td>";
                echo "<td>{$row['quantita_in_scarico']}</td>";
                echo "<td>{$row['nomeOperatore']}</td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<div style="margin: 2%"></div>

<script>
    // Inizializza DataTable
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
    $(document).ready(function () {
        $('#myTable2').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function () {
        const rows = document.querySelectorAll(".table-link");
        rows.forEach(function (row) {
            row.addEventListener("click", function () {
                const url = row.getAttribute("data-href");
                window.location.href = url;
            });
        });
    });
</script>

</body>
<?php require "footer.php"; ?>
</html>
