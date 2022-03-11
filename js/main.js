"use strict";

//Funktion för att göra så att submit-knappen inte fungerar när checkboxen inte är ibockad
function disableSubmit(changed){
    if(changed.checked){
    let submitEl = document.getElementById("submitEl");
    submitEl.disabled = false;
}else{
    submitEl.disabled = true;
}
}