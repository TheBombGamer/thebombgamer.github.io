// script.js
document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("popup");
    const closeButton = document.getElementById("close-button");
    const understandButton = document.getElementById("understand-button");

    // Check local storage to see if the user has already acknowledged the popup
    if (!localStorage.getItem("popupAcknowledged")) {
        popup.style.display = "block"; // Show the popup if not acknowledged
    }

    // Close the popup when the close button is clicked
    closeButton.addEventListener("click", function() {
        popup.style.display = "none";
    });

    // Hide the popup and set local storage when the "I understand" button is clicked
    understandButton.addEventListener("click", function() {
        popup.style.display = "none";
        localStorage.setItem("popupAcknowledged", "true"); // Set the flag in local storage
    });

    // Close the popup when clicking outside of the popup content
    window.addEventListener("click", function(event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
});