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

    // change the value of the RGB color to the value on the slider
    inputColor.style.setProperty("--emotion-indicator", `oklch(60.54% 0.15 ${value})`)
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

