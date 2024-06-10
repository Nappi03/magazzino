<?php
if(!defined ('NOMEDATABASE'  )) define ('NOMEDATABASE'  ,'magazzino');
if(!defined ('SERVERDATABASE')) define ('SERVERDATABASE','127.0.0.1');
if(!defined ('USERNAME'      )) define ('USERNAME'      ,'root');
if(!defined ('PASSWORD'      )) define ('PASSWORD'      ,'');

$con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD);

if ($con->connect_error) {
    $msg= $con->connect_error;
    $con = false;
}
if(!$con->select_db(NOMEDATABASE)) {
    $msg = "La tabella <b>\"".NOMEDATABASE."\"</b>".": not esiste";
    $con->close();
    $con = false;
}
?>
