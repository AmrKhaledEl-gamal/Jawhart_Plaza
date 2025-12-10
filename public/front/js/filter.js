const rangeMin = document.getElementById("rangeMin");
const rangeMax = document.getElementById("rangeMax");
const rangeValue = document.getElementById("rangeValue");
const rangeTrack = document.getElementById("rangeTrack");

function updateRange() {
  let min = parseInt(rangeMin.value);
  let max = parseInt(rangeMax.value);

  if (min > max) {
    let temp = min;
    min = max;
    max = temp;
  }

  rangeValue.textContent = min + "JD" + " - " + max + "JD";
  rangeTrack.style.left = (min / 5000) * 100 + "%";
  rangeTrack.style.right = 100 - (max / 5000) * 100 + "%";
}

updateRange();

const filterBtn = document.querySelector(".fa-filter-list");
const filterInner = document.querySelector(".filterInner");
filterBtn.addEventListener("click", () => {
  filterInner.classList.toggle("active");
});
