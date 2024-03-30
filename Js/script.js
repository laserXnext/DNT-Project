function openTab(tabName, element) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tabContent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the active class from all tabs
    tablinks = document.getElementsByTagName("a");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Show the current tab content and add an active class to the clicked tab
    document.getElementById(tabName).style.display = "block";
    element.classList.add("active");
}

// Set the default tab when the window loads
window.onload = function() {
    openTab('dashboard', document.querySelector('.active'));
};


function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}



// Open the Modal
function openModal() {
    document.getElementById("addEmployeeModal").style.display = "block";
}

// Close the Modal
function closeModal() {
    document.getElementById("addEmployeeModal").style.display = "none";
}

// Get the modal
var modal = document.getElementById("addEmployeeModal");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

// Add event listener to your Add Employee button
document.getElementById("addEmployeeBtn").addEventListener('click', openModal);


// Add event listener to your Back button
document.getElementById("backBtn").addEventListener('click', function() {
    window.location.href = 'index.html'; // Redirect to index.html
});


// Add event listener to your visit button
document.getElementById("visitBtn").addEventListener('click', function() {
    window.location.href = 'home.html'; // Redirect to Home.html
});



// Open the Modal 2
function openModal2() {
    document.getElementById("addProjectModal").style.display = "block";
}

// Close the Modal 2
function closeModal2() {
    document.getElementById("addProjectModal").style.display = "none";
}
 
// Get the modal 2
var modal2 = document.getElementById("addProjectModal");

// When the user clicks anywhere outside of the modal 2, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        closeModal2();
    }
}

// Add event listener to your Add Project button
document.getElementById("addProjectBtn").addEventListener('click', openModal2);




// Open the Modal 3
function openModal3() {
    document.getElementById("addToolModal").style.display = "block";
    
}

// Close the Modal 3
function closeModal3() {
    document.getElementById("addToolModal").style.display = "none";
}

// Get the modal 3
var modal3 = document.getElementById("addToolModal");

// When the user clicks anywhere outside of the modal 3, close it
window.onclick = function(event) 
{
    if (event.target == modal3) 
    {
        closeModal3();
    }
}
document.getElementById("addToolBtn").addEventListener('click', openModal3);


function importAdvertisement() {
    var fileInput = document.getElementById('advertisementFile');
    var file = fileInput.files[0];
    // Process the file (upload to server, show on page, etc.)
    // This part depends on your specific requirements and setup
}
