<?php/*
include('../php/functions.php');

setCookie("userintent", "", (time + 86400), "/~pe16007103");
session_start();

$currentuser = getUserLevel();
include("../php/links.php");
$userlvl = $currentuser['userlevel'];
*/
?>
<html lang="en-gb" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Canvas Menu</title>
    <link rel="stylesheet" type="text/css" href="../CSS/css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
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
            <div class="canvasContainer" id="canvasContainer">
                <!--<canvas id="canvas"width="900" height="730" style="border:1px solid black;"></canvas>-->
            </div>
            <div id="canvasButtons " class="btn-group pull-right fixed-bottom" role="group">
                <a class="btn btn-success" href="#">Save</a>
                <a class="btn btn-danger" href="#">Clear</a>
            </div>
        </div>
    </div>
	    <!--<div id="container"></div>-->
	 <script>

   var xpos;
   var ypos;
	  
    var stage = new Konva.Stage({
      container: 'canvasContainer',
      width: 900,
      height: 730
    });

    var layer = new Konva.Layer();

	 // add the layer to the stage
    stage.add(layer); 
	  
    var rect = new Konva.Rect({
      x: 0,
      y: 0,
      width: 100,
      height: 50,
      fill: 'green',
	  draggable: true
    });

	  	 // add the shape to the layer
     layer.add(rect); 
	  
	  //draw the layer
   	 layer.draw();
	  
	  
	  rect.on('dragend',function() {
		  
	 var xpos = rect.x();
     var ypos = rect.y();
	 var swidth = rect.width();
	 var sheight = rect.height();
	 
		  
	 document.getElementById("xpos").value = xpos;
     document.getElementById("ypos").value = ypos;
	 document.getElementById("swidth").value = swidth;
     document.getElementById("sheight").value = sheight;  
	 
		  
		 
	  });
	  
	  
      //document.write(ypos);
	  
	
	  
	  /*
	  rect.on('dblclick',function() {
		 // create new transformer
      var tr = new Konva.Transformer();
      layer.add(tr);
      tr.attachTo(rect);
      layer.draw();
	 
	 
	 });
	  */
	 

	  
	  

    
	  
	  
	  stage.on('dblclick', function (e) {
      // if click on empty area - remove all transformers
      if (e.target === stage) {
        stage.find('Transformer').destroy();
        layer.draw();
        return;
      }
		  
		 var tr = new Konva.Transformer();
		  layer.add(tr);
		  tr.attachTo(e.target);
		  layer.draw();
		    
		  
		  
	  });
	  
	  
	  rect.on('transformend', function () {
      
		
		  
      console.log('transformend');
    
	  });
	  
	  
	  
	  rect.on('transform', function () {
      
		  
	  var xscale = rect.scaleX();
	  var yscale = rect.scaleY();
	  var rotation = rect.rotation();
		
	  document.getElementById("xscale").value = xscale;
	  document.getElementById("yscale").value = yscale;  
	  document.getElementById("rotation").value = rotation;
		 
		  
      console.log('transform');
   
	  });
	  
	  
	  
	  
	  
	  
		 
	  
	
	  
	  /*
      // do nothing if clicked NOT on our rectangles
      if (!e.target.hasName('rect')) {
        return;
      }
      // remove old transformers
      // TODO: we can skip it if current rect is already selected
      stage.find('Transformer').destroy();

      // create new transformer
      var tr = new Konva.Transformer();
      layer.add(tr);
      tr.attachTo(e.target);
      layer.draw();
    })
	  */
	  
  </script>
  <div class="canvasContainer" id="registerF">
        <form  name="loginform" id="loginform" action="postdrag.php" method="post">
            <div class="form-group">
                <label>xpos</label>
                <input type="text" id="xpos" name="xpos">
            </div>
            <div class="form-group">
                <label>ypos</label>
                <input type="text" id="ypos" name="ypos">
            </div>
            <div class="form-group">
                <label>swidth</label>
                <input type="text" id="swidth" name="swidth">
            </div>
            <div class="form-group">
                <label>sheight</label>
                <input type="text" id="sheight" name="sheight">
            </div>
			<div class="form-group">
                <label>scaleX</label>
                <input type="text" id="xscale" name="xscale">
            </div>
            <div class="form-group">
                <label>scaleY</label>
                <input type="text" id="yscale" name="yscale">
            </div>
			<div class="form-group">
                <label>rotation</label>
                <input type="text" id="rotation" name="rotation">
            </div>

            <input type="submit" id="login" class="btn btn-outline-secondary/">
        </form>

    </div>
</div>


<script src="../myScript.js"></script>
</body>
</html>