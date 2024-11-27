function filterGroups() {
    const searchValue = document.getElementById('search-bar').value.toLowerCase();
    const groups = document.querySelectorAll('.group-container');

    groups.forEach(group => {
        const name = group.getAttribute('name').toLowerCase();
        if (name.includes(searchValue)) {
            group.style.display = 'block';
        } else {
            group.style.display = 'none';
        }
    });
}

$(function() {
    $("#datepicker").datepicker({
        showOtherMonths: true, // Show days from previous/next months
        selectOtherMonths: true
    });
});