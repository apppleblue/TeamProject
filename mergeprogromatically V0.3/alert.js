function getcanvas(callback) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState===4){ //request done
            console.log("request =4");
            if(xmlhttp.status===200){//successfully
                var data = (xmlhttp.responseText);
                callback (data);
            }else{console.log(xmlhttp.status);}
        }
    };
    xmlhttp.open("GET","canIdAJAX.php",true);
    xmlhttp.send();

}
