<!DOCTYPE html>
<html>
<head>
    <title>Form di Registrazione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>

<?php
session_start();
require 'connessione.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pss = $_POST["password"];

    $q = "INSERT INTO utente (nome, cognome, username, email, password) VALUES('$nome','$cognome','$username','$email','$pss')";

    $_SESSION["start"] = $q;

    $result = $con->query($q);

    Header("location: login.php");

}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Registrazione</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group">
                            <label for="nominativo">Nome:</label>
                            <input type="text" class="form-control" name="nome" placeholder="Inserisci il tuo nome" required>
                        </div>
                        <div class="form-group">
                            <label for="nominativo">Cognome:</label>
                            <input type="text" class="form-control" name="cognome" placeholder="Inserisci il tuo cognome" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" placeholder="Scegli un username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Inserisci la tua email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="pss" name="password" placeholder="Scegli una password"
                                   onkeyup="checkpass()" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Conferma Password:</label>
                            <input type="password" class="form-control" id="confirm_password" placeholder="Conferma la password"
                                   onkeyup="checkpass()"
                                   required>
                            <label id="msg"></label>
                        </div>
                        <button type="submit" id="sub" class="btn btn-primary" disabled>Registrati</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    function checkpass() {
        if ($('#confirm_password')[0].value == $('#pss')[0].value) {

            $('#msg')[0].innerHTML = "Password confermata";
            $('#msg')[0].style.color = 'green';
            $('#sub')[0].disabled = false;

        } else {
            $('#msg')[0].innerHTML = "Password non confermata";
            $('#msg')[0].style.color = 'red';
            $('#sub')[0].disabled = true;
        }
    }


</script>

</body>
</html>