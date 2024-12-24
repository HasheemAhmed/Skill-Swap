function submitForm(event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById("signup-form");
    const formData = new FormData(form);

    fetch("signup.php", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            // Handle HTTP errors
            return response.json().then(data => {
                throw new Error(data.error || "Unknown error occurred.");
            });
        }
        return response.json();
    })
    .then(data => {
        // Success response
        document.getElementById("response-message").innerHTML = `<p class = "alert alerts alert-success">${data.message}</p>`;
        setTimeout(() => {
            window.location.href = "logins.php";
        }, 1000); // Redirect after 1 second
    
    })
    .catch(error => {
        // Error response
        document.getElementById("response-message").innerHTML = `<p class = "alert alerts alert-danger">${error.message}</p>`;
    });
}


function submitFormLogin(event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById("signup-form");
    const formData = new FormData(form);

    fetch("login.php", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.error || "An error occurred.");
            });
        }
        return response.json();
    })
    .then(data => {
        // Handle successful login
        document.getElementById("response-message").innerHTML = `<p class = "alert alert-success alerts">${data.message}</p>`;
        // Optionally redirect the user to a dashboard or another page
        setTimeout(() => {
            window.location.href = "home.php";
        }, 1000); // Redirect after 1 second
    })
    .catch(error => {
        // Handle errors
        document.getElementById("response-message").innerHTML = `<p class = "alert alert-danger alerts">${error.message}</p>`;
    });
}


function submitServiceForm(event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById("add-service");
    const formData = new FormData(form);

    fetch("addservice.php", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.error || "An error occurred.");
            });
        }
        return response.json();
    })
    .then(data => {
        // Show success message in the response div
        document.getElementById("response-message").innerHTML = `<p class="alert alert-success">${data.message}</p>`;

        // Redirect after 1 second
        setTimeout(() => {
            window.location.href = "add_service.php"; // Redirect to another page
        }, 1000); // Delay the redirect by 1 second
    })
    .catch(error => {
        // Show error message in the response div
        document.getElementById("response-message").innerHTML = `<p class="alert alert-danger">${error.message}</p>`;
    });
}


function changeSlide(button, direction) {
    const slider = button.closest('.service-slider');
    const images = slider.querySelectorAll('img');
    const total = images.length;
    let currentIndex = Array.from(images).findIndex(img => img.style.display !== 'none');

    if (currentIndex === -1) currentIndex = 0;
    images[currentIndex].style.display = 'none';
    const nextIndex = (currentIndex + direction + total) % total;
    images[nextIndex].style.display = 'block';
}

function toggleDescription(button) {
    const desc = button.previousElementSibling;
    const isExpanded = desc.style.maxHeight !== '60px';

    desc.style.maxHeight = isExpanded ? '60px' : 'none';
    button.textContent = isExpanded ? 'See More' : 'See Less';
}
document.addEventListener('DOMContentLoaded', () => {
// Ensure only the first image in each slider is visible initially
    const sliders = document.querySelectorAll('.service-slider');
    sliders.forEach(slider => {
    const images = slider.querySelectorAll('img');
    images.forEach((img, index) => {
        img.style.display = index === 0 ? 'block' : 'none';
});
});
});

function changeSlide(button, direction) {
    const slider = button.closest('.service-slider');
    const images = slider.querySelectorAll('img');
    const total = images.length;
    let currentIndex = Array.from(images).findIndex(img => img.style.display === 'block');

    // Hide the current image
    images[currentIndex].style.display = 'none';

    // Calculate the next image index
    const nextIndex = (currentIndex + direction + total) % total;

    // Show the next image
    images[nextIndex].style.display = 'block';
}
