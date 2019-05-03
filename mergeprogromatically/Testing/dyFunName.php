<!DOCTYPE html>
<html>
<head>

</head>
<body>
<h1 class="text">some text</h1>
<button onclick="mouseOver()">try</button>
    <script>
        var domDragSel;

        for(var i=0; i<10; i++){

            function mouseOver() {
                document.querySelector(".text").innerHTML = "some other text bitch";
                console.log("test")
            }

            //window.addEventListener('mouseOver', mouseOver);

            document.getElementById("text").addEventListener("mouseover", mouseOver);
        }


    </script>
</body>
</html>