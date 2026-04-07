// 1. Button Click Event - Greet the user
function greetUser() {
    alert("Welcome to Ashika's Portfolio! 👋");
}

// 2. Mouseover and Mouseout Events - Nav link highlight effect
const navLinks = document.querySelectorAll("nav a");

navLinks.forEach(function(link) {
    link.addEventListener("mouseover", function() {
        link.style.color = "blue";
        link.style.textDecoration = "underline";
    });

    link.addEventListener("mouseout", function() {
        link.style.color = "#000";
        link.style.textDecoration = "none";
    });
});

// 3. Form Submit Event - Validate and show confirmation
const contactForm = document.getElementById("contactForm");

if (contactForm) {
    contactForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Stop page reload

        const name = document.getElementById("nameInput").value.trim();
        const email = document.getElementById("emailInput").value.trim();
        const message = document.getElementById("messageInput").value.trim();

        if (name === "" || email === "" || message === "") {
            alert("Please fill in all required fields!");
        } else {
            alert("Thank you, " + name + "! Your message has been sent. ✅");
            contactForm.reset();
        }
    });
}

// 4. Keypress Event - Show character count in message box
const messageInput = document.getElementById("messageInput");

if (messageInput) {
    messageInput.addEventListener("keyup", function() {
        const count = messageInput.value.length;
        const counter = document.getElementById("charCount");
        if (counter) {
            counter.textContent = "Characters typed: " + count;
        }
    });
}

// 5. Double Click Event - Toggle dark mode
document.addEventListener("dblclick", function() {
    document.body.classList.toggle("dark-mode");
});