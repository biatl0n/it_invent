function fillOpt(val, selName) {
    var xhr = new XMLHttpRequest();
    var sel = document.getElementsByName(selName);
    var opt = document.createElement("option");
    var j = 0;
    var params = "sel=" + val;
    
    sel[0].options.length = 0;
    xhr.open("GET", "ajax.php?"+params, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;
        var jsonArr = JSON.parse(xhr.responseText);
        for (var i in jsonArr){
            sel[0].options[j] = new Option (jsonArr[i], i);
            j++;
        }
    }
    xhr.send(null);
}

function fillOptQuery(val, selName) {
    var xhr = new XMLHttpRequest();
    var sel = document.getElementsByName(selName);
    var opt = document.createElement("option");
    var j = 0;
    var params = "sel=" + val;
    
    sel[0].options.length = 0;
    xhr.open("GET", "ajax.php?"+params, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;
        var jsonArr = JSON.parse(xhr.responseText);
        sel[0].options[0] = new Option ("", 0);
        for (var i in jsonArr){
            sel[0].options[j+1] = new Option (jsonArr[i], i);
            j++;
        }
    }
    xhr.send(null);
}

function addEvent(){
    sel = document.getElementsByName("choiceTehnListModel");
    sel[0].onchange = function() {
        fillOpt(sel[0].options[sel[0].selectedIndex].value, "remFromListModel");   
    }
}

function addEventQuery(){
    sel = document.getElementsByName("addTehn");
    sel[0].onchange = function() {
        fillOptQuery(sel[0].options[sel[0].selectedIndex].value, "addModel");   
    }
}

function addEventTehn(){
    sel = document.getElementsByName("addTehn");
    sel[0].onchange = function() {
        fillOpt(sel[0].options[sel[0].selectedIndex].value, "addModel");   
    }
}
