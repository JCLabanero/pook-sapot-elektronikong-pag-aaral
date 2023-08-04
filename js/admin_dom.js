$(document).ready(function () {
	$(".btn-close").click(function () {
		$(".alert").hide();
	});
	$("#lessonUpdateForm").submit(function (event) {
		event.preventDefault();
		var form = $(this)[0];
		$.ajax({
			url: "../php/lesson_update.php",
			type: "POST",
			data: {
				id: $("input[name='id']").val(),
				title: $("#title").val(),
				content: $("#content").val(),
			},
			success: function (response) {
				var res = $.parseJSON(response);
				$(".form-control").removeClass("border-success border-danger");
				if (res.status == 200) {
					if (res.fields) {
						res.fields.forEach((element) => {
							$("#" + element).addClass("border-success");
						});
					}
				}
				$(".alert").hide().slideDown();
				$(".alert-message").text(res.message);
			},
		});
	});
	$("#quizCreateForm").submit(function (event) {
		event.preventDefault();
		var answers = $("[name^='answer']")
			.map(function () {
				return $(this).val();
			})
			.get();
		// console.log(answers);
		$.ajax({
			url: "../php/quiz_create.php",
			type: "POST",
			data: {
				lid: $("#lessonId").val(),
				question: $("#question").val(),
				answers: answers,
			},
			success: function (response) {
				var res = $.parseJSON(response);
				if (res.status == 200) {
					alert(res.message);
				}
			},
		});
	});
	// $("#lessonCreateForm").submit(function (event) {
	//   event.preventDefault();
	//   var title = $("#title").val();
	//   var content = $("#content").val();
	//   var form = $(this)[0];
	//   $.ajax({
	//     url: "../php/lesson_create.php",
	//     type: "post",
	//     data: {
	//       title: title,
	//       content: content,
	//     },
	//     success: function (response) {
	//       var res = $.parseJSON(response);
	//       if (res.status == 200) form.reset();

	//       $(".alert").hide().slideDown();
	//       $(".alert-message").text(res.message);
	//     },
	//     error: function () {
	//       alert("error!");
	//     },
	//   });
	// });
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
					form.reset();
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
					$("#" + id).fadeOut();
				}
				$(".alert-message").text(res.message);
			},
		});
	});
	$(".lesson-delete").click(function () {
		var id = $(this).data("id");
		var isInside = $(this).data("inside");
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
				if (isInside == "true" && res.status == 200) {
					window.location.href = "adminlesson.php";
				}
			},
		});
	});
	$(".lesson-update").click(function () {
		var id = $(this).data("id");
		var url = "adminlessoncontrol.php?";
		url += "id=" + encodeURIComponent(id);
		window.location.href = url;
	});
	$("#add-answer").click(function (params) {
		var count = $(this).data("cnt");
		count++;
		$(this).data("cnt", count);
		var answer = $("#answer-holder");
		var newAnswerHolder = $("<input>");
		newAnswerHolder.attr("type", "text");
		newAnswerHolder.attr("name", "answer");
		newAnswerHolder.addClass("w-100");
		newAnswerHolder.attr("placeholder", "Answer #" + count);
		answer.append(newAnswerHolder);
	});
	$("#add-answer-3").click(function () {
		var count = $("#add-answer").data("cnt");
		var countTotal = count + 3;
		for (let i = count + 1; i <= countTotal; i++) {
			var answer = $("#answer-holder");
			var newAnswerHolder = $("<input>");
			newAnswerHolder.attr("type", "text");
			newAnswerHolder.attr("name", "answer");
			newAnswerHolder.addClass("w-100");
			newAnswerHolder.attr("placeholder", "Answer #" + i);
			answer.append(newAnswerHolder);
		}
		$("#add-answer").data("cnt", countTotal);
	});
	$("#lessonCreateForm").submit(function (event) {
		event.preventDefault();
		const title = $("#title").val();
		const content = $("#content").val();
		const videoLink = $("#videoLink").val();
		const pdfSource = $("#pdfSource")[0].files[0];
		var form = $(this)[0];

		// Create a new FormData object
		var formData = new FormData();

		// Append the form data to the FormData object
		formData.append("title", title);
		formData.append("content", content);
		formData.append("videoLink", videoLink);
		formData.append("pdfSource", pdfSource);

		$.ajax({
			url: "../php/lesson_create.php",
			type: "POST",
			data: formData, // Use the FormData object as the data
			processData: false, // Prevent jQuery from processing data
			contentType: false, // Prevent jQuery from setting content type
			success: function (response) {
				var res = $.parseJSON(response);
				if (res.status === 200) form.reset();

				$(".alert").hide().slideDown();
				$(".alert-message").text(res.message);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("AJAX Request Error:");
				console.log("jqXHR:", jqXHR);
				console.log("textStatus:", textStatus);
				console.log("errorThrown:", errorThrown);

				alert("An error occurred. Please check the console for details.");
			},
		});
	});
});
