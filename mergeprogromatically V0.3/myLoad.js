/*
//https://stackoverflow.com/questions/2706701/getting-id-of-any-tag-when-mouseover
function getAssetID() {
    document.ondrag = function (e) {
        //console.log(e.target.id);
        global var assetID = e.target.id;
        //console.log(assetID + "test");
    }
}
*/

function load(){
    layer.clear();
    var grabImages = layer.find('Image');
    var arShapeid1 = [];
    var arShapeid = [];
    var arXpos = [];
    var arYpos = [];
    var arSwidth = [];
    var arSheight = [];
    var arXscale = [];
    var arYscale = [];
    var arRotation = [];
    var canvasID = document.getElementById("canvasID").value;
    function getArray(callback) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState===4){ //request done
                console.log("request =4");
                if(xmlhttp.status===200){//successfully
                    var data = JSON.parse(xmlhttp.responseText);
                    callback (data);
                }else{console.log(xmlhttp.status);}
            }
        };
        xmlhttp.open("GET","loadajax.php?q=true&canvasID="+canvasID,true);
        xmlhttp.send();

    }
	getArray(function (resultt) {
		result = Object.keys(resultt).map(function (key) {
			return [Number(key), resultt[key]];
        })
		console.log(result);
        for(var j=0;j<result.length;j++){
            arShapeid1[j]=result[j][1]['shapeid1'];
            arShapeid[j]=result[j][1]['shapeid'];
            arXpos[j]=result[j][1]['xpos'];
            arYpos[j]=result[j][1]['ypos'];
            arSwidth[j]=result[j][1]['swidth'];
            arSheight[j]=result[j][1]['sheight'];
            arXscale[j]=result[j][1]['xscale'];
            arYscale[j]=result[j][1]['yscale'];
            arRotation[j]=result[j][1]['rotation'];
		}
        /*
        for(var i=0;i<arShapeid.length;i++){
            console.log(arShapeid[i]);
            switch(arShapeid[i]){
                case 137:
                imageObj.src = '/Assets/test.jpg';
                break;
                case 136:
                imageObj.src = '/Assets/square.jpg';
                break;
            }
        }
		*/









        for(let i=0;i<arShapeid.length;i++) {

            var imageSRC = arShapeid1[i].replace(/\d+$/, '');

            var imgSRC = "";
            switch(imageSRC){
                case "test":
                    imgSRC = '/Assets/test.jpg';
                break;
                case "square":
                    imgSRC = '/Assets/square.jpg';
                break;
            }


            Konva.Image.fromURL(imgSRC, function (image) {
                layer.add(image);
                var widthR = Math.round(arSwidth[i] * arXscale[i]);
                var heightR = Math.round(arSheight[i] * arYscale[i]);
                image.x(arXpos[i]);
                image.y(arYpos[i]);
                image.width(widthR);
                image.height(heightR);
                //var roat = 45;
                //image.rotation(roat);
                //console.log(arRotation[1]+"roatations")
                image.draggable(true);
                layer.draw();
            });
        }

    })

}