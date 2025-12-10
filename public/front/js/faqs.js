document.addEventListener("DOMContentLoaded", () => {
  const faq = document.querySelectorAll(".faq");
  faq.forEach((e) => {
    e.addEventListener("click", () => {
      faq.forEach((el) => {
        e === el ? e.classList.toggle("active") : el.classList.remove("active");
      });
    });
  });
});
