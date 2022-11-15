window.onload = () => {
  let slideIndex = 0;
  const slides = document.getElementsByClassName("carousel-slide");
  const carouselNext = document.querySelectorAll(".carousel-next");
  const carouselPrev = document.querySelectorAll(".carousel-prev");
  const slidesCount = slides.length;

  // Initializing the carousel
  slides[slideIndex].classList.add("active-slide");
  fixSlideControllers();

  carouselNext.forEach((btn) => {
    btn.addEventListener("click", () => {
      // for debugging purposes
      console.log("sildes changed:" + slideIndex + "/" + slidesCount);
      slides[slideIndex].classList.remove("active-slide");
      slides[++slideIndex].classList.add("active-slide");

      fixSlideControllers();
    });
  });

  carouselPrev.forEach((btn) => {
    btn.addEventListener("click", () => {
      // for debugging purposes
      console.log("sildes changed:" + slideIndex + "/" + slidesCount);
      slides[slideIndex].classList.remove("active-slide");
      slides[--slideIndex].classList.add("active-slide");

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
};
