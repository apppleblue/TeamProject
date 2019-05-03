<?php
//include('functions.php');
//$db = createConnection();

    $host="comp-server.uhi.ac.uk";
    $user="pe16005009";
    $userpass='usmanmuhammad';
    $schema="pe16005009";

$conn = mysqli_connect($host,$user,$userpass,$schema);

//get canvasid from table
$sqlA="select canvasid from canvastest order by shapeid desc limit 1";
$resultA = mysqli_query($conn,$sqlA);
while($rowA = mysqli_fetch_assoc($resultA)){
    $canId = $rowA['canvasid'];
}
echo 'Canvas ID '.$canId;
echo "<br>";

//





$sql="select shapeid, xpos, ypos, swidth, sheight, xscale, yscale, rotation from canvastest where canvasid = $canId";
$result = mysqli_query($conn,$sql);
$i=0;

$temp = array();
$temp1 = array();
while($row = mysqli_fetch_assoc($result)){
    $temp[$i] = $row;
    print_r(array_values($temp[$i])[0]);
    echo "<br>";
    $i++;
}

echo "Count ".count($temp);

//print_r($temp1);