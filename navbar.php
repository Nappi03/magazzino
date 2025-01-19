<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="fornitore.php">Lista Fornitori</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="operatore.php">Lista Operatore</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="nuovo-fornitore.php">Nuovo Fornitore</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="nuovo-operatore.php">Nuovo Operatore</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="nuovo-prodotto.php">Nuovo prodotto</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="scelta-carico.php">Carico</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-2" href="scelta-scarico.php">Scarico</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <div class="dropdown">
                        <button class="dropbtn"><?php echo $_SESSION["nome"] . " " . $_SESSION["cognome"] ?></button>
                        <div class="dropdown-content">
                            <a href="impostazioni.php">Impostazioni</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</nav>