$(document).ready(function() {
  $('.sidebar-toggle').trigger('click');
});

function previewImage(event) {
    var imgElement = document.getElementById('featured-image');
    imgElement.src = URL.createObjectURL(event.target.files[0]);
}

// Define onbeforeunload event handler
function beforeUnloadHandler(event) {
    // Check if the "Publish" button has been clicked
    var publishButton = document.getElementById('publish-button');
    if (publishButton && publishButton.clicked) {
        return;
    }
    
    // Show confirmation dialog
    return "Are you sure you want to leave this page? Your changes may not be saved.";
}

// Add onbeforeunload event handler
window.onbeforeunload = beforeUnloadHandler;

// Add event listener for "click" event on the "Publish" button
var publishButton = document.getElementById('publish-button');
if (publishButton) {
    publishButton.addEventListener('click', function() {
        // Remove onbeforeunload event handler
        window.onbeforeunload = null;
        
        // Set clicked flag to true
        this.clicked = true;
    });
}