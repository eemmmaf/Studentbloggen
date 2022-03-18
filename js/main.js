/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-18 00:23:49
 */

"use strict";
//Variabler
let hamburger = document.getElementById("hamburger-icon");
let navUl = document.getElementById("nav-ul");
let url = "https://api.nasa.gov/planetary/apod?api_key=FphE9sV2jcWVxlhrlnqKMtmaqefbl3rDAgBAQ6yO";


window.onload = init;

function init() {

  //Funktion för hamburger-menyn
  hamburger.addEventListener("click", () => {
    navUl.classList.toggle("show");
  })

  loadData();
}


//Funktion för hämtning av bild och text med fetch-request. Anropar funktionen showChannels i denna funktion. 
function loadData() {
  fetch(url)
    .then((resp) => resp.json())
    .then((data) => {

      let info = data;
      showData(info);
    })
    .catch((error) => {
      //console.log(error);
    }
    );
}

//Funktion som skriver ut det som är hämtat från funktionen loadData
function showData(info) {
  let heading = document.getElementById("output-h3");
  let outputContent = document.getElementById("output-content");
  let outputImg = document.getElementById("img-nasa");
  heading.innerHTML += info.title;
  outputContent.innerHTML += info.explanation + "<br> <br> Copyright:" + info.copyright;
  outputImg.innerHTML += `<img src="${info.url}">`;
}


//Funktion för att visa texten på svenska
function showSwedish() {
  let content = document.getElementById("swedish");
  if (!content.style.display || content.style.display === "none") {
    content.style.display = "block";

  } else {
    content.style.display = "none";

  }

}

/*Validering av formulär
2 funktioner*/

//Funktion för att göra så att submit-knappen inte fungerar när checkboxen inte är ibockad
function disableSubmit(changed) {
  if (changed.checked) {
    let submitEl = document.getElementById("submitEl");
    submitEl.disabled = false;
  } else {
    submitEl.disabled = true;
  }
}

//Funktion som säger till när lösenordet har blivit 8 tecken
function passwordValidation() {
  // Sparar värdet
  let passwordInput = document.getElementById("password").value;
  // Kontrollerar om lösenordets längd är minst 8 tecken långt
  let text;
  if (passwordInput.length >= 8) {
    text = 'Lösenordet är tillräckligt långt <i class="fa-solid fa-circle-check"></i>';
  } else {
    text = "Lösenordet är för kort";
  }
  document.getElementById("ok").innerHTML = text;
}






















