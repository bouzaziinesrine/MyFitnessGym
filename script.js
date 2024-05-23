
const main = document.querySelector('.main');
const slidercontainer = document.querySelector('.slidercontainer');
const btnstart = document.querySelector('.btn-start');
const slider = document.querySelector('.slider');
const savoir = document.querySelector('.savoir');

// btnstart.onclick = () => {
//     slider.classList.add('active');
//     savoir.classList.add('active');
//     btnstart.classList.add('active');
   
// }
function redirectToDetailsPage(page) {
    window.location.href = page;
}



function openPopup() {
    // Create the popup element
    var popup = document.createElement('div');
    popup.classList.add('popup');
    main.classList.add('active');


   // Create column containers
    var column1 = document.createElement('div');
    column1.classList.add('column');
    column1.innerHTML = `
    <h1>Coaching personnalisé</h1>
    <img src="coach-sportif.jpg" alt="cc">
    <p>Le coaching en développement personnel, appelé aussi coaching individuel de particulier ou encore coaching de vie, est l'accompagnement de la personne dans sa vie personnelle ou professionnelle pour l'aider à réussir dans l'atteinte d'un objectif projet.</p>
    `;

   

    // Create the close button
    var closeButton = document.createElement('button');
    closeButton.textContent = 'Close';
    closeButton.classList.add('close-button');
    closeButton.onclick = closePopup;

    // Append columns and button to the popup
    popup.appendChild(column1);

    popup.appendChild(closeButton);



    // Append the popup to the document body
    document.body.appendChild(popup);
}

function closePopup() {
    // Remove the popup element from the DOM
    var popup = document.querySelector('.popup');
    if (popup) {
        popup.parentNode.removeChild(popup);
        main.classList.remove('active');
    }
}

// BMI Function

function calculateBMI() {
    var height = document.getElementById('height').value;
    var weight = document.getElementById('weight').value;

    if(height === '' || weight === '') {
        alert("Please enter both height and weight.");
        return;
    }

    var bmi = (weight / ((height / 100) * (height / 100))).toFixed(2);
    var result = document.getElementById('result');
    var interpretation = '';

    if (bmi < 18.5) {
        interpretation = 'Underweight';
    } else if (bmi >= 18.5 && bmi < 25) {
        interpretation = 'Normal weight';
    } else if (bmi >= 25 && bmi < 30) {
        interpretation = 'Overweight';
    } else {
        interpretation = 'Obese';
    }

    result.innerHTML = `Your BMI is ${bmi}. This is considered ${interpretation}.`;
}

//image
window.onload = function() {
    var imgs = ["image2.jpg","image3.jpg","image4.jpg"]; // Add more images as needed
    const image = document.getElementById('back');
    let index = 1;

    function changeBackground(){
        image.style.backgroundImage = `url(${imgs[index % imgs.length]})`;
        index++;
    }

    setInterval(changeBackground, 1800);
};

//slide images
let slideIndex = 1;

function showSlides(n) {
    const slides = document.getElementsByClassName("slide");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}

function changeSlide(n) {
    showSlides(slideIndex += n);
}

document.addEventListener("DOMContentLoaded", function() {
    showSlides(slideIndex);
});

document.querySelector(".prev").addEventListener("click", function() {
    changeSlide(-1);
});

document.querySelector(".next").addEventListener("click", function() {
    changeSlide(1);
});


//second slide images

const carousel = document.querySelector(".carousel"),
firstImg = carousel.querySelectorAll("img")[0],
arrowIcons = document.querySelectorAll(".wrapper i");
let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

const showHideIcons = () => {
    // showing and hiding prev/next icon according to carousel scroll left value
    let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // getting max scrollable width
    arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
    arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
}
arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => {
        let firstImgWidth = firstImg.clientWidth + 12;

        carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
        setTimeout(() => showHideIcons(), 60); // calling showHideIcons after 60ms
    });
});


//from
const container = document.querySelector(".container");
const signUpBtn = document.querySelector(".green-bg button");

signUpBtn.addEventListener("click", () => {
  container.classList.toggle("change");
});



