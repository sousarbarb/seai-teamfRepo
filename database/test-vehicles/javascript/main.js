//Replace with your base URL
let BASE_URL = 'http://localhost/seai/test-vehicles/';

// The ready event is triggered when the document is ready
$(document).ready(function() {
  initMessageClosers();
});

// Separate function to remove the error messages
function initMessageClosers() {
  $('.close').click(function() {
		// Add a more subtle effect
    $(this).parent().fadeOut();
  });
}