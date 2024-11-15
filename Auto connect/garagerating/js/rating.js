$(function () {
  $("#rateGarage").click(function () {
    $("#ratingDetails").hide();
    $("#ratingSection").show();
  });

  $("#cancelReview").click(function () {
    $("#ratingSection").hide();
    $("#ratingDetails").show();
  });

  // Implement star rating select/deselect
  $(".rateButton").click(function () {
    if ($(this).hasClass("btn-grey")) {
      $(this)
        .removeClass("btn-grey btn-default")
        .addClass("btn-warning star-selected");
      $(this)
        .prevAll(".rateButton")
        .removeClass("btn-grey btn-default")
        .addClass("btn-warning star-selected");
      $(this)
        .nextAll(".rateButton")
        .removeClass("btn-warning star-selected")
        .addClass("btn-grey btn-default");
    } else {
      $(this)
        .nextAll(".rateButton")
        .removeClass("btn-warning star-selected")
        .addClass("btn-grey btn-default");
    }
    $("#rating").val($(".star-selected").length);
  });

  // Save review using Ajax
  $("#ratingForm").on("submit", function (event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "action.php",
      data: formData,
      success: function (response) {
        if (response.success == 1) {
          $("#ratingForm")[0].reset();
          window.location.reload();
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        console.error(status);
        console.error(error);
      }
    });
    
  });
});
