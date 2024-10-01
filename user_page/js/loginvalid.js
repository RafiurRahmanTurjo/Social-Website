function validateForm() {
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();
    var nameError = document.getElementById("nameError");
    var passError = document.getElementById("passError");
    var isValid = true;

    nameError.textContent = "";
    passError.textContent = "";

    if (username === "") {
        nameError.textContent = "Username is empty";
        isValid = false;
    }

    if (password === "") {
        passError.textContent = "Password is empty";
        isValid = false;
    }

    return isValid;
}

document.getElementById("loginForm").addEventListener("submit", function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
