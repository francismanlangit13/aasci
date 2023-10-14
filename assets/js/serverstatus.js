var isConnected = true; // Variable to track connection status
var isAlertVisible = false; // Flag to track if alert is currently visible

setInterval(function() {
    checkConnection();
}, 5000); // 5000 milliseconds = 5 seconds

function checkConnection() {
    var alertDiv = document.getElementById('connectionAlert');
    if (!navigator.onLine && isConnected) {
        isConnected = false; // Update connection status
        if (!isAlertVisible) {
            isAlertVisible = true; // Set the alert visibility flag
            alertDiv.className = 'alert';
            alertDiv.style.backgroundColor = '#f44336';
            alertDiv.innerHTML = '<span class="closebtn" onclick="hideAlert();">&times;</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-wifi-off" viewBox="0 0 16 16"><path d="M10.706 3.294A12.545 12.545 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c.63 0 1.249.05 1.852.148l.854-.854zM8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065 8.448 8.448 0 0 1 3.51-1.27L8 6zm2.596 1.404l.785-.785c.63.24 1.227.545 1.785.907a.482.482 0 0 1 .063.745.525.525 0 0 1-.652.065 8.462 8.462 0 0 0-1.98-.932zM8 10l.933-.933a6.455 6.455 0 0 1 2.013.637c.285.145.326.524.1.75l-.015.015a.532.532 0 0 1-.611.09A5.478 5.478 0 0 0 8 10zm4.905-4.905l.747-.747c.59.3 1.153.645 1.685 1.03a.485.485 0 0 1 .047.737.518.518 0 0 1-.668.05 11.493 11.493 0 0 0-1.811-1.07zM9.02 11.78c.238.14.236.464.04.66-.195.195-.518.197-.66-.04l-.707-.707a.5.5 0 0 1 0-.707l.707-.707c.195-.195.464-.236.66-.04.178.298.28.647.28 1.021 0 .277-.092.626-.28 1.02zm4.355-9.905a.53.53 0 0 1 .75.75l-10.75 10.75a.53.53 0 0 1-.75-.75l10.75-10.75z"/></svg> You are not connected to the internet.';
            alertDiv.style.display = 'block';
        }
    } else if (navigator.onLine && !isConnected) {
        isConnected = true; // Update connection status
        if (!isAlertVisible) {
            isAlertVisible = true; // Set the alert visibility flag
            alertDiv.className = 'alert';
            alertDiv.style.backgroundColor = '#4CAF50';
            alertDiv.innerHTML = '<span class="closebtn" onclick="hideAlert();">&times;</span><i class="fa fa-wifi"></i> You are connected to the internet.';
            alertDiv.style.display = 'block';
        }
    } else if (navigator.onLine && isConnected && isAlertVisible) {
            isConnected = true; // Update connection status
            isAlertVisible = true; // Set the alert visibility flag
            alertDiv.className = 'alert';
            alertDiv.style.backgroundColor = '#4CAF50';
            alertDiv.style.display = 'block';
            alertDiv.innerHTML = '<span class="closebtn" onclick="hideAlert();">&times;</span><i class="fa fa-wifi"></i> You are connected to the internet.';
    } else if (!navigator.onLine && !isConnected && isAlertVisible) {
        isConnected = false; // Update connection status
        isAlertVisible = true; // Set the alert visibility flag
        alertDiv.className = 'alert';
        alertDiv.style.backgroundColor = '#f44336';
        alertDiv.innerHTML = '<span class="closebtn" onclick="hideAlert();">&times;</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-wifi-off" viewBox="0 0 16 16"><path d="M10.706 3.294A12.545 12.545 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c.63 0 1.249.05 1.852.148l.854-.854zM8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065 8.448 8.448 0 0 1 3.51-1.27L8 6zm2.596 1.404l.785-.785c.63.24 1.227.545 1.785.907a.482.482 0 0 1 .063.745.525.525 0 0 1-.652.065 8.462 8.462 0 0 0-1.98-.932zM8 10l.933-.933a6.455 6.455 0 0 1 2.013.637c.285.145.326.524.1.75l-.015.015a.532.532 0 0 1-.611.09A5.478 5.478 0 0 0 8 10zm4.905-4.905l.747-.747c.59.3 1.153.645 1.685 1.03a.485.485 0 0 1 .047.737.518.518 0 0 1-.668.05 11.493 11.493 0 0 0-1.811-1.07zM9.02 11.78c.238.14.236.464.04.66-.195.195-.518.197-.66-.04l-.707-.707a.5.5 0 0 1 0-.707l.707-.707c.195-.195.464-.236.66-.04.178.298.28.647.28 1.021 0 .277-.092.626-.28 1.02zm4.355-9.905a.53.53 0 0 1 .75.75l-10.75 10.75a.53.53 0 0 1-.75-.75l10.75-10.75z"/></svg> You are not connected to the internet.';
        alertDiv.style.display = 'block';
    }
}

function hideAlert() {
    var alertDiv = document.getElementById('connectionAlert');
    alertDiv.style.display = 'none';
    isAlertVisible = false; // Reset the alert visibility flag
}