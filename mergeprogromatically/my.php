<?php
    include('functions.php');
?>

<!DOCTYPE html>
<html>

<head>
    <!-- USE DEVELOPMENT VERSION -->
    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <title>Konva Transform Limits Demo</title>

    <script src="my.js"></script>

	</head>
	

<body>
	
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div class="tabContainer">
                <div class="buttonContainer">
                <button onclick="showPanel(0,'#adadad')">Layout</button>
                <button onclick="showPanel(1,'#bababa')">Kitchen</button>
                <button onclick="showPanel(2,'#bfbfbf')">Bed Bath</button>
                <button onclick="showPanel(3,'#c4c4c4')">Living</button>
                </div>
                <div class="tabPanel" >
                    <div class="layoutSplit" id="roomShapes">Room Shapes
					<img class="isdrag" src="Assets/test.jpg" id="bog" draggable="true"/>
					<img class="isdrag" src="Assets/testweb.jpg" id="web" draggable="true"/>
					</div>
                    <hr>
                    <div class="layoutSplit">Walls
                    <img class="isdrag" src="Assets/square.jpg" id="sqrimg" draggable="true"/>
					</div>
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
			<div id="container"></div>
				<div class="container" id="saveB">
					<!-- this form is used to submit the data for the canvas to the php on the same page-->
					<form name="saveBox" id="saveBox" action="" method="POST">
						<div class="form-group">
							<input type="text" hidden id ="width1" name ="width1">
						</div>
						<div class="form-group">
                			<input type="text" hidden id="height1" name="height1">
            			</div>
           				<div class="form-group">
                			<label>xpos</label>
                			<input type="text"  id="xpos" name="xpos">
            			</div>
            			<div class="form-group">
               				<label>ypos</label>
                			<input type="text"  id="ypos" name="ypos">
            			</div>
            			<div class="form-group">
                			<label>rotation</label>
                			<input type="text" id="rotation" name="rotation">
            			</div>
						<input type="submit" id="save_btn" name="save_btn">
						<a href="myL.php" class="button">Go to load Page</a>
					</form>
			</div>
		</div>
	</div>
		
		<!--
				<div id="canvasButtons " class="btn-group pull-right fixed-bottom" role="group">
					<a class="btn btn-success" href="#">Save</a>
					<a class="btn btn-danger" href="#">Clear</a>
				</div>
			</div>
		</div>

-->
	
	
	
	
	
<?php
    $xpos = "";
    $ypos = "";
    $width1 = "";
    $height1 = "";
    $rotation = "";
    //checks for the button click and then carry's out the save
    if(isset($_REQUEST['save_btn'])){
        //creates a connection with the sql database
        $db = createConnection();
        //get the data that is passed and stores it in variables
        $xpos = $_POST['xpos'];
        $ypos = $_POST['ypos'];
        $width1 = $_POST['width1'];
        $height1 = $_POST['height1'];
        $rotation = $_POST['rotation'];

        //inserts the data into the sql database
        $insertquery="insert into canvastest (xpos, ypos, swidth, sheight,rotation) values (?,?,?,?,?);";
        $inst=$db->prepare($insertquery);
        $inst->bind_param("ddddd", $xpos, $ypos, $width1, $height1,$rotation);
        $inst->execute();
        $inst->close();
        $db->close();

        //outputs a message to the user telling the details submitted
        $message = "Done Height:".$height1." Width:".$width1." Xpos:".$xpos." Ypos:".$ypos." Rotation:".$rotation;
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
        echo "not submitted";
    }
?>

<script>
    //var width = window.innerWidth;
    //var height = window.innerHeight;

    //thes two variables hold the size of the canvas
    var width = 600;
    var height = 400;
	var currentpic="";
	
    var stage = new Konva.Stage({
        container: 'container',
        //the two lines below set the size of the canvas using the details for the variables initialised before
        width: width,
        height: height
    });
	
	
	var srcimgs=document.getElementsByClassName("isdrag");
	for(i=0;i<srcimgs.length;i++) {
		srcimgs[i].addEventListener("drag", function(e) {	
			currentpic=e.srcElement.src;
		});
	}
    var layer = new Konva.Layer();
    stage.add(layer);


    //drag and drop code

    var con = stage.getContainer();
    console.log(con);
    con.addEventListener('dragover', function (e) {
        e.preventDefault(); // !important
    });
        console.log(con.id);

    /*
    var domDragSel;

    for(var i=0; i<10; i++){
        document.getElementById("test").addEventListener("mouseover", mouseOver[i]);

        function mouseOver() {

        }
        mouseOver.name === 'mouseOver'+i;
    }
    */


    con.addEventListener('drop', function (e) {
        e.preventDefault(); //! important
        //var assID = getAssetID();
        //console.log(assID);
        // now we need to find pointer position
        // we can't use stage.getPointerPosition() here, because that event
        // is not registered by Konva.Stage
       stage._setPointerPosition(e);
        
       //console.log(e.id);
        // or we can calculate in manually from event properties
        Konva.Image.fromURL(currentpic, function (image) {
            layer.add(image);
			// console.log(layer.children[layer.children.length-1]);
            image.position(stage.getPointerPosition())

            image.draggable(true);

            layer.draw();
        });
    })


	
    

    stage.on('dblclick', function (e) {
        // if click on empty area - remove all transformers
        if (e.target === stage) {
            stage.find('Transformer').destroy();
            layer.draw();
            return;
        }

        var tr = new Konva.Transformer();
        layer.add(tr);
        tr.attachTo(rect);
        layer.draw();
    });

    rect.on('transform', function () {
        //sets the width and height using the scale
        //when the shape is resized then it will use the scale to multiply the original size
        //also outputs the values to the form
        var width1 = rect.attrs["width"] * rect.attrs["scaleX"];
        var height1 = rect.attrs["height"] * rect.attrs["scaleY"];

        document.getElementById("width1").value = width1;
        document.getElementById("height1").value =height1;


        //gets the x and y coordinates and outputs them to the form
        var xpos = rect.x();
        var ypos = rect.y();

        document.getElementById("xpos").value = xpos;
        document.getElementById("ypos").value = ypos;


        //Checks what the rotation is if the shape is spun anticlockwise it will go to 360 and not -0
        //also makes sure if the shape is spun multiple time the value for rotation is changed to 0 and not 361
        //then it outputs the rotation to the form
        var rotation = rect.rotation();
        if(rotation > 0 && rotation <= 360){
            var rotation = rect.rotation();
        }else if(rotation > 360){
            while(rotation > 360) {
                var rotation = rotation - 360;
            }
        }else{
            while(rotation < 0) {
                var rotation = rotation + 360;
            }
        }

        document.getElementById("rotation").value = rotation;
    })


</script>
	</div>
	<script src="myScript.js"></script>
</body>
</html>