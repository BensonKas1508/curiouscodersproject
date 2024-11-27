// Event form handling
document.getElementById('event-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from reloading the page

    const eventTitle = e.target[0].value;
    const eventDate = e.target[1].value;
    const eventTime = e.target[2].value;
    const eventLocation = e.target[3].value;

    alert(`New Event Created: ${eventTitle} at ${eventLocation} on ${eventDate} at ${eventTime}`);
});
