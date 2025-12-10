const counterItems = document.querySelectorAll(".count");
counterItems.forEach((e) => {
  let i = 1;
  const minus = e.firstElementChild;
  const plus = e.lastElementChild;
  const count = e.firstElementChild.nextElementSibling;
  count.value = i;
  plus.addEventListener("click", () => {
    if (i >= 1) {
      i++;
      count.value = i;
    }
  });
  minus.addEventListener("click", () => {
    if (i > 1) {
      i--;
      count.value = i;
    }
  });
});
