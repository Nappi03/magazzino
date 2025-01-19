<!DOCTYPE html>
<?php require "connessione.php";
session_start();

if (!isset($_SESSION["USER_ID"])) Header("location: login.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST["action"]) {
        case "save":
            $query = "update utente set ";
            $added = false;
            if ($_POST["nome"] != $_SESSION["nome"]) {
                $query .= "nome = '" . $_POST["nome"] . "' ";
                $added = true;
            }
            if ($_POST["cognome"] != $_SESSION["cognome"]) {
                $query .= "cognome = '" . $_POST["cognome"] . "' ";
                $added = true;
            }
            if ($_POST["PasswordAttuale"] != "") {
                if (password_verify($_POST["PasswordAttuale"], $_SESSION["USER_ALL"]["Password"])) {
                    if ($_POST["PasswordNuova"] == $_POST["PasswordConfermata"]) {
                        if ($_POST["PasswordNuova"] == $_POST["PasswordAttuale"] or strlen($_POST["PasswordNuova"]) < 8) {
                            echo "<script>alert('Password già utilizzata oppure password con meno di 8 caratteri')</script>";
                        } else {
                            if ($added) $query .= "and ";

                            $query .= "password = '" . password_hash($_POST["PasswordNuova"], PASSWORD_BCRYPT) . "' ";
                        }
                    }
                }
            }
            if ($query != "update utente set ") {
                $query .= "where idUtente = " . $_SESSION["USER_ALL"]["USER_ID"];
                $result = $con->query($query);
                Header("Location: logout.php");
            }
            break;
        case "delete":
            break;
        default:
            Header("Location: dashboard.php");
            break;
    }
}


?>
<html>
<head>
    <title>Gestione Utente</title>
    <link href="css/main.css" rel="stylesheet"/>
    <?php require "include.php" ?>
</head>
<body>

<?php require "navbar.php"; ?>

<div class="container" style="background-color: #f2f2f5;border-radius: 16px;padding: 2%;margin-top: 3%;">
    <h2>Gestione Utente</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nome</span>
            </div>
            <input type="text" class="form-control" name="nome" id="nome"
                   value='<?php echo $_SESSION["USER_ALL"]["nome"] ?>' aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Cognome</span>
            </div>
            <input type="text" class="form-control" name="cognome" id="cognome"
                   value='<?php echo $_SESSION["USER_ALL"]["cognome"] ?>' aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Email</span>
            </div>
            <input disabled type="text" class="form-control" id="Email" name="Email"
                   value='<?php echo $_SESSION["USER_ALL"]["email"] ?>' aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Username</span>
            </div>
            <input disabled type="text" class="form-control" id="Username" name="Username"
                   value='<?php echo $_SESSION["USER_ALL"]["username"] ?>' aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Password attuale</span>
            </div>
            <input type="password" class="form-control" id="PasswordAttuale" name="PasswordAttuale" value=''
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Password nuova</span>
            </div>
            <input type="password" class="form-control" id="PasswordNuova" name="PasswordNuova" value=''
                   aria-describedby="basic-addon3">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Password nuova rinconferma</span>
            </div>
            <input type="password" class="form-control" id="PasswordConfermata" name="PasswordConfermata" value=''
                   aria-describedby="basic-addon3">
        </div>
        <div>
            <button type="submit" class="btn btn-success" onclick="setAction('save')">Salva modifiche</button>
            <button type="submit" class="btn btn-danger" onclick="setAction('delete')">Elimina Account</button>
            <button type="submit" class="btn btn-dark" onclick="setAction('back')">Ritorna alla Home</button>
        </div>
        <input id="action" value="" name="action" style="opacity: 0">
    </form>
</div>
</body>
<script>
    function setAction(action) {
        document.getElementById("action").value = action;
    }
</script>
</html>
