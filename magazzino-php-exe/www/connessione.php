<?php
// URL dell'API
$url = "http://worldtimeapi.org/api/timezone/Europe/Rome";

// Effettua la richiesta HTTP
$response = file_get_contents($url);

// Decodifica la risposta JSON
$data = json_decode($response, true);

// Controlla se la richiesta ha avuto successo
if ($data && isset($data['datetime'])) {
    $currentDateTime = new DateTime($data['datetime']);
    $expirationDate = new DateTime('2025-05-30'); // Data di scadenza desiderata

    if ($currentDateTime > $expirationDate) {
        // La data corrente supera la data di scadenza, esegui il refresh della pagina
        $page = $_SERVER['PHP_SELF'];
        $sec = "10"; // Intervallo di refresh in secondi
        header("Refresh: $sec; url=$page");
    } else {
        // Connessione al database SQLite
        $con = new SQLite3('DB/magazzino.db');

    }
}
?>
