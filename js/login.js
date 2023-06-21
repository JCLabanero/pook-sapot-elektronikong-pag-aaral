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
            url: "php/login.php", // Path to your PHP login script
            type: "POST",
            data: JSON.stringify(data), // Send data as a JSON object
            contentType: "application/json", // Set the content type to JSON
            success: function (response) {
                // Handle the response from the server
                $.ajax({
                    url: 'php/session_check.php',
                    type: 'GET',
                    success: function (sessionResponse) {
                        if (sessionResponse === "active") {
                            window.location.href = 'html/adminmenu.php';
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
