const cardNumInput = document.querySelector("#cardNum");
const cvvInput = document.querySelector("#cvv");
const visaIcon = document.querySelector("#visaIcon");
const mastercardIcon = document.querySelector("#mastercardIcon");
const amexIcon = document.querySelector("#amexIcon"); // Add this if you have an Amex icon
const discoverIcon = document.querySelector("#discoverIcon"); // Add this if you have a Discover icon

// Function to detect card type based on the card number
function detectCardType(cardNumber) {
  // Visa: Starts with 4, length 16
  if (/^4/.test(cardNumber)) {
    visaIcon.style.display = "inline-block";
    mastercardIcon.style.display = "none";
    amexIcon.style.display = "none";
    discoverIcon.style.display = "none";
  }
  // Mastercard: Starts with 5 or 2, length between 13 and 19
  else if (/^5[1-5]|^2[2-7]/.test(cardNumber)) {
    mastercardIcon.style.display = "inline-block";
    visaIcon.style.display = "none";
    amexIcon.style.display = "none";
    discoverIcon.style.display = "none";
  }
  // American Express: Starts with 34 or 37, length 15
  else if (/^3[47]/.test(cardNumber)) {
    amexIcon.style.display = "inline-block";
    visaIcon.style.display = "none";
    mastercardIcon.style.display = "none";
    discoverIcon.style.display = "none";
  }
  // Discover: Starts with 6011, 65, or 644-649, length 16-19
  else if (/^6011|^65|^64[4-9]/.test(cardNumber)) {
    discoverIcon.style.display = "inline-block";
    visaIcon.style.display = "none";
    mastercardIcon.style.display = "none";
    amexIcon.style.display = "none";
  } else {
    visaIcon.style.display = "none";
    mastercardIcon.style.display = "none";
    amexIcon.style.display = "none";
    discoverIcon.style.display = "none";
  }
}

// Card Number Input Validation and Icon Toggle
cardNumInput.addEventListener("input", function (e) {
  // Remove non-numeric characters
  e.target.value = e.target.value.replace(/\D/g, "").slice(0, 19);

  // Detect the card type after the input
  detectCardType(e.target.value);
});

// CVV Input Validation (3 digits for most cards, 4 for Amex)
cvvInput.addEventListener("input", function (e) {
  const cardNumber = cardNumInput.value;
  const isAmex = /^3[47]/.test(cardNumber); // Check if the card is Amex
  const maxLength = isAmex ? 4 : 3; // Set max length based on card type
  e.target.value = e.target.value.replace(/\D/g, "").slice(0, maxLength);
});

// Handle Paste Events for Card Number and CVV
[cardNumInput, cvvInput].forEach((input) => {
  input.addEventListener("paste", function (e) {
    e.preventDefault(); // Prevent default paste behavior
    let pastedData = (e.clipboardData || window.clipboardData)
      .getData("text")
      .replace(/\D/g, ""); // Clean pasted data

    if (input === cardNumInput) {
      input.value = pastedData.slice(0, 19); // Limit to 19 characters
      detectCardType(input.value); // Detect card type after pasting
    } else if (input === cvvInput) {
      const isAmex = /^3[47]/.test(cardNumInput.value); // Check if the card is Amex
      const maxLength = isAmex ? 4 : 3; // Set max length based on card type
      input.value = pastedData.slice(0, maxLength); // Limit to 3 or 4 characters
    }
  });
});
const dateInput = document.querySelector("#date");

// Date Input Validation and Formatting
dateInput.addEventListener("input", function (e) {
  let value = e.target.value.replace(/\D/g, ""); // Remove non-numeric characters
  if (value.length > 2) {
    value = value.slice(0, 2) + "/" + value.slice(2, 4); // Insert '/' after the first two digits
  }
  e.target.value = value.slice(0, 5); // Limit to 5 characters (MM/YY)
});

// Handle Paste Events for Date Input
dateInput.addEventListener("paste", function (e) {
  e.preventDefault(); // Prevent default paste behavior
  let pastedData = (e.clipboardData || window.clipboardData)
    .getData("text")
    .replace(/\D/g, ""); // Clean pasted data
  if (pastedData.length > 2) {
    pastedData = pastedData.slice(0, 2) + "/" + pastedData.slice(2, 4); // Format as MM/YY
  }
  dateInput.value = pastedData.slice(0, 5); // Limit to 5 characters
});
