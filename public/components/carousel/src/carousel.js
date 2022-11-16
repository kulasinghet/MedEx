window.onload = () => {
  const carousel = document.getElementById("carousel");
  const carouselGallery = document.getElementById("carousel-gallery");
  const slides = carousel.querySelectorAll(".carousel-image");
  const slidesCount = slides.length;
  const maxleft = (slidesCount - 1) * 100 * -1;
  const delay = 5000;
  let slideIndex = 0;
  let galleryPosition = 0;

  // Initializing the carousel
  fixImageSizes();

  window.addEventListener("resize", () => {
    fixImageSizes();
  });

  carousel.querySelectorAll(".carousel-next").forEach((btn) => {
    btn.addEventListener("click", () => {
      carouselSlideChange();
      restart();
    });
  });

  carousel.querySelectorAll(".carousel-prev").forEach((btn) => {
    btn.addEventListener("click", () => {
      carouselSlideChange(false);
      restart();
    });
  });

  // slides autochange function
  let autochange = setInterval(carouselSlideChange, delay);
  const restart = () => {
    clearInterval(autochange);
    autochange = setInterval(carouselSlideChange, delay);
  };

  function fixImageSizes() {
    slides.forEach((img) => {
      // changing image size based on the carousel size changes
      img.style.width = window.getComputedStyle(carousel).width;
      // for debugging purposes
      console.log("New img size: " + window.getComputedStyle(img).width);
    });
  }
  
  function carouselSlideChange(next = true) {
    // set current slide faded
    slides[slideIndex].classList.add("fade");
  
    // repositioning based on next parameter
    if (next) {
      galleryPosition += galleryPosition > maxleft ? -100 : galleryPosition * -1;
    } else {
      galleryPosition += galleryPosition < 0 ? 100 : maxleft;
    }
  
    // applying the new position for the carousel gallery
    carouselGallery.style.left = galleryPosition + "%";
    // changing the slide
    slideIndex = (galleryPosition * -1) / 100;
    // remove the fadeness from the new slide
    slides[slideIndex].classList.remove("fade");
  
    // for debugging purposes
    console.log("sildes changed:" + slideIndex + "/" + slidesCount);
    console.log("New left: " + window.getComputedStyle(carouselGallery).left);
  }
};
