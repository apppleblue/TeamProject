<?php
include('functions.php');
//creates a connection with the sql database
$db = createConnection();
$shapeid1=array();
$shapeid=array();
$xpos=array();
$ypos=array();
$swidth=array();
$sheight=array();
$xscale=array();
$yscale=array();
$rotation=array();
$details=array();

$host="comp-server.uhi.ac.uk";
$user="pe16005009";
$userpass='usmanmuhammad';
$schema="pe16005009";

$conn = mysqli_connect($host,$user,$userpass,$schema);


/*
$sqlA="select canvasid from canvastest order by shapeid desc limit 1";
$resultA = mysqli_query($conn,$sqlA);
while($rowA = mysqli_fetch_assoc($resultA)){
    $canId = $rowA['canvasid'];
}
*/

//int $canvasid = document.getElementById("canvasID").value;

if(isset($_GET['canvasID'])) {
    $canvasID = $_GET['canvasID'];
}

$sql="select shapeid1, shapeid, xpos, ypos, swidth, sheight, xscale, yscale, rotation from canvastest where canvasid = $canvasID";
$result = mysqli_query($conn,$sql);
$i=0;

$temp = array();
while($row = mysqli_fetch_assoc($result)){
    $temp[$i] = $row;
    //print_r(array_values($temp[$i])[0]);
    $i++;
}
if(isset($_GET['q'])){
$q =$_GET['q'];


	if($q=="true"){
	
		//echo json_encode($details);
        //$out = array_values($temp);
        //json_encode($out);
        echo json_encode($temp,JSON_FORCE_OBJECT);
	}
	
	
} else{echo 'isnotset';}
?>