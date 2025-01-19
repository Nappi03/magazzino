<!DOCTYPE html>
<html>
<head>
    <?php require "include.php"; ?>
    <title>Modifica Prodotto</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Modifica Prodotto</h3>
                </div>
                <div class="card-body">
                    <?php
                    session_start();
                    require "connessione.php";

                    $nome = "";
                    $id = "";

                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $q = "SELECT * FROM prodotto WHERE QRcode = '$id'";
                        $prodotto = $con->query($q);
                        while ($row = $prodotto->fetch_object()) {
                            $nome = $row->nomeProd;
                        }
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["nome"])) {
                        $id = $_POST["id"];
                        $nome = $_POST['nome'];
                        $sql = "UPDATE prodotto SET nomeProd = '$nome' WHERE QRcode = '$id'";
                        echo "QUERY " . $sql;
                        $con->query($sql);
                        header("Location: index.php");
                        exit();
                    }
                    ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" placeholder="Inserisci il nuovo nome"
                                   value="<?php echo htmlspecialchars($nome); ?>" required>
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Salva Modifica</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>
</body>
</html>
