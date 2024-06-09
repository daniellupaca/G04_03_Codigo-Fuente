<?php
function conectarse() {
    $link = new mysqli("localhost", "root", "", "essaludbd1");
    if ($link->connect_errno) {
        die("Error al conectar a la base de datos: " . $link->connect_error);
    }
    return $link;
}
?>
