<?php
$host="comp-server.uhi.ac.uk";
$user="pe16005009";
$userpass='usmanmuhammad';
$schema="pe16005009";


$conn = mysqli_connect($host,$user,$userpass,$schema);
$sqlA="select canvasid from canvastest order by shapeid desc limit 1";
$resultA = mysqli_query($conn,$sqlA);
while($rowA = mysqli_fetch_assoc($resultA)){
    $canId = $rowA['canvasid']+1;
    echo $canId;
}

