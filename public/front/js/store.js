const showMoreBtns = document.querySelectorAll(".servx button");
const servicesWraps = document.querySelectorAll(".servicesWrap");
document.addEventListener("DOMContentLoaded", () => {
  const servx = document.querySelectorAll(".servx");
  servx.forEach((e) => {
    e.addEventListener("click", () => {
      servx.forEach((el) => {
        el.classList.remove("active");
      });
      e.classList.add("active");
    });
  });
});

showMoreBtns.forEach((e) => {
  e.addEventListener("click", () => {
    e.previousElementSibling.classList.toggle("active");
    if (e.previousElementSibling.classList.contains("active")) {
      e.innerHTML = "عرض أقل";
    } else {
      e.innerHTML = "عرض المزيد";
    }
  });
});

servicesWraps.forEach((e) => {
  e.addEventListener("click", () => {
    e.parentElement.classList.toggle("active");
  });
});

const nextBtn = document.getElementById("nextBtn");
const step1 = document.getElementById("step1");
const step2 = document.getElementById("step2");
const step3 = document.getElementById("step3");
const step4 = document.getElementById("step4");
const datePicker = document.getElementById("datePicker");
const timePicker = document.getElementById("timePicker");
const infoInputs = document.querySelectorAll("#required");
const datetime = document.getElementById("datetime");
const services = document.getElementById("services");
const info = document.getElementById("info");
const confirmSec = document.getElementById("confirm");
let i = 0;

const message = (message, isError) => {
  const div = document.createElement("div");
  div.className = isError ? "message errorMessage" : "message";
  const span = document.createElement("span");
  const i = document.createElement("i");
  i.className = isError
    ? "fa-regular fa-circle-x"
    : "fa-regular fa-circle-check";
  span.innerHTML = message;
  document.body.appendChild(div);
  div.appendChild(span);
  span.appendChild(i);
  setTimeout(() => {
    div.remove();
  }, 3000);
};

nextBtn.addEventListener("click", () => {
  if (i === 0) {
    if (document.querySelector(".servx.active")) {
      step1.classList.add("active");
      services.style.display = "none";
      datetime.style.display = "";
      i++;
      return true;
    }
    message("برجاء اختيار خدمة", true);
    return true;
  }

  if (i === 1) {
    if (datePicker.value !== "" && timePicker.value !== "") {
      step2.classList.add("active");
      datetime.style.display = "none";
      info.style.display = "";
      i++;
      return true;
    }
    message(" يجب اختيار تاريخ ووقت", true);
    return true;
  }

  if (i === 2) {
    let allInputsFilled = true;
    infoInputs.forEach((input) => {
      if (input.value.trim() === "") {
        allInputsFilled = false;
        return true;
      }
    });

    if (allInputsFilled) {
      step3.classList.add("active");
      info.style.display = "none";
      confirmSec.style.display = "";
      i++;
      return true;
    }
    message("يجب تعبئة الحقول المطلوبة", true);
    return true;
  }

  if (i === 3) {
    nextBtn.parentElement.style.display = "none";
  }
});

step1.addEventListener("click", () => {
  datetime.style.display = "none";
  info.style.display = "none";
  confirmSec.style.display = "none";
  services.style.display = "";
  nextBtn.parentElement.style.display = "";
});

step2.addEventListener("click", () => {
  if (step1.classList.contains("active")) {
    datetime.style.display = "";
    info.style.display = "none";
    confirmSec.style.display = "none";
    services.style.display = "none";
    nextBtn.parentElement.style.display = "";
  }
});

step3.addEventListener("click", () => {
  if (
    step1.classList.contains("active") &&
    step2.classList.contains("active")
  ) {
    datetime.style.display = "none";
    info.style.display = "";
    confirmSec.style.display = "none";
    services.style.display = "none";
    nextBtn.parentElement.style.display = "";
  }
});

step4.addEventListener("click", () => {
  if (
    step1.classList.contains("active") &&
    step2.classList.contains("active") &&
    step3.classList.contains("active")
  ) {
    datetime.style.display = "none";
    info.style.display = "none";
    confirmSec.style.display = "";
    services.style.display = "none";
    nextBtn.parentElement.style.display = "none";
  }
});
