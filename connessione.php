<?php
// Define constants if they are not already defined
if (!defined('NOMEDATABASE')) define('NOMEDATABASE', 'magazzino');
if (!defined('SERVERDATABASE')) define('SERVERDATABASE', 'romano.noip.me');
if (!defined('USERNAME')) define('USERNAME', 'gts');
if (!defined('PASSWORD')) define('PASSWORD', '#GreenTech2023');
if (!defined('PORT')) define('PORT', 3307);

// Initialize the connection variable
$con = new mysqli(SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE, PORT);

// Check connection
if ($con->connect_error) {
    $msg = "Connection failed: " . $con->connect_error;
    $con = false;
} else {
    // No need to call select_db() if you already specify the database in the constructor
    if (!$con->select_db(NOMEDATABASE)) {
        $msg = "Database selection failed: " . $con->error;
        $con->close();
        $con = false;
    }
}

// Optionally, handle or log the message if needed
if ($con === false) {
    echo $msg; // Or log it to a file
}
?>
