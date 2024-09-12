loadData();

btnAciton = "Insert";

// To open the modal when the button is clicked
$("#add").on("click", () => {
  $("#taskModal").modal("show");
});

$("#taskForm").submit(function (event) {
  event.preventDefault();
  let form_data = new FormData($("#taskForm")[0]);

  if (btnAciton == "Insert") {
    form_data.append("action", "register");
  } else {
    form_data.append("action", "updateTask");
  }

  $.ajax({
    url: "../api/task.php",
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
      $("#taskForm")[0].reset();
      $("#taskModal").modal("hide");
      btnAciton = "Insert";
      loadData();
    },
    error: function (error) {
      console.log("Error!", error);
    },
  });
});

function loadData() {
  let sendingData = { action: "getTasks" };
  $.ajax({
    url: "../api/task.php",
    data: sendingData,
    type: "post",
    success: function (response) {
      let status = response.status;
      let data = response.msg;
      let card = "";
      if (status) {
        data.forEach((element) => {
          console.log(element);

          card += `<div class="col-md-4"><div class="card text-center">
                <div class="card-header">
                    ${element.title}
                </div>
                <div class="card-body">
                    <p class="card-text">${element.desc}</p>
                  
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-warning editBtn" data-id="${element.id}">Edit</button>
            <button class="btn btn-danger deleteBtn" data-id="${element.id}">Delete</button>
                </div>
            </div></div>`;
        });
        $("#card").html(card);
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
  let sendingData = { action: "getTask", id: id };
  console.log(sendingData.id);
  $.ajax({
    url: "../api/Task.php",
    type: "POST",
    datatype: "json",
    data: sendingData,
    success: function (response) {
      let data = response.msg[0];
      $("#id").val(data.id);
      $("#title").val(data.title);
      $("#desc").val(data.desc);
      $("#cat").val(data.category);
      $("#taskModal").modal("show");
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
  let sendingData = { action: "deletTask", id: id };
  $.ajax({
    data: sendingData,
    url: "../api/task.php",
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

$("#card").on("click", ".editBtn", function () {
  let id = $(this).attr("data-id");
  fetchItem(id);
});
$("#card").on("click", ".deleteBtn", function () {
  let id = $(this).attr("data-id");
  console.log(id);

  if (confirm("Are you sure you want to delete this: " + id)) {
    deleteItem(id);
  }
});
