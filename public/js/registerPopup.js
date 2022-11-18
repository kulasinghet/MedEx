const modal = document.querySelector(".register-modal");
const trigger = document.querySelector(".register-trigger");
const closeButton = document.querySelector(".register-close-button");

function toggleModal() {
    modal.classList.toggle("register-show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

trigger.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);