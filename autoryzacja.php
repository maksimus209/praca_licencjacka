<?php
    $dbhost='localhost';
    $dbuser='22_shvets';
    $dbpass='132435maxik';
    $dbname='22_shvets';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}
?>