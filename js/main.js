"use strict";
//Variabler
let hamburger = document.getElementById("hamburger-icon");
let navUl = document.getElementById("nav-ul");

window.onload = init;

function init() {

  //Funktion för hamburger-menyn
  hamburger.addEventListener("click", () => {
    navUl.classList.toggle("show");
  })
}

//Funktion för att göra så att submit-knappen inte fungerar när checkboxen inte är ibockad
function disableSubmit(changed){
    if(changed.checked){
    let submitEl = document.getElementById("submitEl");
    submitEl.disabled = false;
}else{
    submitEl.disabled = true;
}
}