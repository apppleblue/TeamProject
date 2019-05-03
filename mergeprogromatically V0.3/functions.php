<?php
function createConnection() {
    $host="comp-server.uhi.ac.uk";
    $user="pe16005009";
    $userpass='usmanmuhammad';
    $schema="pe16005009";
    $conn = new mysqli($host,$user,$userpass,$schema);
    if(mysqli_connect_errno()) {
        echo "Could not connect to database: ".mysqli_connect_errno();
        exit;
    }
    return $conn;
}