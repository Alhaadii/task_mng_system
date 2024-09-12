$("#login").on("submit", (e) => {
  e.preventDefault();

  let form_data = new FormData($("#login")[0]);
  form_data.append("action", "login");
  $.ajax({
    url: "login.php",
    type: "POST",
    data: form_data,
    processData: false,
    contentType: false,
    success: function (response) {
      const status = response.status;
      const msg = response.msg;
      console.log(status);
      if (status != "false") {
        alert(msg);
        location.href = "views/dashboard.php";
      } else {
        alert("you aren't allowed ..." + msg);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
