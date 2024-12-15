document.addEventListener("DOMContentLoaded", function () {
  const statutElement = document.getElementById("statut");
  const submitBtn = document.getElementById("submitBtn");

  if (statutElement) {
    const statut = statutElement.value;
    if (statut === "traité" && submitBtn) {
      submitBtn.disabled = true;
    }
  }
});

function validateName() {
  const nameElement = document.getElementById("name_a");
  const messageElement = document.getElementById("name-error");

  if (nameElement && messageElement) {
    const name = nameElement.value;
    if (name.length < 3 || !/^[a-zA-Z\s]+$/.test(name)) {
      showError(
        messageElement,
        "Le nom doit contenir au moins 3 caractères et uniquement des lettres et des espaces."
      );
    } else {
      showSuccess(messageElement, "Correct");
    }
  }
}

function validateDate() {
  const dateElement = document.getElementById("date_r");
  const messageElement = document.getElementById("date-error");

  if (dateElement && messageElement) {
    const date = dateElement.value;
    const today = new Date().toISOString().split("T")[0];

    if (date !== today) {
      showError(messageElement, "La date doit être la date courante.");
    } else {
      showSuccess(messageElement, "Correct");
    }
  }
}

function validateForm() {
  const nameElement = document.getElementById("name_a");
  // Ensure that the nameElement exists before accessing its value
  if (nameElement) {
    const name = nameElement.value;
    // Add further validation logic here
  }
}

// Ensure showError and showSuccess functions are defined
function showError(element, message) {
  element.textContent = message;
  element.style.color = "red";
}

function showSuccess(element, message) {
  element.textContent = message;
  element.style.color = "green";
}
