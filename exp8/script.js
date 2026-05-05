// =============================================
// EVENT HANDLING - from previous exercise
// =============================================

// 1. Button Click Event - Greet the user
function greetUser() {
    alert("Welcome to Ashika's Portfolio! 👋");
}

// 2. Mouseover and Mouseout Events - Nav link highlight
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

// 3. Double Click - Toggle dark mode
document.addEventListener("dblclick", function() {
    document.body.classList.toggle("dark-mode");
});


// =============================================
// FORM HANDLING & VALIDATION - Exercise 1
// =============================================

const contactForm = document.getElementById("contactForm");

// --- Character Counter for Message ---
const messageInput = document.getElementById("messageInput");

if (messageInput) {
    messageInput.addEventListener("keyup", function() {
        const count = messageInput.value.length;
        const counter = document.getElementById("charCount");
        if (counter) {
            counter.textContent = "Characters typed: " + count + " / 200";
        }
    });
}

// --- Real-time Validation on Each Field ---

// Name: only letters and spaces allowed
const nameInput = document.getElementById("nameInput");
if (nameInput) {
    nameInput.addEventListener("blur", function() {
        validateName();
    });
}

// Email: must have @ and domain
const emailInput = document.getElementById("emailInput");
if (emailInput) {
    emailInput.addEventListener("blur", function() {
        validateEmail();
    });
}

// Phone: must be exactly 10 digits
const phoneInput = document.getElementById("phoneInput");
if (phoneInput) {
    phoneInput.addEventListener("blur", function() {
        validatePhone();
    });
}

// Message: must not be empty and max 200 chars
if (messageInput) {
    messageInput.addEventListener("blur", function() {
        validateMessage();
    });
}


// =============================================
// VALIDATION FUNCTIONS
// =============================================

function validateName() {
    const name = document.getElementById("nameInput").value.trim();
    const nameError = document.getElementById("nameError");
    const nameField = document.getElementById("nameInput");

    if (name === "") {
        nameError.textContent = "❌ Name is required.";
        nameField.classList.add("invalid");
        nameField.classList.remove("valid");
        return false;
    } else if (!/^[a-zA-Z\s]+$/.test(name)) {
        nameError.textContent = "❌ Name must contain only letters.";
        nameField.classList.add("invalid");
        nameField.classList.remove("valid");
        return false;
    } else {
        nameError.textContent = "✅ Looks good!";
        nameError.style.color = "green";
        nameField.classList.add("valid");
        nameField.classList.remove("invalid");
        return true;
    }
}

function validateEmail() {
    const email = document.getElementById("emailInput").value.trim();
    const emailError = document.getElementById("emailError");
    const emailField = document.getElementById("emailInput");

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        emailError.textContent = "❌ Email is required.";
        emailError.style.color = "red";
        emailField.classList.add("invalid");
        emailField.classList.remove("valid");
        return false;
    } else if (!emailPattern.test(email)) {
        emailError.textContent = "❌ Enter a valid email (e.g. name@email.com).";
        emailError.style.color = "red";
        emailField.classList.add("invalid");
        emailField.classList.remove("valid");
        return false;
    } else {
        emailError.textContent = "✅ Looks good!";
        emailError.style.color = "green";
        emailField.classList.add("valid");
        emailField.classList.remove("invalid");
        return true;
    }
}

function validatePhone() {
    const phone = document.getElementById("phoneInput").value.trim();
    const phoneError = document.getElementById("phoneError");
    const phoneField = document.getElementById("phoneInput");

    if (phone === "") {
        phoneError.textContent = "❌ Phone number is required.";
        phoneError.style.color = "red";
        phoneField.classList.add("invalid");
        phoneField.classList.remove("valid");
        return false;
    } else if (!/^\d{10}$/.test(phone)) {
        phoneError.textContent = "❌ Phone must be exactly 10 digits.";
        phoneError.style.color = "red";
        phoneField.classList.add("invalid");
        phoneField.classList.remove("valid");
        return false;
    } else {
        phoneError.textContent = "✅ Looks good!";
        phoneError.style.color = "green";
        phoneField.classList.add("valid");
        phoneField.classList.remove("invalid");
        return true;
    }
}

function validateReason() {
    const reason = document.getElementById("reasonSelect").value;
    const reasonError = document.getElementById("reasonError");

    if (reason === "") {
        reasonError.textContent = "❌ Please select a reason.";
        reasonError.style.color = "red";
        return false;
    } else {
        reasonError.textContent = "✅ Looks good!";
        reasonError.style.color = "green";
        return true;
    }
}

function validateMessage() {
    const message = document.getElementById("messageInput").value.trim();
    const messageError = document.getElementById("messageError");
    const messageField = document.getElementById("messageInput");

    if (message === "") {
        messageError.textContent = "❌ Message cannot be empty.";
        messageError.style.color = "red";
        messageField.classList.add("invalid");
        messageField.classList.remove("valid");
        return false;
    } else if (message.length > 200) {
        messageError.textContent = "❌ Message must be under 200 characters.";
        messageError.style.color = "red";
        messageField.classList.add("invalid");
        messageField.classList.remove("valid");
        return false;
    } else {
        messageError.textContent = "✅ Looks good!";
        messageError.style.color = "green";
        messageField.classList.add("valid");
        messageField.classList.remove("invalid");
        return true;
    }
}


// =============================================
// FORM SUBMIT - Run all validations together
// =============================================

if (contactForm) {
    contactForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Stop page reload

        const isNameValid    = validateName();
        const isEmailValid   = validateEmail();
        const isPhoneValid   = validatePhone();
        const isReasonValid  = validateReason();
        const isMessageValid = validateMessage();

        const successMsg = document.getElementById("successMsg");

        if (isNameValid && isEmailValid && isPhoneValid && isReasonValid && isMessageValid) {
            successMsg.textContent = "✅ Thank you! Your message has been submitted successfully.";
            contactForm.reset();

            // Clear all green success hints after reset
            document.querySelectorAll(".error").forEach(function(el) {
                el.textContent = "";
            });
            document.querySelectorAll("input, textarea").forEach(function(el) {
                el.classList.remove("valid", "invalid");
            });
            document.getElementById("charCount").textContent = "Characters typed: 0 / 200";

        } else {
            successMsg.textContent = "";
        }
    });
}