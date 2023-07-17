$(document).ready(function () {
  // Handle form submission
  $("#alert-close").click(function () {
    $(".alert").hide();
  });
  $("#loginForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission
    // Get the form values
    var formData = {
      usernameOrEmail: $("#user").val(),
      password: $("#password").val(),
    };
    // Send an AJAX request to the server
    $.ajax({
      url: "php/account_authenticate.php",
      type: "POST",
      data: formData, // Send data as a JSON object
      success: function (response) {
        // Handle the response from the server
        var res = $.parseJSON(response);
        if (res.status == 200) {
          window.location.reload();
        } else {
          $("#password,#user").removeClass("border-danger");
          $(".alert").hide().slideDown();
          if (res.missingFields) {
            if (res.missingFields.includes("username"))
              $("#user").addClass("border-danger");
            if (res.missingFields.includes("password"))
              $("#password").addClass("border-danger");
            if (res.missingFields.includes("fields"))
              $("#password,#user").addClass("border-danger");
          }
          if (res.status == 404) $("#password,#user").addClass("border-danger");
          if (res.status == 403) $("#password").addClass("border-danger");

          $(".alert-message").text(res.message);
        }
      },
      error: function () {
        alert("An error occurred during login.");
      },
    });
  });

  $("#registrationForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form values
    // Create a data object to send to the server
    var data = {
      username: $("#username").val().toLowerCase(),
      password: $("#password").val(),
      email: $("#email").val(),
    };
    // Send an AJAX request to the server
    $.ajax({
      url: "php/account_create.php",
      type: "POST",
      data: data,
      success: function (response) {
        var res = $.parseJSON(response);
        $(".alert-link").hide();
        if (res.status == 200) {
          $(".form-control").removeClass("border-danger");
          $(".alert")
            .hide()
            .slideDown("fast")
            .removeClass("alert-warning")
            .addClass("alert-success");
          $(".alert-link").show();
          $(".alert-message").text(res.message);
          // window.location.href = "login.php";
        } else {
          $(".alert").hide().slideDown("fast").removeClass("alert-success");
          $(".form-control").removeClass("border-danger"); // Remove border-danger from all fields
          if (res.missingFields) {
            res.missingFields.forEach(function (field) {
              $("#" + field).addClass("border-danger"); // Add border-danger class to the missing fields
            });
          }
          $(".alert-message").text(res.message);
        }
      },
      error: function (xhr, status, error) {
        // Handle the AJAX error if needed
        console.log("Error:", error);
      },
    });
  });
});
