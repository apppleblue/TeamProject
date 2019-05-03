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


function g(){
    var grabImages = layer.find('Image');
    //console.log("Before " + arShapeid);
    var arShapeid = [];
    var arXpos = [];
    var arYpos = [];
    var arSwidth = [];
    var arSheight = [];
    var arXscale = [];
    var arYscale = [];
    var arRotation = [];


    for(var i=0;i<grabImages.length;i++){
        arShapeid[i] = grabImages[i].id;
        arXpos[i] = grabImages[i].attrs.x;
        arYpos[i] = grabImages[i].attrs.y;
        arSwidth[i] = grabImages[i].attrs.image.width;
        arSheight[i] = grabImages[i].attrs.image.height;
        arXscale[i] = grabImages[i].attrs.scaleX;
        arYscale[i] = grabImages[i].attrs.scaleY;
        arRotation[i] = grabImages[i].attrs.rotation;
    }

    //console.log("After " + arShapeid);

    var arShapeid = JSON.stringify(arShapeid);
    var arXpos = JSON.stringify(arXpos);
    var arYpos = JSON.stringify(arYpos);
    var arSwidth = JSON.stringify(arSwidth);
    var arSheight = JSON.stringify(arSheight);
    var arXscale = JSON.stringify(arXscale);
    var arYscale = JSON.stringify(arYscale);
    var arRotation = JSON.stringify(arRotation);


    function getArray(callback) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState===4){ //request done
                console.log("request =4");
                if(xmlhttp.status===200){//successfully
                    console.log("status=200");
                    var JSONresult = xmlhttp.responseText;
                    //console.log(JSONresult);
                    callback(JSONresult);
                    console.log("after");

                }else{console.log(xmlhttp.status);}
            }
        };
        xmlhttp.open("GET","ajax.php?shapeid="+arShapeid+"&xpos="+arXpos+
            "&ypos="+arYpos+"&swidth="+arSwidth+"&sheight="+arSheight+
            "&xscale="+arXscale+"&yscale="+arYscale+"&rotation="+arRotation,true);
        xmlhttp.send();
    }


    getArray(function (result) {
        console.log("Result "+result);
    })



    layer.destroy();
    var la = new Konva.Layer();
    stage.add(la);
}

