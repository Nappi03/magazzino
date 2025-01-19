<!DOCTYPE html>
<html>
<?php
session_start();
require "connessione.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $q = "SELECT * FROM prodotto WHERE QRcode = '$id'";
    $prodotto = $con->query($q);
    while ($row = $prodotto->fetchArray(SQLITE3_ASSOC)) {
        $nome = $row['nomeProd'];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST['nome'];
    $sql = "UPDATE prodotto SET nomeProd = '$nome' WHERE QRcode = '$id'";
    echo "QUERY " . $sql;
    $con->query($sql);
    Header("location: dashboard.php");

}

?>
<head>
    <?php require "include.php";?>
    <title>Modifica Prodotto: <?php echo $nome;?></title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Modifica Prodotto: <?php echo $nome ?></h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group">
                            <label for="nominativo">Nome:</label>
                            <input type="text" class="form-control" name="nome" placeholder="Inserisci il nuovo nome"
                                   required>
                            <input hidden="hidden" type="text" class="form-control" name="id" value="<?php echo $id ?>">
                        </div>
                        <button type="submit"  class="btn btn-primary">Salva Modifica</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>