<?php
include('functions.php');
$db = createConnection();
$sql="select canvasid from canvastest order by shapeid desc limit 1";
$stmt=$db->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $canId);
while($stmt->fetch()){

}
$stmt->close();
$db->close();
echo $canId."before";
$canId++;
echo $canId;