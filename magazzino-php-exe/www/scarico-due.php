<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";

if (isset($_POST["qrCode"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $qrCode = $_POST["qrCode"];
        if (controllo($qrCode)) {

            $q = "SELECT * FROM prodotto WHERE QRcode = '$qrCode'";
            $result = $con->query($q);
            while ($row = $result->fetch_assoc()) {
                $nomeProd = $row['nomeProd'];
                $categoriaProd = $row['categoria'];
            }

            $q = "SELECT * FROM operatore WHERE idOperatore = '" . $_POST["operatore"] . "'";
            $result = $con->query($q);
            while ($row = $result->fetch_assoc()) {
                $operatore = $row['nominativo'];
                $idOp = $row['idOperatore'];
            }

        } else {
            echo "<body onload='document.forms[0].submit()'>
            <form action='scarico.php' method='GET'>
                <input type='hidden' name='msg' value='Seriale prodotto non esistente'>
            </form>
        </body>";
        }

    } else {
        header('location: scarico.php');
    }

} else {
    header('location: scarico.php');
}

function controllo($id)
{
    global $con;
    $q = "SELECT * FROM prodotto WHERE QRcode = '$id'";
    $result = $con->query($q);
    if ($result && $result->fetch_row() > 0) {
        return true;
    } else {
        return false;
    }
}

?>
<head>
    <title>Scarico</title>
    <?php require "include.php" ?>

</head>
<body>
<?php require "navbar.php" ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Scarico</h2>
    <form method="post" action="elabora-scarico.php?idOp=<?php echo $idOp ?>" >
        <div class="input-group mb-3" hidden="hidden">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">QrCode</span>
            </div>
            <input type="text" placeholder="<?php echo $qrCode ?>" value="<?php echo $qrCode ?>" class="form-control"
                   name="qrCode" id="qrCode"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nome</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $nomeProd ?>" value="<?php echo $nomeProd ?>"
                   class="form-control" name="nome" id="nome"
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Categoria</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $categoriaProd ?>" value="<?php echo $categoriaProd ?>"
                   class="form-control" id="categoria"
                   name="categoria"
                   aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Operatore</span>
            </div>
            <input disabled type="text" placeholder="<?php echo $operatore ?>" value="<?php echo $idOp ?>"
                   class="form-control" id="operatore"
                   name="operatore"
                   aria-describedby="basic-addon3">

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Quantità</span>
            </div>
            <input required type="text" placeholder="Quantità" class="form-control" id="quantita" name="quantita"
                   value=''
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Scarica Prodotto">
        </div>
    </form>
</div>

</body>
<?php require "footer.php"; ?>
</html>
