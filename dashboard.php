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
<?php require "navbar.php"; ?>

<div class="container">

    <h2 class="mt-1 mb-4">Prodotti</h2>

    <div class="container">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Prodotto</th>
                <th>Quantità</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT * FROM prodotto";

            $magazzino = $con->query($q);
            $data = array();

            while ($row = $magazzino->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['nome']}</td>";
                echo "<td id='qt-{$row['id']}'>{$row['qt']}</td>";
                echo "<td>
        <button class='btn btn-success btn-sm' onclick='updateQuantity({$row['id']}, 1)'>+</button>
        <button class='btn btn-danger btn-sm' onclick='updateQuantity({$row['id']}, -1)'>-</button>
    </td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    // Inizializza DataTable
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    function updateQuantity(id, delta) {
        $.ajax({
            url: 'update_quantity.php', // Endpoint PHP per aggiornare il valore
            type: 'POST',
            data: {
                id: id,       // ID del prodotto
                delta: delta  // Incremento o decremento
            },
            success: function (response) {
                // Parsifica la risposta JSON dal server
                const data = JSON.parse(response);

                if (data.success) {
                    // Aggiorna la cella del valore nel DOM
                    const qtCell = document.getElementById(`qt-${id}`);
                    qtCell.textContent = data.newQuantity;
                } else {
                    alert("Errore durante l'aggiornamento: " + data.error);
                }
            },
            error: function () {
                alert("Errore nella comunicazione con il server.");
            }
        });
    }

</script>

</body>
</html>
