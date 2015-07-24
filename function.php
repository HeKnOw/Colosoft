<?php
$dbhost='localhost';
$dbname='photospace';
$dbuser='root';
$dbpass='';
$appname='PhotoSpace';

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($connection->connect_error)
    die($connection->connect_error);
?>