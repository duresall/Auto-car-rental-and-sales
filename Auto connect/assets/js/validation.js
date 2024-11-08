$("#form input, #form select").on("keyup blur", function () {
  $(this).valid();
});
$(document).ready(function () {
  // Initialize form validation
  $("#form").validate({
    rules: {
      platenumber: {
        required: true,
      },
      VehicleTitle: {
        required: true,
        pattern: /^[a-zA-Z\s]+$/,
      },
      brandname: {
        required: true,
      },
      location: {
        required: true,
      },
      price: {
        required: true,
        number: true,
      },
      modelyear: {
        required: true,
        number: true,
      },
      seatingcapacity: {
        required: true,
      },
      mileage: {
        required: true,
      },
      vehicle_for: {
        required: true,
      },

      FuelType: {
        required: true,
      },
      img1: {
        required: true,
      },
      img2: {
        required: true,
      },
      img3: {
        required: true,
      },
      img4: {
        required: true,
      },
    },
    messages: {
      // Add custom error messages if needed
    },
    errorPlacement: function (error, element) {
      element.closest(".form-group").find(".error").empty();
      error.appendTo(element.closest(".form-group").find(".error"));
      error.addClass("error-message");
    },
    highlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error")
        .addClass("has-success");
    },
  });

  // Trigger validation on blur event for each input field individually
  $("#platenumber").on("blur", function () {
    $(this).valid();
  });

  $("#VehicleTitle").on("blur", function () {
    $(this).valid();
  });

  $("#brandname").on("blur", function () {
    $(this).valid();
  });

  $("#location").on("blur", function () {
    $(this).valid();
  });

  $("#price").on("blur", function () {
    $(this).valid();
  });

  $("#modelyear").on("blur", function () {
    $(this).valid();
  });

  $("#seatingcapacity").on("blur", function () {
    $(this).valid();
  });

  $("#vehicle_for").on("blur", function () {
    $(this).valid();
  });

  $("#FuelType").on("blur", function () {
    $(this).valid();
  });

  $("#img1").on("blur", function () {
    $(this).valid();
  });

  $("#img2").on("blur", function () {
    $(this).valid();
  });

  $("#img3").on("blur", function () {
    $(this).valid();
  });

  $("#img4").on("blur", function () {
    $(this).valid();
  });

  $("#saveChangesBtn").click(function (event) {
    if ($("#form").valid()) {
      console.log("Save changes button clicked");
    } else {
      event.preventDefault();
    }
  });
});
