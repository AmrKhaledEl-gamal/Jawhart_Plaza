/**
 * Cart functionality - Database-driven via AJAX
 */

// Message notification helper
const Message = (message, isError) => {
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
    span.prepend(i);
    setTimeout(() => {
        div.remove();
    }, 3000);
};

// Color radio button styling
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".colorradio input").forEach((input) => {
        const color = input.value;
        const label = input.nextElementSibling;
        if (label) {
            label.style.backgroundColor = color;
        }
    });
});
