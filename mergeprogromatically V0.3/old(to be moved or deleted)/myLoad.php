<!DOCTYPE html>
<html>

<head>
    <!-- USE DEVELOPMENT VERSION -->
    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../CSS/css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <title>Konva Transform Limits Demo</title>

    <script src="../my.js"></script>

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
					<img class="isdrag" src="../Assets/test.jpg" id="bog" draggable="true"/>
					</div>
                    <hr>
                    <div class="layoutSplit">Walls
                    <img class="isdrag" src="../Assets/square.jpg" id="sqrimg" draggable="true"/>
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
				
		</div>
	</div>
		
		


    <input id="clickMe" type="button" value="load" onclick="g();" />

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
    //console.log(con);
    con.addEventListener('dragover', function (e) {
        e.preventDefault(); // !important
    });
        //console.log(con.id);

    

    var counter =0;

    con.addEventListener('drop', function (e) {
        e.preventDefault(); //! important
        //var assID = getAssetID();
        //console.log(assID);
        // now we need to find pointer position
        // we can't use stage.getPointerPosition() here, because that event
        // is not registered by Konva.Stage
       stage._setPointerPosition(e);
       //console.log("before"+counter);
       counter = counter+1;
       //console.log("after"+counter);
        //console.log(e);
        //console.log(e.id);
        // or we can calculate in manually from event properties


        Konva.Image.fromURL(currentpic, function (image) {
            layer.add(image);
			//console.log(layer.children[layer.children.length-1]);
            image.position(stage.getPointerPosition())

            image.draggable(true);
            //console.log(image.id);
            var str1 = currentpic.split("/");
            var namePos = (str1.length)-1;
            //console.log(namePos);
            str1 = str1[namePos].split(".");
            image.id= str1[0];
            //console.log("Before "+image.id);
            image.id = str1[0]+counter;
            //console.log("After "+image.id);
            //console.log(image.id);

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

		//stage.find('Transformer').destroy();
        //layer.draw();
		
        var tr = new Konva.Transformer();
        layer.add(tr);
        tr.attachTo(e.target);
        //console.log(tr);
        layer.draw();
    });

 
</script>
	</div>
	<script src="../myScript.js"></script>
</body>
</html>