let links = document.querySelectorAll(".link");

links.forEach((e) => {
  e.addEventListener("click", () => {
    links.forEach((e) => {
      e.classList.remove("active");
    });
    e.classList.add("active");
  });
});

let drop = document.querySelectorAll(".drop");

drop.forEach((e) => {
  e.addEventListener("click", () => {
    e.classList.toggle("active");
  });
});

let nav = document.querySelector("nav");
let menu = document.querySelector(".menu");

menu.addEventListener("click", () => {
  nav.classList.toggle("activeMenu");
});

let cartInner = document.querySelector(".cartInner");
let cart = document.querySelectorAll(".cart");
let fabackwardfast = document.querySelector(".fa-backward-fast");
let continueBtn = document.querySelector("#continue");

cartInner.addEventListener("click", (e) => {
  if (e.target.classList.contains("cartInner")) {
    cartInner.classList.remove("active");
  }
});

cart.forEach((e) => {
  e.addEventListener("click", () => {
    cartInner.classList.add("active");
  });
});

fabackwardfast.addEventListener("click", () => {
  cartInner.classList.remove("active");
});

