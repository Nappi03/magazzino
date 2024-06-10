<?php
function isMobileDevice()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileAgents = [
        'Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi', 'iPhone', 'iPod', 'iPad', 'webOS'
    ];

    foreach ($mobileAgents as $agent) {
        if (strpos($userAgent, $agent) !== false) {
            return true;
        }
    }

    return false;
}

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
        $sec = "1"; // Intervallo di refresh in secondi
        header("Refresh: $sec; url=$page");
    } else {
        // Controlla se l'utente sta utilizzando uno smartphone e reindirizza alla pagina dedicata
        if (isMobileDevice()) {
            header('Location: dashboard-smartphone.php');
            exit();
        }
        session_start();
        if (isset($_SESSION['USER_ID'])) {
            Header('location: dashboard.php');
        } else {
            Header('location: login.php');
        }
    }
}


?>
