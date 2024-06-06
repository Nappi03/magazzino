<?php
require "connessione.php";
// Esegui la query
$q = "SELECT p.QRcode, p.nomeProd, p.categoria, IFNULL(SUM(cp.qt - IFNULL(sp.qt, 0)), 0) AS quantita_in_magazzino 
      FROM prodotto p
      LEFT JOIN (SELECT QRcode, SUM(qt) AS qt FROM carico_prodotti GROUP BY QRcode) cp ON p.QRcode = cp.QRcode
      LEFT JOIN (SELECT QRcode, SUM(qt) AS qt FROM scarico_prodotti GROUP BY QRcode) sp ON p.QRcode = sp.QRcode 
      GROUP BY p.QRcode, p.nomeProd, p.categoria";

$magazzino = $con->query($q);

// Memorizza i risultati in un array
$result_array = [];
while ($row = $magazzino->fetchArray(SQLITE3_ASSOC)) {
    $result_array[] = $row;
}

// Codifica i risultati in JSON
$json_result = json_encode($result_array);

// Invia i dati JSON a un'altra pagina PHP
$ch = curl_init('dashboard-smartphone.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $json_result]);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
$response = curl_exec($ch);
curl_close($ch);

?>
