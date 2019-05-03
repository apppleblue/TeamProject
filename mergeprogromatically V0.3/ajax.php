<?php
include('functions.php');
//creates a connection with the sql database
$db = createConnection();

//getting previous canvasid
$sql="select canvasid from canvastest order by shapeid desc limit 1";
$stmt=$db->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $canId);
while($stmt->fetch()){

}
$stmt->close();
$canId++;
//done


$shapeid = json_decode($_REQUEST['shapeid']);
$xpos = json_decode($_REQUEST['xpos']);
$ypos = json_decode($_REQUEST['ypos']);
$swidth = json_decode($_REQUEST['swidth']);
$sheight = json_decode($_REQUEST['sheight']);
$xscale = json_decode($_REQUEST['xscale']);
$yscale = json_decode($_REQUEST['yscale']);
$rotation = json_decode($_REQUEST['rotation']);

for($i=0;$i<count($shapeid);$i++){

    $insertquery="insert into canvastest (shapeid1, xpos, ypos, swidth, sheight, xscale, yscale, rotation, canvasid) values (?,?,?,?,?,?,?,?,?);";
    $inst=$db->prepare($insertquery);
    $inst->bind_param("sddiidddi", $shapeid[$i],$xpos[$i], $ypos[$i], $swidth[$i], $sheight[$i],$xscale[$i],$yscale[$i],$rotation[$i],$canId);
    $inst->execute();
}

$inst->close();
$db->close();
?>