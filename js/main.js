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

//Funktion för att göra så att submit-knappen inte fungerar när checkboxen inte är ibockad
function disableSubmit(changed) {
  if (changed.checked) {
    let submitEl = document.getElementById("submitEl");
    submitEl.disabled = false;
  } else {
    submitEl.disabled = true;
  }
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
          console.log(error);
      }
      );
}

//Funktion som skriver ut det som är hämtat från funktionen loadData
function showData(info) {
  let output = document.getElementById("output-article");
  let heading = document.getElementById("output-h3");
  let outputContent = document.getElementById("output-content");
  let outputImg = document.getElementById("img-nasa");
  heading.innerHTML += info.title;
  outputContent.innerHTML += info.explanation;
  outputImg.innerHTML += `<img src="${info.url}">`;
  outputImg.innerHTML += "<p> Copyright:" + info.copyright + "</p>";
}


//Funktion för att visa texten på svenska
function showSwedish(){
let content = document.getElementById("swedish");
  if (content.style.display === "none") {
    content.style.display = "block";

  } else {
    content.style.display = "none";

  }

}



  











  
