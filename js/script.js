// --- TOGGLE ACTIVE CLASS ---

// SIMPAN CLASS NAVBAR-NAV KE VARIABEL SEMENTARA
const navbarNav = document.querySelector(".navbar-nav");

// GET ID HAMBURGER MENU, DAN AKSI KETIKA DIKLIK
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// KLIK DI LUAR SIDEBAR UNTUK MENGHILANGKAN SIDEBAR / NAV
const hamburgerMenu = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
  if (!hamburgerMenu.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

// --- JAVASCRIPT TO CALL PHP ON SUBMIT FORM ---
const form = document.querySelector(".contact .row form");
const statusTxt = form.querySelector(".contact .row form .status span");

form.onsubmit = (e) => {
  e.preventDefault();
  statusTxt.style.color = "#00f9ff";
  statusTxt.style.display = "block";
  statusTxt.innerText = "Sending your message...";
  form.classList.add("disabled");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/submit.php", true);
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.response;
      if (response.indexOf("Invalid") != -1) {
        statusTxt.style.color = "#fff";
      } else {
        form.reset();
        grecaptcha.reset();
        setTimeout(() => {
          statusTxt.style.display = "none";
        }, 3000);
        statusTxt.style.color = "#fff";
      }
      statusTxt.innerText = response;
      form.classList.remove("disabled");
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
