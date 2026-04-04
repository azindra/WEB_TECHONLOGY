let cart = [];
let total = 0;

// -------- ADD TO CART --------
function addToCart(product, price) {
    cart.push({ product, price });
    total += price;
    alert(product + " added to cart!");
}

// -------- SHOW TOTAL --------
function showTotal() {
    document.getElementById("totalAmount").innerText = "₹" + total;
}

// -------- REGISTER --------
function validateRegister() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (name === "" || email === "" || password === "") {
        alert("All fields required!");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    alert("Registration Successful!");

    // ✅ Redirect to Login Page
    window.location.href = "login.html";

    return false;
}

// -------- LOGIN --------
function validateLogin() {
    let email = document.getElementById("loginEmail").value;
    let password = document.getElementById("loginPassword").value;

    if (email === "" || password === "") {
        alert("Fill all fields!");
        return false;
    }

    alert("Login Successful!");

    // ✅ Redirect to Home Page
    window.location.href = "index.html";

    return false;
}

// -------- CHECKOUT --------
function validateCheckout() {
    let name = document.querySelector("input[type='text']").value;
    let email = document.querySelector("input[type='email']").value;

    if (name === "" || email === "") {
        alert("Fill all details!");
        return false;
    }

    alert("Order Placed Successfully!");

    // ✅ Redirect to Home Page after order
    window.location.href = "index.html";

    return false;
}