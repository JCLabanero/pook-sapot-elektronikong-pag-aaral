$(document).ready(function () {
  $(".btn-close").click(function () {
    $(".alert").hide();
  });
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
        window.location.href = "adminlesson.php";
      },
      error: function () {
        alert("error!");
      },
    });
  });
  $("#updateAccountForm").submit(function (event) {
    event.preventDefault();
    var form = $(this)[0];
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
        var res = $.parseJSON(response);
        $(".form-control").removeClass("border-success border-danger");
        if (res.updatedFields) {
          res.updatedFields.forEach((element) => {
            $("#" + element).addClass("border-success");
            if (element == "email")
              $("#" + element).attr("placeholder", $("#email").val());
            if (element == "username")
              $("#" + element).attr("placeholder", $("#username").val());
          });
        }
        if (res.status == 200) {
          $(".alert").hide().slideDown();
          form.reset();
        } else {
          $(".alert").hide().slideDown();
        }
        if (res.errorFields) {
          res.errorFields.forEach((element) => {
            $("#" + element).addClass("border-danger");
          });
        }
        $(".alert-message").text(res.message);
      },
      error: function () {
        alert("error within file");
      },
    });
  });
  $("#editAccountForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var form = $(this);
    data = {
      id: $("#id").val(),
      username: $("#username").val(),
      email: $("#email").val(),
      password: $("#password").val(),
    };

    $.ajax({
      url: "../php/account_edit.php", // Path to your PHP login script
      type: "POST",
      data: data, // Send data as a JSON object
      success: function (response) {
        var res = $.parseJSON(response);
        $(".form-control").removeClass("border-danger border-success");
        if (res.updatedFields) {
          res.updatedFields.forEach((element) => {
            $("#" + element).addClass("border-success");
            if (element == "email")
              $("#" + element).attr("placeholder", $("#email").val());
            if (element == "username")
              $("#" + element).attr("placeholder", $("#username").val());
          });
        }
        if (res.status == 200) {
          $(".alert").hide().slideDown();
          form[0].reset();
        }
        if (res.errorFields) {
          res.errorFields.forEach((element) => {
            $("#" + element).addClass("border-danger");
          });
        }
        $(".alert").hide().slideDown();
        $(".alert-message").text(res.message);
      },
      error: function () {
        alert("An error occurred during login.");
      },
    });
  });

  // Event delegation to handle click events on buttons with the 'btn-danger' class
  $(document).on("click", "button.account-edit", function () {
    // Get the data attributes from the button
    var id = $(this).data("id");

    // Call the toAccountEdit function with the data
    var url = "adminaccountedit.php?";
    url += "id=" + encodeURIComponent(id);

    window.location.href = url;
  });

  $(document).on("click", "button.account-delete", function () {
    // Get the data attributes from the button
    var id = $(this).data("id");
    $.ajax({
      url: "../php/account_delete.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        var res = $.parseJSON(response);
        if (res.status == 200) {
          $(".alert").hide().slideDown();
        }
        $(".alert-message").text(res.message);
      },
    });
  });
  $(".lesson-delete").click(function () {
    var id = $(this).data("id");
    $.ajax({
      url: "../php/lesson_delete.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        var res = $.parseJSON(response);
        if (res.status == 200) {
          $("#" + id).fadeOut();
        }
        $(".alert").hide().slideDown();
        $(".alert-message").text(res.message);
      },
    });
  });
});
