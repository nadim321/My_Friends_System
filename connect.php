<?php
try {
    // database credential and connect
    $conn = new PDO(
        "mysql:host=localhost;dbname=s104100247_db",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

?>