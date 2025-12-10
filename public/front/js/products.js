const data = [
  {
    id: 1,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 2,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 3,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 4,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 5,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 6,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 7,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 8,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 9,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 10,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 11,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 12,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
  {
    id: 13,
    name: "Product Name",
    image: "../media/DONE1OUT.png",
    price_before: 250.0,
    price_after: 200.0,
    currency: "JD",
  },
];

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
const itemsIncart = document.querySelector(".itemsIncart");
const cartItemsCount = document.querySelectorAll(".cart span");

function ShowItems() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cartItemsCount.forEach((e) => {
    e.innerHTML = cart.length;
  });
  itemsIncart.innerHTML = "";

  if (cart.length === 0) {
    itemsIncart.innerHTML = `<p class="noItem">No items in the cart</p>`;
    return;
  }

  cart.forEach((item, index) => {
    itemsIncart.innerHTML += `
      <div class="itDcart" data-id="${item.id}">
        <img src="${item.image}" alt="${item.name}">
        <div class="itdd">
          <h3>${item.name}</h3>
          <span> ${item.price_after} ${item.currency}</span>
        </div>
        <i class="fa-regular fa-trash-can delete-item" data-id="${item.id}"></i>
      </div>
    `;
  });

  document.querySelectorAll(".delete-item").forEach((btn) => {
    btn.addEventListener("click", (event) => {
      let id = parseInt(event.target.dataset.id);
      RemoveFromCart(id);
    });
  });
}

function AddToCart(product) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const existingProduct = cart.find((item) => item.id === product.id);

  if (existingProduct) {
    Message("Item is already in the cart", true);
  } else {
    cart.push(product);
    localStorage.setItem("cart", JSON.stringify(cart));
    Message("Item added to the cart successfully");
    ShowItems();
  }
}

function RemoveFromCart(id) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart = cart.filter((item) => item.id !== id);
  localStorage.setItem("cart", JSON.stringify(cart));
  Message("Item removed from the cart", true);
  ShowItems();
}

ShowItems();

document.querySelectorAll('.colorradio input').forEach(input => {
  const color = input.value;
  const label = input.nextElementSibling;
  label.style.backgroundColor = color;
});