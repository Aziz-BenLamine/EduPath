function validateForm() {
  var title = document.getElementById("title").value;
  var description = document.getElementById("description").value;
  var errorMessagetitle = "";
  var errorMessageDescription = "";

  if (title.trim() === "") {
    errorMessagetitle += "Title is required";
  }

  if (description.trim() === "") {
    errorMessageDescription += "Description is required";
  }

  errorMessage = errorMessagetitle + errorMessageDescription;
  if (errorMessage !== "") {
    document.getElementById("error-message-title").innerHTML =
      errorMessagetitle;
    document.getElementById("error-message-description").innerHTML =
      errorMessageDescription;
    return false;
  }

  return true;
}
