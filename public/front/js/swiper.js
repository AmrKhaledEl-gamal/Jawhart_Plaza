var swiper = new Swiper(".coSlider", {
  slidesPerView: 1,
  spaceBetween: 20,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 2,
    },
    400: {
      slidesPerView:3,
    },
    600: {
      slidesPerView:3,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});
var swiper = new Swiper(".homeSlider", {
  slidesPerView: 1,
  spaceBetween: 0,
  autoplay: {
    delay: 3000,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable:true
  },
});



var swiper3 = new Swiper(".imagesSlider", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  speed:400,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
  },
  
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    360: {
      slidesPerView: 1,
    },
    480: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1.5,
    },
    800: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 2.5,
    },
    1150: {
      slidesPerView: 3,
    },
    1250: {
      slidesPerView: 3,
    },
  },
});

var swiper3 = new Swiper("#imagesSlider", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  speed:400,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    360: {
      slidesPerView: 1,
    },
    480: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1.5,
    },
    800: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 2.5,
    },
    1150: {
      slidesPerView: 3,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});
var swiper3 = new Swiper("#imagesSlider2", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  speed:400,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    360: {
      slidesPerView: 1,
    },
    480: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1.5,
    },
    800: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 2.5,
    },
    1150: {
      slidesPerView: 3,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});
var swiper3 = new Swiper("#imagesSlider3", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  speed:400,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    360: {
      slidesPerView: 1,
    },
    480: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1.5,
    },
    800: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 2.5,
    },
    1150: {
      slidesPerView: 3,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});
var swiper3 = new Swiper("#imagesSlider4", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  speed:400,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  breakpoints: {
    300: {
      slidesPerView: 1,
    },
    360: {
      slidesPerView: 1,
    },
    480: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1.5,
    },
    800: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 2.5,
    },
    1150: {
      slidesPerView: 3,
    },
    1250: {
      slidesPerView: 4,
    },
  },
});


var swiper3 = new Swiper("#productImages", {
  slidesPerView: 1,
  spaceBetween: 20,
  keyboard: {
    enabled: true,
  },
  loop: true,
  speed: 500,
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return `<img class="${className}" src="${this.slides[index].firstElementChild.src}"></img>`;
    },
  },
  navigation: {
    nextEl: ".next",
    prevEl: ".prev",
  },
  on: {
    slideChange: function () {
      const videos = document.querySelectorAll("#productImages video");
      videos.forEach((video) => {
        video.pause();
        video.currentTime = 0;
      });
    },
  },
});