<?php
    require "connessione.php";
    $pieces = explode(";", $_POST["qrcode_str"]);
    $q = "select * from registro where qrcode = '".$_POST["qrcode_str"]."'";
    $res = $con->query($q);
    if($res->num_rows == 0) {
        $q = "insert into registro(id_utente, tipo_registro, data_registro, qrcode) values (" . intval($pieces[0]) . ",'" . $pieces[2] . "','" . $pieces[1] . "','" . $_POST["qrcode_str"] . "')";
        $res = $con->query($q);

        $q = "select * from utente where idUtente = ".intval($pieces[0]);
        $res = $con->query($q);
        $row = $res->fetch_array(MYSQLI_ASSOC);
        echo json_encode($row);
    }
?>