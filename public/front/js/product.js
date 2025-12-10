const btns = document.querySelectorAll(".secs button");
const detailsSection = document.getElementById("details");
const reviewsSection = document.getElementById("reviews");

if (btns.length >= 2) {
  btns.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      btns.forEach(b => b.classList.remove("active")); 
      btn.classList.add("active"); 

      detailsSection.style.display = index === 0 ? "block" : "none";
      reviewsSection.style.display = index === 1 ? "block" : "none";
    });
  });
}

const starRating = document.querySelectorAll("#star-rating i");
const rateInput = document.querySelector("#rate");

if (starRating.length > 0 && rateInput) {
  starRating.forEach((star, index) => {
    star.addEventListener("click", () => {
      const rating = index + 1; 

      starRating.forEach((s, i) => {
        s.className = i < rating ? "fa-solid fa-star" : "fa-light fa-star";
      });

      rateInput.value = rating;
      console.log(rateInput.value);
    });
  });
}
