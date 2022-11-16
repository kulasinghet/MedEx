const delay = 5000;

window.onload = () => {
  const carousel = document.getElementById("carousel");
  const imgGallery = carousel.querySelectorAll(".carousel-gallery")[0];
  const slides = imgGallery.querySelectorAll(".carousel-image");
  const slidesCount = slides.length;
  const maxleft = (slidesCount - 1) * 100 * -1;
  let slideIndex = 0;
  let galleryPosition = 0;

  // Initializing the carousel
  fixImageSizes();
  // slides autochange function
  let autochange = setInterval(changeSlides, delay);
  const restart = () => {
    clearInterval(autochange);
    autochange = setInterval(changeSlides, delay);
  };

  // Event Listeners
  window.addEventListener("resize", () => {
    fixImageSizes();
  });

  carousel.querySelectorAll(".carousel-next").forEach((btn) => {
    btn.addEventListener("click", () => {
      changeSlides();
      restart();
    });
  });

  carousel.querySelectorAll(".carousel-prev").forEach((btn) => {
    btn.addEventListener("click", () => {
      changeSlides(false);
      restart();
    });
  });
  // Event Listeners

  function fixImageSizes() {
    slides.forEach((img) => {
      // changing image size based on the carousel size changes
      img.style.width = window.getComputedStyle(carousel).width;
      // for debugging purposes
      console.log("New img size: " + window.getComputedStyle(img).width);
    });
  }
  
  function changeSlides(next = true) {
    // set current slide faded
    slides[slideIndex].classList.add("fade");
  
    // repositioning based on next parameter
    if (next) {
      galleryPosition += galleryPosition > maxleft ? -100 : galleryPosition * -1;
    } else {
      galleryPosition += galleryPosition < 0 ? 100 : maxleft;
    }
  
    // applying the new position for the carousel gallery
    imgGallery.style.left = galleryPosition + "%";
    // changing the slide
    slideIndex = (galleryPosition * -1) / 100;
    // remove the fadeness from the new slide
    slides[slideIndex].classList.remove("fade");
  
    // for debugging purposes
    console.log("sildes changed:" + (slideIndex + 1) + "/" + slidesCount);
    console.log("New left: " + window.getComputedStyle(imgGallery).left);
  }
};
