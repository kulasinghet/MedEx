window.onload = () => {
  let slideIndex = 0;
  const carousel = document.getElementById("carousel");
  const carouselGallery = document.getElementById("carousel-gallery");
  const slides = carousel.querySelectorAll(".carousel-slide");
  const sildeImgs = carousel.querySelectorAll(".carousel-image");
  const carouselNext = carousel.querySelectorAll(".carousel-next");
  const carouselPrev = carousel.querySelectorAll(".carousel-prev");
  const slidesCount = slides.length;

  // Initializing the carousel
  slides[slideIndex].classList.add("active-slide");
  carouselGallery.classList.add("carousel-animation");
  fixSlideControllers();
  fixImageSizes();

  window.addEventListener("resize", () => {
    fixImageSizes();
    carouselGallery.classList.remove("carousel-animation");
    // for debugging purposes
    console.log("check: " + window.getComputedStyle(carouselGallery).transition);
    carouselSlideChange();
    carouselGallery.classList.add("carousel-animation");
  });

  carouselNext.forEach((btn) => {
    btn.addEventListener("click", () => {
      carouselSlideChange(1);
      fixSlideControllers();
    });
  });

  carouselPrev.forEach((btn) => {
    btn.addEventListener("click", () => {
      carouselSlideChange(-1);
      fixSlideControllers();
    });
  });

  function showSlideController(btnClass, appear) {
    btnClass.forEach((btn) => {
      if (appear) {
        btn.style.display = "flex";
      } else {
        btn.style.display = "none";
      }
    });
  }

  function fixSlideControllers() {
    if (slideIndex <= 0) {
      showSlideController(carouselPrev, false);
    } else {
      showSlideController(carouselPrev, true);
    }

    if (slideIndex >= slidesCount - 1) {
      showSlideController(carouselNext, false);
    } else {
      showSlideController(carouselNext, true);
    }
  }

  function fixImageSizes() {
    sildeImgs.forEach((img) => {
      img.style.width = window.getComputedStyle(carousel).width;
      // for debugging purposes
      console.log("New img size: " + window.getComputedStyle(img).width);
    });
  }

  function carouselSlideChange(step = 0) {
    // getting current size of the carousel
    let size = parseFloat(
      window.getComputedStyle(carousel).width.replace("px", "")
    );

    // set current slide faded
    slides[slideIndex].classList.add("fade");
    // changing the slide
    slideIndex = slideIndex + step;
    // applying the new position for the carousel gallery
    carouselGallery.style.left = (0 - (size * slideIndex)) + "px";
    // remove the fadeness from the new slide
    slides[slideIndex].classList.remove("fade");
    
    // for debugging purposes
    console.log("sildes changed:" + slideIndex + "/" + slidesCount);
    console.log("New left: " + window.getComputedStyle(carouselGallery).left);
  }
};
