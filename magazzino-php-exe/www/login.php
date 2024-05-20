<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <?php

                    require 'connessione.php';

                    // Verifica se il form è stato inviato
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        global $con;
                        // Ottieni i valori inseriti dall'utente
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        // Esegue la validazione dei dati
                        if (validateLogin($email, $password)) {
                            session_start();
                            // Login valido, puoi eseguire l'accesso o reindirizzare a una pagina successiva
                            echo "<div class='alert alert-success'>Login effettuato con successo!</div>";

                            $q = "select * from utente where email = '" . $email . "'";
                            $res = $con->query($q);
                            $row = $res->fetchArray(SQLITE3_ASSOC);

                            $_SESSION["USER_ID"] = $row["idUtente"];
                            $_SESSION["nome"] = $row["nome"];
                            $_SESSION["cognome"] = $row["cognome"];
                            $_SESSION["username"] = $row["username"];
                            $_SESSION["USER_ALL"] = $row;

                            Header('location: dashboard.php');
                        } else {
                            // Login non valido, mostra un messaggio di errore
                            echo "<div class='alert alert-danger'>Email o password non validi.</div>";
                        }
                    }

                    // Funzione per validare l'email e la password
                    function validateLogin($email, $password)
                    {
                        global $con;
                        $q = "select email, password from utente where email = '" . $email . "'";
                        $res = $con->query($q);

                        if($res != false){
                            $row = $res->fetchArray(SQLITE3_ASSOC);
                            if (isset($row) && $password == $row["password"]){
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    }

                    ?>

                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary float-right">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
<?php require "footer.php"; ?>
</html>
