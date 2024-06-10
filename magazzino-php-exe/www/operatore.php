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

    <title>Lista Operatori</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php"; ?>

<div class="container">

    <h2 class="mt-5 mb-4">Lista Operatori</h2>
    <a type="submit" class="btn btn-success" href="StampaOperatore.php">Stampa tutti i QRcode</a>
    <div style="margin-top: 2%"></div>

    <div class="container">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>CodiceQR</th>
                <th>Nome Operatore</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT * FROM operatore";
            $res = $con->query($q);

            while ($row = $res->fetch_object()) {
                //echo "<tr class='table-link' data-href='carico-scarico.php?id=$row->QRcode&qt=$row->quantita_in_magazzino'>";
                echo "<tr class='table-link' data-toggle='modal' data-target='#myModal' data-fornitore-id='{$row['idOperatore']}' data-fornitore-nome='{$row['nominativo']}'>";
                echo "<td>{$row['idOperatore']}</td>";
                echo "<td>{$row['nominativo']}</td>";
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

    // Gestisci il clic sulla riga e mostra il modal con l'immagine del fornitore
    $(document).on('click', '.table-link', function () {
        // Recupera l'ID del fornitore dalla riga selezionata (attributo data-fornitore-id)
        const fornitoreId = $(this).data('fornitore-id');
        const fornitoreNome = $(this).data('fornitore-nome');

        // Imposta il titolo del modal con l'ID del fornitore e un a capo dopo l'ID
        $('#myModalLabelID').html(fornitoreId);
        $('#myModalLabelNome').html(fornitoreNome);

        // Recupera l'URL dell'immagine del fornitore (aggiungi un attributo data-image-url alla riga)
        const imageURL = 'QRcode/' + fornitoreId + '-qrcode.png';

        // Imposta l'attributo src dell'elemento img con l'URL dell'immagine
        $('#fornitoreImage').attr('src', imageURL);

        // Mostra il modal
        $('#myModal').modal('show');
    });


    // Gestisci il clic sul pulsante "Stampa" all'interno del modal
    $('#stampareBtn').on('click', function () {
        // Seleziona l'immagine da stampare
        var imageToPrint = document.getElementById('fornitoreImage');

        const ID = document.getElementById('myModalLabelID').innerText;
        const Nome = document.getElementById('myModalLabelNome').innerText;

        // Crea una nuova scheda del browser per la stampa
        var printWindow = window.open();
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Stampa QrCode</title></head><body>');
        printWindow.document.write('<h1> ID: ' + ID + '<br> Nome: ' + Nome + '</h1>');
        printWindow.document.write('<img src="' + imageToPrint.src + '" style="zoom: 50%"/>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Aspetta che l'immagine sia caricata prima di avviare la stampa
        printWindow.document.querySelector('img').onload = function () {
            printWindow.print();
        };
    });


    // Gestisci il clic sul pulsante "Download" all'interno del modal
    $('#downloadLink').on('click', function (event) {
        // Impedisci il comportamento predefinito del link
        event.preventDefault();

        const Nome = document.getElementById('myModalLabelNome').innerText;
        const ID = document.getElementById('myModalLabelID').innerText;

        // Seleziona l'immagine da scaricare
        var imageToDownload = document.getElementById('fornitoreImage');

        // Ottieni l'URL dell'immagine
        var imageURL = imageToDownload.src;

        // Crea un link temporaneo per il download dell'immagine
        var downloadLink = document.createElement('a');
        downloadLink.href = imageURL;
        downloadLink.download = ID + '_' + Nome + '.jpg'; // Specifica il nome del file da scaricare

        // Simula un clic sul link per avviare il download
        downloadLink.click();
    });


</script>

</body>
<?php require "footer.php"; ?>
</html>
