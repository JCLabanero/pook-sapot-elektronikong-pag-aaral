$(document).ready(function () {
  $("#lessonCreateForm").submit(function (event) {
    event.preventDefault();
    var title = $("#lessonTitle").val();
    var description = $("#lessonDesc").val();
    $.ajax({
      url: "../php/lesson_create.php",
      type: "post",
      data: {
        lessonTitle: title,
        lessonContent: description,
      },
      success: function (response) {
        alert(response);
      },
      error: function () {
        alert("error!");
      },
    });
  });
  $("#updateAccountForm").submit(function (event) {
    event.preventDefault();
    var id = $("#id").val();
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();

    data = {
      id: id,
      username: username,
      email: email,
      password: password,
    };
    $.ajax({
      url: "../php/account_update.php",
      type: "POST",
      data: data,
      success: function (response) {
        if (response == "success") {
          window.location.reload();
        } else {
          alert(response);
        }
      },
      error: function () {
        alert("error within file");
      },
    });
  });
  $("#editAccountForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var id = $("#id").val();
    var username = $("#username").val();
    var email = $("email").val();
    var password = $("password").val();

    data = {
      id: id,
      username: username,
      email: email,
      password: password,
    };

    $.ajax({
      url: "../php/account_edit.php", // Path to your PHP login script
      type: "POST",
      data: data, // Send data as a JSON object
      dataType: "json",
      success: function (response) {
        // Handle the response from the server
        if (response.status === "success") {
          window.location.href = response.href;
        } else {
          alert(response);
        }
      },
      error: function () {
        alert("An error occurred during login.");
      },
    });
  });
  // Event delegation to handle click events on buttons with the 'btn-danger' class
  $(document).on("click", "button.btn-success", function () {
    // Get the data attributes from the button
    var id = $(this).data("id");
    var username = $(this).data("username");
    var email = $(this).data("email");

    // Call the toAccountEdit function with the data
    toAccountEdit(id, username, email);
  });

  // Your toAccountEdit function
  function toAccountEdit(id, username, email) {
    // Replace this with your custom logic
    var url = "adminaccountedit.php?";
    url += "id=" + encodeURIComponent(id);
    url += "&username=" + encodeURIComponent(username);
    url += "&email=" + encodeURIComponent(email);

    window.location.href = url;
  }
});
