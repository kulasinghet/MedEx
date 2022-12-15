window.onload = () => {
    const modal = document.querySelector('.details-modal');
    const trigger = document.querySelector('.details-modal-trigger');
    const closeButton = document.querySelector('.details-modal-close');
    let modalIsOpen = false;

    function showModal() {
        modal.style.display = 'flex';
        modalIsOpen = true;

        setTimeout(() => {window.addEventListener('click', windowOnClick);}, 1000);
    }

    function hideModal() {
        modal.style.display = 'none';
        modalIsOpen = false;

        window.removeEventListener('click', windowOnClick);
    }

    function windowOnClick(event) {
        event.preventDefault();
        if (event.target !== modal && modalIsOpen) {
            hideModal();
        }
    }

    trigger.addEventListener("click", showModal);
    closeButton.addEventListener("click", hideModal);
}