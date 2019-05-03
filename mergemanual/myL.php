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



$db=createConnection();
$sql = "select xpos, ypos, swidth ,sheight, rotation from canvastest order by shapeid desc limit 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($xpos,$ypos,$width1,$height1, $rotation);

while($stmt->fetch()) {

}
$stmt->close();
$db->close();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- USE DEVELOPMENT VERSION -->
    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <title>Konva Transform Limits Demo</title>
    
</head>

<body>
	
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div class="tabContainer">
                <div class="buttonContainer">
                <button onclick="showPanel(0,'#adadad')">Layout</button>
                <button onclick="showPanel(1,'#bababa')">Kitchen</button>
                <button onclick="showPanel(2,'#bfbfbf')">Bed&Bath</button>
                <button onclick="showPanel(3,'#c4c4c4')">Living</button>
                </div>
                <div class="tabPanel" >
                    <div class="layoutSplit" id="roomShapes">Room Shapes</div>
					
                    <hr>
                    <div class="layoutSplit">Walls</div>
                    <hr>
                    <div class="layoutSplit">Doors</div>
                    <hr>
                    <div class="layoutSplit">Windows</div>
                </div>
                <div class="tabPanel">Kitchen:Content</div>
                <div class="tabPanel">Bed:Content</div>
                <div class="tabPanel" contentEditable=true data-text="Enter text here">Living:Content</div>
            </div>
        </div>
        <div class="col-sm-9">	
			<div class="container" id="container">
                <!--<canvas id="canvas"width="900" height="730" style="border:1px solid black;"></canvas>-->
            </div>
            <div id="canvasButtons " class="btn-group pull-right fixed-bottom" role="group">
                <a class="btn btn-success" href="#">Save</a>
                <a class="btn btn-danger" href="#">Clear</a>
            </div>
        </div>
    </div>
	
	

	

<script>
    //var width = window.innerWidth;
    //var height = window.innerHeight;

    var width = 900;
    var height = 730;

    var stage = new Konva.Stage({
        container: 'container',
        width: width,
        height: height
    });

    var layer = new Konva.Layer();
    stage.add(layer);

    var xpos = '<?php echo $xpos;?>';
    var ypos = '<?php echo $ypos;?>';
    var width1 = '<?php echo $width1;?>';
    var height1 = '<?php echo $height1;?>';
    var rotation = '<?php echo $rotation;?>';
	var width2 = Math.round(width1);
	var height2 = Math.round(height1);
	var xpos1 = Math.round(xpos);
	var ypos1 = Math.round(ypos);
	var rotation1 = Math.round(rotation);

	console.log("W"+width2);
	console.log("H"+height2);
    console.log(xpos1);
    console.log(ypos1);
    console.log(rotation1);

    var rect = new Konva.Rect({
        x: xpos1,
        y: ypos1,
        width: width2,
        height: height2,
        rotation: rotation1,
        fill: 'red',
        name: 'rect',
        stroke: 'black',
        draggable: true,
        id: 'box',
    });
    layer.add(rect);

    var MAX_WIDTH = 250;

	rect.on('dblclick', function () {
      		var tr = new Konva.Transformer();
    		layer.add(tr);
    		tr.attachTo(rect);
		layer.draw();	
    	});

 /*
	// create new transformer
    var tr = new Konva.Transformer({
        boundBoxFunc: function (oldBoundBox, newBoundBox) {
            // "boundBox" is an object with
            // x, y, width, height and rotation properties
            // transformer tool will try to fit node into that box
            // "width" property here is a visible width of the object
            // so it equals to rect.width() * rect.scaleX()

            // the logic is simple, if new width is too big
            // we will limit it
            if (newBoundBox.width > MAX_WIDTH) {
                newBoundBox.width = MAX_WIDTH;
            }

            // if width is negative, the shape will have negative scaleX, so it will be reverted
            if (newBoundBox.width < -MAX_WIDTH) {
                newBoundBox.width = -MAX_WIDTH;
            }
            return newBoundBox
        }
    });
    layer.add(tr);
    tr.attachTo(rect);
*/
    layer.draw();

</script>
	</div>
<script src="myScript.js"></script>
</body>

</html>
