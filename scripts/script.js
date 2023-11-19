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
}

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
})

