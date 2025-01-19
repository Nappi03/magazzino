<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <?php require "include.php" ?>

</head>
<body>

<div class="container">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>CodiceQR</th>
            <th>Nome Prodotto</th>
            <th>Categoria</th>
            <th>Quantità</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $q = "SELECT p.QRcode, p.nomeProd, p.categoria, IFNULL(SUM(cp.qt - IFNULL(sp.qt, 0)), 0) AS quantita_in_magazzino FROM prodotto p
    LEFT JOIN (SELECT QRcode, SUM(qt) AS qt FROM carico_prodotti GROUP BY QRcode) cp ON p.QRcode = cp.QRcode
    LEFT JOIN (SELECT QRcode, SUM(qt) AS qt FROM scarico_prodotti GROUP BY QRcode) sp ON p.QRcode = sp.QRcode GROUP BY p.QRcode, p.nomeProd, p.categoria";

        $magazzino = $con->query($q);
        $data = array();

        while ($row = $magazzino->fetch_object()) {
            echo "<tr class='table-link' data-href='carico-scarico.php?id=$row->QRcode&qt=$row->quantita_in_magazzino'>";
            echo "<td>$row->QRcode</td>";
            echo "<td>$row->nomeProd</td>";
            echo "<td>$row->categoria</td>";
            echo "<td>$row->quantita_in_magazzino</td>";
            echo "</tr>";
            echo "</a>";
            $data[] = $row;
        }

        $json_data = json_encode($data);
        ?>

        </tbody>
    </table>
</div>
<script>
    // Inizializza DataTable
    $(document).ready(function () {
        $('#myTable').DataTable();
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
