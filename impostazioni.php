<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['edit_type']) || isset($_POST['delete_type']))) {
    $action = $_POST['action'];

    if ($action == 'edit') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $qt = $_POST['qt'];

        $q = "UPDATE prodotto SET nome='$nome', qt='$qt' WHERE id='$id'";
        $con->query($q);

    } elseif ($action == 'delete') {
        $id = $_POST['id'];

        $q = "DELETE FROM prodotto WHERE id='$id'";
        $con->query($q);

    }
}
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
    <h2 class="mt-5 mb-1">Prodotti</h2>
    <div class="container">
        <table id="prodottiTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nome</th>
                <th>QT.</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT * FROM prodotto";

            $magazzino = $con->query($q);

            while ($row = $magazzino->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['nome']}</td>";
                echo "<td>{$row['qt']}</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-edit' data-id='{$row['id']}' data-nome='{$row['nome']}' data-qt='{$row['qt']}' data-bs-toggle='modal' data-bs-target='#editProdottoModal'>Modifica</button> ";
                echo "<button class='btn btn-danger btn-delete' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#deleteProdottoModal'>Elimina</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="editProdottoModal" tabindex="-1" aria-labelledby="editProdottoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProdottoForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdottoModalLabel">Modifica Prodotto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editProdottoId" name="id">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_type" value="prodotto">
                        <div class="form-group">
                            <label for="editProdottoNome">Nome Prodotto</label>
                            <input type="text" class="form-control" id="editProdottoNome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editProdottoQt">QT.</label>
                            <input type="text" class="form-control" id="editProdottoQt" name="qt"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal per Elimina Prodotto -->
    <div class="modal fade" id="deleteProdottoModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteProdottoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteProdottoForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteProdottoModalLabel">Conferma Eliminazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare questo prodotto?
                        <input type="hidden" id="deleteProdottoId" name="id">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="delete_type" value="prodotto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $('#prodottiTable').DataTable();

            // Modifica Prodotto
            $('#editProdottoModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nome = button.data('nome');
                var qt = button.data('qt');
                var modal = $(this);
                modal.find('#editProdottoId').val(id);
                modal.find('#editProdottoNome').val(nome);
                modal.find('#editProdottoQt').val(qt);
            });

            // Elimina Prodotto
            $('#deleteProdottoModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#deleteProdottoId').val(id);
            });

        });
    </script>

</body>
</html>
