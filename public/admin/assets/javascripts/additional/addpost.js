//Automatically hide the sidebar
$(document).ready(function() {
  $('.sidebar-toggle').trigger('click');
});

//Get references to the title and link input fields
const titleInput = document.getElementById('title');
const linkInput = document.getElementById('link');

//Automatically write link based on the title
titleInput.addEventListener('input', () => {
    const titleValue = titleInput.value;
    const linkValue = titleValue.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
    linkInput.value = `${linkValue}`;
});

//Changing the link input space to "-" and make it lowercase
linkInput.addEventListener('input', () => {
    const linkValue = linkInput.value;
    const formattedValue = linkValue.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
    linkInput.value = formattedValue;
});

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
