$(document).ready(function () {
    // Handle form submission
    $("#loginForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form values
        var usernameOrEmail = $("#user").val();
        var password = $("#password").val();

        // Perform validation
        if (usernameOrEmail === "" || password === "") {
            alert("Please fill in all fields.");
            return;
        }

        // Create a data object to send to the server
        var data = {
            usernameOrEmail: usernameOrEmail,
            password: password
        };

        // Send an AJAX request to the server
        $.ajax({
            url: "../php/login.php", // Path to your PHP login script
            type: "POST",
            data: data,
            success: function (response) {
                // Handle the response from the server
                if (response === "success") {
                    alert("Login successful!");
                    // Redirect the user to the dashboard or perform any other necessary action
                } else {
                    alert(response); // Display the error message received from PHP
                }
            },
            error: function () {
                alert("An error occurred during login.");
            }
        });
    });
});
