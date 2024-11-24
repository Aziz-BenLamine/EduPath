const sidebar = document.querySelector(".sidebar");
const toggleBtn = document.querySelector(".toggle-btn");

//SIDEBAR TOGGLE
toggleBtn.addEventListener("click", () => {
  sidebar.classList.toggle("hidden");
  sidebar.classList.toggle("shown");
  const content = document.querySelector(".content");
  if (content) content.classList.toggle("shifted");
  toggleBtn.innerHTML = sidebar.classList.contains("hidden")
    ? "&#9654;"
    : "&#9664;";
});

//ACTIVE LINK HIGHLIGHT
document.querySelectorAll(".sidebar a").forEach((link) => {
  link.addEventListener("click", () => {
    document.querySelector(".sidebar a.active")?.classList.remove("active");
    link.classList.add("active");
  });
});