<?php
require "connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // ID del prodotto
    $delta = intval($_POST['delta']); // Incremento o decremento

    // Aggiorna il valore nel database
    $stmt = $con->prepare("UPDATE prodotto SET qt = qt + :delta WHERE id = :id");
    $stmt->bindValue(':delta', $delta, SQLITE3_INTEGER);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        // Recupera il valore aggiornato
        $result = $con->querySingle("SELECT qt FROM prodotto WHERE id = $id");
        echo json_encode([
            'success' => true,
            'newQuantity' => $result
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Impossibile aggiornare il database'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Metodo non consentito'
    ]);
}
?>
