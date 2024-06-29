// script.js

// Function to open/close the sidebar and toggle icons
function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var menuIcon = document.querySelector('.header .menu-icon');
    var closeIcon = document.querySelector('.header .closebtn');

    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
        document.querySelector(".content").style.marginLeft = "0";
        menuIcon.style.display = 'block';
        closeIcon.style.display = 'none';
    } else {
        sidebar.style.width = '250px';
        document.querySelector(".content").style.marginLeft = "250px";
        menuIcon.style.display = 'none';
        closeIcon.style.display = 'block';
    }
}

// Function to load pages dynamically
function loadPage(page) {
    fetch(page)
        .then(response => response.text())
        .then(html => {
            document.getElementById("mainContent").innerHTML = html;
        })
        .catch(error => console.error('Error loading page:', error));
}

// Function to fetch user information (example)
async function fetchUserInfo() {
    try {
        // Replace with your actual endpoint to fetch user info
        const response = await fetch('/userinfo');
        const userData = await response.json();
        const usernameElement = document.getElementById('username');
        usernameElement.textContent = userData.username; // Update the username in the DOM
    } catch (error) {
        console.error('Error fetching user information:', error);
    }
}

// Call fetchUserInfo when the page loads
fetchUserInfo();
