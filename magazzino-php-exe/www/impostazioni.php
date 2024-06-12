<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['edit_type']) || isset($_POST['delete_type']))) {
    $action = $_POST['action'];



    if ($action == 'edit') {
        $edit_type = $_POST['edit_type'];
        if ($edit_type == 'prodotto') {
            $QRcode = $_POST['QRcode'];
            $nomeProd = $_POST['nomeProd'];
            $categoria = $_POST['categoria'];

            $q = "UPDATE prodotto SET nomeProd='$nomeProd', categoria='$categoria' WHERE QRcode='$QRcode'";
            $con->query($q);
        } elseif ($edit_type == 'fornitore') {
            $idFornitore = $_POST['idFornitore'];
            $nominativo = $_POST['nominativo'];

            $q = "UPDATE fornitore SET nominativo='$nominativo' WHERE idFornitore='$idFornitore'";
            $con->query($q);
        } elseif ($edit_type == 'operatore') {
            $idOperatore = $_POST['idOperatore'];
            $nominativo = $_POST['nominativo'];

            $q = "UPDATE operatore SET nominativo='$nominativo' WHERE idOperatore='$idOperatore'";
            $con->query($q);
        }
    } elseif ($action == 'delete') {
        $delete_type = $_POST['delete_type'];
        if ($delete_type == 'prodotto') {
            $QRcode = $_POST['QRcode'];

            $q = "DELETE FROM prodotto WHERE QRcode='$QRcode'";
            $con->query($q);
        } elseif ($delete_type == 'fornitore') {
            $idFornitore = $_POST['idFornitore'];

            $q = "DELETE FROM fornitore WHERE idFornitore='$idFornitore'";
            $con->query($q);

        } elseif ($delete_type == 'operatore') {
            $idOperatore = $_POST['idOperatore'];

            $q = "DELETE FROM operatore WHERE idOperatore='$idOperatore'";
            $con->query($q);

        }
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
                <th>CodiceQR</th>
                <th>Nome Prodotto</th>
                <th>Categoria</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT p.QRcode, p.nomeProd, p.categoria FROM prodotto p
                LEFT JOIN (SELECT QRcode FROM carico_prodotti GROUP BY QRcode) cp ON p.QRcode = cp.QRcode
                LEFT JOIN (SELECT QRcode FROM scarico_prodotti GROUP BY QRcode) sp ON p.QRcode = sp.QRcode 
                GROUP BY p.QRcode, p.nomeProd, p.categoria";

            $magazzino = $con->query($q);

            while ($row = $magazzino->fetch_object()) {
                echo "<tr>";
                echo "<td>$row->QRcode</td>";
                echo "<td>$row->nomeProd</td>";
                echo "<td>$row->categoria</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-edit' data-id='$row->QRcode' data-nome='$row->nomeProd' data-categoria='$row->categoria' data-toggle='modal' data-target='#editProdottoModal'>Modifica</button> ";
                echo "<button class='btn btn-danger btn-delete' data-id='$row->QRcode' data-toggle='modal' data-target='#deleteProdottoModal'>Elimina</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-1">Fornitori</h2>
    <div class="container">
        <table id="fornitoriTable" class="table table-bordered table-striped">
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
                echo "<tr>";
                echo "<td>$row->idFornitore</td>";
                echo "<td>$row->nominativo</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-edit' data-id='$row->idFornitore' data-nome='$row->nominativo' data-toggle='modal' data-target='#editFornitoreModal'>Modifica</button> ";
                echo "<button class='btn btn-danger btn-delete' data-id='$row->idFornitore' data-toggle='modal' data-target='#deleteFornitoreModal'>Elimina</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-5">Operatori</h2>
    <div class="container">
        <table id="operatoriTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>CodiceQR</th>
                <th>Nome Operatore</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "SELECT * FROM operatore";
            $res = $con->query($q);

            while ($row = $res->fetch_object()) {
                echo "<tr>";
                echo "<td>$row->idOperatore</td>";
                echo "<td>$row->nominativo</td>";
                echo "<td>";
                echo "<button class='btn btn-warning btn-edit' data-id='$row->idOperatore' data-nome='$row->nominativo' data-toggle='modal' data-target='#editOperatoreModal'>Modifica</button> ";
                echo "<button class='btn btn-danger btn-delete' data-id='$row->idOperatore' data-toggle='modal' data-target='#deleteOperatoreModal'>Elimina</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div style="margin-bottom: 20%"></div>
</div>

<!-- Modal per Modifica Prodotto -->
<div class="modal fade" id="editProdottoModal" tabindex="-1" role="dialog" aria-labelledby="editProdottoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editProdottoForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdottoModalLabel">Modifica Prodotto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editProdottoQRcode" name="QRcode">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="edit_type" value="prodotto">
                    <div class="form-group">
                        <label for="editProdottoNome">Nome Prodotto</label>
                        <input type="text" class="form-control" id="editProdottoNome" name="nomeProd" required>
                    </div>
                    <div class="form-group">
                        <label for="editProdottoCategoria">Categoria</label>
                        <input type="text" class="form-control" id="editProdottoCategoria" name="categoria" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal per Elimina Prodotto -->
<div class="modal fade" id="deleteProdottoModal" tabindex="-1" role="dialog" aria-labelledby="deleteProdottoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteProdottoForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProdottoModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare questo prodotto?
                    <input type="hidden" id="deleteProdottoQRcode" name="QRcode">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="delete_type" value="prodotto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal per Modifica Fornitore -->
<div class="modal fade" id="editFornitoreModal" tabindex="-1" role="dialog" aria-labelledby="editFornitoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editFornitoreForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFornitoreModalLabel">Modifica Fornitore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editFornitoreId" name="idFornitore">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="edit_type" value="fornitore">
                    <div class="form-group">
                        <label for="editFornitoreNome">Nome Fornitore</label>
                        <input type="text" class="form-control" id="editFornitoreNome" name="nominativo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal per Elimina Fornitore -->
<div class="modal fade" id="deleteFornitoreModal" tabindex="-1" role="dialog" aria-labelledby="deleteFornitoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteFornitoreForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFornitoreModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare questo fornitore?
                    <input type="hidden" id="deleteFornitoreId" name="idFornitore">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="delete_type" value="fornitore">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal per Modifica Operatore -->
<div class="modal fade" id="editOperatoreModal" tabindex="-1" role="dialog" aria-labelledby="editOperatoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editOperatoreForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOperatoreModalLabel">Modifica Operatore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editOperatoreId" name="idOperatore">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="edit_type" value="operatore">
                    <div class="form-group">
                        <label for="editOperatoreNome">Nome Operatore</label>
                        <input type="text" class="form-control" id="editOperatoreNome" name="nominativo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal per Elimina Operatore -->
<div class="modal fade" id="deleteOperatoreModal" tabindex="-1" role="dialog" aria-labelledby="deleteOperatoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteOperatoreForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOperatoreModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare questo operatore?
                    <input type="hidden" id="deleteOperatoreId" name="idOperatore">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="delete_type" value="operatore">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#prodottiTable').DataTable();
        $('#fornitoriTable').DataTable();
        $('#operatoriTable').DataTable();

        // Modifica Prodotto
        $('#editProdottoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var categoria = button.data('categoria');
            var modal = $(this);
            modal.find('#editProdottoQRcode').val(id);
            modal.find('#editProdottoNome').val(nome);
            modal.find('#editProdottoCategoria').val(categoria);
        });

        // Elimina Prodotto
        $('#deleteProdottoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#deleteProdottoQRcode').val(id);
        });

        // Modifica Fornitore
        $('#editFornitoreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var modal = $(this);
            modal.find('#editFornitoreId').val(id);
            modal.find('#editFornitoreNome').val(nome);
        });

        // Elimina Fornitore
        $('#deleteFornitoreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#deleteFornitoreId').val(id);
        });

        // Modifica Operatore
        $('#editOperatoreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var modal = $(this);
            modal.find('#editOperatoreId').val(id);
            modal.find('#editOperatoreNome').val(nome);
        });

        // Elimina Operatore
        $('#deleteOperatoreModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#deleteOperatoreId').val(id);
        });
    });
</script>

</body>
<?php require "footer.php"; ?>
</html>
