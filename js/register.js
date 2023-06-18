$(document).ready(function () {
    // Handle form submission
    $("#registrationForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form values
        var username = $("#username").val().toLowerCase();
        var password = $("#password").val();
        var email = $("#email").val();

        // Perform validation
        if (username === "" || password === "" || email === "") {
            alert("Please fill in all fields.");
            return;
        }

        if (!validateUsername(username)) {
            alert("Invalid username. Please enter a valid username.");
            return;
        }

        // if (!validatePassword(password)) {
        //     alert("Invalid password. Please enter a valid password.");
        //     return;
        // }

        switch(validatePassword(password)){
            case 0:
                break;
            case 1:
                alert("Passord too short");
                return;
            case 2:
                alert("Include atleast one lowercase");
                return;
            case 3:
                alert("Include atleast one uppercase");
                return;
            case 4:
                alert("Include atleast one digit");
                return;
            case 5:
                alert("Include atleast one special character");
                return;
            default:
                alert("Error");
        }

        // Create a data object to send to the server
        var data = {
            username: username,
            password: password,
            email: email
        };

        // Send an AJAX request to the server
        $.ajax({
            url: "../php/registration.php", // Path to your PHP registration script
            type: "POST",
            data: data,
            success: function (response) {
                // Handle the response from the server
                if (response === "success") {
                    alert("Registration successful!");
                    // Redirect the user to the login page or perform any other necessary action
                } else {
                    if (response === "Email already exists") {
                        $("#email").addClass("border-danger");
                    }
                    if (response === "Username already exists") {
                        $("#username").addClass("border-danger");
                    }
                    // alert(response); // Display the error message received from PHP
                }
            },
            error: function () {
                alert("An error occurred during registration.");
            }
        });
    });

    // Validate username
    function validateUsername(username) {
        var minUsernameLength = 3; // Minimum length for username
        var maxUsernameLength = 20; // Maximum length for username

        // Regular expression to match alphanumeric characters, underscores, and hyphens
        var usernameRegex = /^[a-zA-Z0-9_-]+$/;

        if (username.length < minUsernameLength || username.length > maxUsernameLength) {
            return false;
        }

        if (!username.match(usernameRegex)) {
            return false;
        }

        return true;
    }

    // Validate password
    function validatePassword(password) {
        // Check password length
        var minPasswordLength = 8; // Minimum length for password

        if (password.length < minPasswordLength) {
            return 1;
        }

        // Check for at least one lowercase letter
        if (!/[a-z]/.test(password)) {
            return 2;
        }

        // Check for at least one uppercase letter
        if (!/[A-Z]/.test(password)) {
            return 3;
        }

        // Check for at least one digit
        if (!/[0-9]/.test(password)) {
            return 4;
        }

        // Check for at least one special character
        if (!/[!@#$%^&*]/.test(password)) {
            return 5;
        }

        return 0;
    }
});
