$(document).ready(function () {
    // Handle form submission
    $("#edit-account").submit(function (event) {
        var username = $("#username").val().toLowerCase();
        var email = $("#email").val().toLowerCase();
        var password = $("#password").val();
        $.ajax({
            url:"../php/account_edit.php",
            type:"POST",
            data:{
                email: email,
                username: username,
                password: password
            },
            success: function () {
                alert("edit success");
            },
            error: function() {
                alert("edit failed");
            }
        })
    });
 
});
