loadData();

btnAciton = "Insert";

// To open the modal when the button is clicked
$("#add").on("click", () => {
  $("#userModal").modal("show");
});

$("#userForm").submit(function (event) {
  event.preventDefault();
  let form_data = new FormData($("#userForm")[0]);

  if (btnAciton == "Insert") {
    form_data.append("action", "register");
  } else {
    form_data.append("action", "updateUser");
  }

  $.ajax({
    url: "../api/users.php",
    type: "POST",
    data: form_data,
    contentType: false,
    processData: false,
    success: function (response) {
      if (btnAciton == "Insert") {
        alert("Success! you have registerd Successfully!");
      } else {
        alert(response.msg);
      }
      $("#userForm")[0].reset();
      $("#userModal").modal("hide");
      btnAciton = "Insert";
      loadData();
    },
    error: function (error) {
      console.log("Error!", error);
    },
  });
});

function loadData() {
  let sendingData = { action: "getUsers" };
  $.ajax({
    url: "../api/users.php",
    data: sendingData,
    type: "post",
    success: function (response) {
      let status = response.status;
      let data = response.msg;
      let tr = "";
      if (status) {
        data.forEach((element) => {
          tr += "<tr>";
          for (i in element) {
            tr += `<td>${element[i]}</td>`;
          }

          tr += `<td>
            <button class="btn btn-warning editBtn" data-id="${element.id}">Edit</button>
            <button class="btn btn-danger deleteBtn" data-id="${element.id}">Delete</button>
          </td>`;
          tr += "</tr>";
        });
        $("#table tbody").html(tr);
      }
      //   console.log("loaded well enough");
    },
    error: function (error) {
      console.log(error.msg);
    },
  });
}

// updating the item
function fetchItem(id) {
  let sendingData = { action: "getUser", id: id };
  console.log(sendingData.id);
  $.ajax({
    url: "../api/users.php",
    type: "POST",
    datatype: "json",
    data: sendingData,
    success: function (response) {
      let data = response.msg[0];
      $("#id").val(data.id);
      $("#username").val(data.username);
      $("#password").val(data.password);
      $("#email").val(data.email);
      $("#type").val(data.type);
      $("#userModal").modal("show");
      btnAciton = "update";

      loadData();
    },
    error: function (error) {
      console.log(error.responseText);
    },
  });
}

// deleting the item
function deleteItem(id) {
  let sendingData = { action: "deletUser", id: id };
  $.ajax({
    data: sendingData,
    url: "../api/users.php",
    type: "post",
    success: function (response) {
      alert(response.msg);
      loadData();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

$("#table").on("click", ".editBtn", function () {
  let id = $(this).attr("data-id");
  console.log(id);
  fetchItem(id);
});
$("#table").on("click", ".deleteBtn", function () {
  let id = $(this).attr("data-id");
  console.log(id);

  if (confirm("Are you sure you want to delete this: " + id)) {
    deleteItem(id);
  }
});
