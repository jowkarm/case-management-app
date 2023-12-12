/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/20/2023
 * 355/case-management-app/scripts/script.js
 * JavaScript file for Tribal Pathways project
 */


/**
 * This function is for closing the alert.
 */
function closeAlert() {
    const alert = document.getElementById("myAlert");
    alert.style.display = "none";
};

/**
 * Allows a user to use the color selector on the Add Note
 * page to change the color for the emotional indicator color.
 * @type {Element}
 */
const slider = document.querySelector(".color-picker input");
const inputColor = document.querySelector(".color-picker");

slider.addEventListener("input", function() {
    const value = slider.value
    let emotionName = document.querySelector(".color-picker p");
    // change the value of the RGB color to the value on the slider
    inputColor.style.setProperty("--emotion-indicator", `oklch(60.54% 0.15 ${value})`)

    if( value <= 1) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>No Comment</p>"
    }
    else if (value <= 25.7) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Peace</p>"
    }
    else if (value > 25.7 && value <= 51.4) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Gratitude</p>"
    }
    else if (value > 25.7 && value <= 77.1) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Kindness</p>"
    }
    else if (value > 77.1 && value <= 102.8) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Enthusiasm</p>"
    }
    else if (value > 102.8 && value <= 128.5) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Optimism</p>"
    }
    else if (value > 128.5 && value <= 154.2) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Hope</p>"
    }
    else if (value > 154.2 && value <= 179.9) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Apathy</p>"
    }
    else if (value > 179.9 && value <= 205.6) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Annoyance</p>"
    }
    else if (value > 205.6 && value <= 231.3) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Worry</p>"
    }
    else if (value > 231.3 && value <= 257) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Anxiety</p>"
    }
    else if (value > 257 && value <= 282.7) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Sadness</p>"
    }
    else if (value > 282.7 && value <= 308.4) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Jealousy</p>"
    }
    else if (value > 308.4 && value <= 334.1) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Hatred</p>"
    }
    else if (value > 334.1) {
        emotionName.innerHTML = "<p>Color:&nbsp; <span></span>Fear</p>"
    }
});


function displayImage() {
    const input = document.getElementById('image');
    const container = document.getElementById('imageContainer');

    // Ensure that a file is selected
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Create an image element and set its source to the selected file
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'new profile photo'; // Add alternative text

            // Add classes to the img element
            img.classList.add('img-responsive');
            img.classList.add('img-thumbnail');
            img.classList.add('w-75');
            img.classList.add('mx-auto');

            // Clear any previous content in the container and append the new image
            container.innerHTML = '';
            container.appendChild(img);
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(input.files[0]);
    }
};

/**
 * Activate tooltips
 * @type {NodeListOf<Element>}
 */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


