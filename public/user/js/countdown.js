// Get the current date
var currentDate = new Date();

// Get the event date from the data attribute of the countdown element
var eventDate = new Date(document.getElementById("countdown").getAttribute("data-event-date"));

// Compare the event date with the current date
if (currentDate < eventDate) {
    // Calculate the time difference in milliseconds
    var timeDiff = eventDate - currentDate;

    // Update the countdown every second
    var countdownInterval = setInterval(function() {
        // Calculate the remaining time
        var remainingTime = eventDate - new Date();

        // Calculate the days, hours, minutes, and seconds
        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
        var minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
        var seconds = Math.floor((remainingTime / 1000) % 60);

        // Display the countdown
        document.getElementById("countdown").textContent = ('0' + days).slice(-2) + " Days, " +
            ('0' + hours).slice(-2) + " Hours, " + ('0' + minutes).slice(-2) + " Minutes, " + ('0' + seconds).slice(-2) + " Seconds ";

        // Check if the event has passed
        if (remainingTime < 0) {
            // Display the event has passed message
            document.getElementById("countdown").textContent = "Event Has Passed";

            // Clear the countdown interval
            clearInterval(countdownInterval);
        }
    }, 1000);
} else {
    // Display the event has passed message
    document.getElementById("countdown").textContent = "Event has passed";
}
