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

    <title>Lista Fornitori</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container">

    <h2 class="mt-5 mb-4">Lista Fornitori</h2>
    <a type="submit" class="btn btn-success" href="StampaFornitore.php">Stampa tutti i QRcode</a>
    <div style="margin-top: 2%"></div>

    <div class="container">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>CodiceQR</th>
                <th>Nome Fornitore</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT * FROM fornitore";
            $res = $con->query($q);

            while ($row = $res->fetch_object()) {
                //echo "<tr class='table-link' data-href='carico-scarico.php?id=$row->QRcode&qt=$row->quantita_in_magazzino'>";
                echo "<td>$row->idFornitore</td>";
                echo "<td>$row->nominativo</td>";
                echo "<td>";
                echo "<a class='btn btn-success btn-edit' href='StampaFornitoreSingolo.php?id=$row->idFornitore'>Stampa QR</a> ";
                echo "</td>";
                echo "</tr>";
                echo "</a>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <div class="col"><h4 class="modal-title">ID: </h4>
                            <h4 class="modal-title" id="myModalLabelID"></h4></div>
                        <div class="col"><h4 class="modal-title">Nome: </h4>
                            <h4 class="modal-title" id="myModalLabelNome"></h4></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <img id="fornitoreImage" src="" alt="Immagine del fornitore" style="max-width: 100%; max-height: 100%;">
            </div>
            <div class="modal-footer">
                <a id="downloadLink" class="btn btn-primary" download="fornitoreQrCode.jpg" href="#">Download QrCode</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Inizializza DataTable
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

</script>

</body>
<?php require "footer.php"; ?>
</html>
