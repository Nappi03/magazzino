<?php
if (isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);
    // Ora $data contiene l'array dei risultati della query
    // Puoi elaborare i dati come desideri
    print_r($data);
} else {
    echo "Nessun dato ricevuto.";
}
?>
