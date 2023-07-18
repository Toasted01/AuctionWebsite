function showHint(str){

    let xmlhttp = new XMLHttpRequest();
    let showimages = false;

    xmlhttp.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200){
            let item = JSON.parse(this.responseText);
            let uic = document.getElementById('txtHint');
            uic.innerHTML = "";
            item.forEach(function (obj) {//creates a list item for each item object passed to it
                uic.innerHTML += '<li class="list-group-item"><p>' + (showimages ? '<img width="30px" class="img-thumbnail" src=../images/' + obj._image +'>' : '') + obj._name + "</p></li>";
                }
            );
        }
    };

    showimages = document.getElementById("showimages").checked;//checks to see if the showimages check box is checked

    let uic = document.getElementById("txtHint");
    if (str.length>1)//checks to see if the user has typed in 2 or more characters
    {
        xmlhttp.open("GET", "Ajax/ajaxSearch.php?q=" + str + "&token=<?php echo $token; ?>", true);
        xmlhttp.send();
        return;
    }
    if(str.length<2)//if the user has typed in less than 2 characters it will not show any hints
    {
        uic.innerHTML = "";
        return;
    }
}

function hide(){//hides the hints when called
    let uic = document.getElementById('txtHint');
    uic.innerHTML = "";
    return;
}

