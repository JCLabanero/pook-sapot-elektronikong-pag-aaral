$(document).ready(function () {
    // Handle form submission
    $("#registrationForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form values
        var username = $("#username").val();
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
                    if (response === "Username already exists") {
                        $("#username").addClass("border-danger");
                    }
                    if (response.toString() === "Email already exists") {
                        
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
});
