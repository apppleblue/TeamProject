//https://stackoverflow.com/questions/2706701/getting-id-of-any-tag-when-mouseover
function getAssetID() {
    document.ondrag = function (e) {
        //console.log(e.target.id);
        global var assetID = e.target.id;
        //console.log(assetID + "test");
    }
}


