function scrollToDiv() {
  const divElement = document.querySelector(".container");
  divElement.scrollIntoView({ behavior: "smooth" });
}

const menuToggle = document.getElementById("menu-toggle");
const nav = document.querySelector("nav");

menuToggle.addEventListener("click", function () {
  if (nav.style.display === "block") {
    nav.style.display = "none";
    menuToggle.classList.remove("active");
  } else {
    nav.style.display = "block";
    menuToggle.classList.add("active");
  }
});

function goBack() {
  window.history.back();
}

for (var i = 0; i < 100; i++) {
  var dust = document.createElement('div');
  dust.className = 'dust';
  dust.style.left = Math.random() * 100 + '%';
  dust.style.top = Math.random() * 100 + '%';
  dust.style.animationDelay = Math.random() * 5 + 's';
  document.body.appendChild(dust);
}