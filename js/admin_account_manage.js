$(document).ready(function () {
    // Handle form submission
    $("#edit-account").submit(function (event) {
        var id = $("#id").val();
        var username = $("#username").val().toLowerCase();
        var email = $("#email").val().toLowerCase();
        var password = $("#password").val();
        $.ajax({
            url:"../php/account_edit.php",
            type:"POST",
            data:{
                id: id,
                email: email,
                username: username,
                password: password
            },
            success: function (response) {
                alert(response);
                $("#username").attr("placeholder",username);
                $("#email").attr("placeholder",email);
            },
            error: function() {
                alert("edit failed");
            }
        });
    });
 
});
