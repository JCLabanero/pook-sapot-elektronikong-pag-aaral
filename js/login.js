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
            url: "php/signin.php", // Path to your PHP login script
            type: "POST",
            data: data, // Send data as a JSON object
            success: function (response) {
                // Handle the response from the server
                $.ajax({
                    url: 'php/session_create.php',
                    type: 'GET',
                    data: {
                        user : usernameOrEmail
                    },
                    success: function (sessionResponse) {
                        if (sessionResponse === "active") {
                            window.location.reload();
                        } else {
                            alert("Session is not active.");
                        }
                    },
                    error: function () {
                        alert("An error occurred during session check.");
                    }
                });
            },
            error: function () {
                alert("An error occurred during login.");
            }
        });
    });
});