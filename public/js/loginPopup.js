const loginModal = document.querySelector(".login-modal");
const loginTrigger = document.querySelector(".login-trigger");
const loginCloseButton = document.querySelector(".login-close-button");

function toggleModal() {
    loginModal.classList.toggle("login-show-modal");
}

function windowOnClick(event) {
    if (event.target === loginModal) {
        toggleModal();
    }
}

loginTrigger.addEventListener("click", toggleModal);
loginCloseButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);