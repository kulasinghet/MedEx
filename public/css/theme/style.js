window.onload = () => {
  // Initializing dropdowns
  document.querySelectorAll(".dropdown").forEach(dropdown => {
    const btn = dropdown.querySelector(".btn");
    const dropdownList = dropdown.querySelector(".dropdown-list");
    
    // Initializing caret icon
    const caret = document.createElement("i");
    caret.className = "fa-solid fa-caret-down dropdown-toggle";
    btn.appendChild(caret);

    // fixing the position of the dropdown-list
    // dropdownList.style.minWidth = "80%";
    // dropdownList.style.left = "10%"

    btn.addEventListener('click', () => {
      btnToggle();
    });

    dropdownList.addEventListener('mouseleave', () => {
      setTimeout(btnToggle, 800);
    })

    function btnToggle() {
      if (dropdownList.classList.contains("dropdown-active")) {
        dropdownList.classList.remove("dropdown-active");
        caret.style.transform = "rotate(0)";
      } else {
        dropdownList.classList.add("dropdown-active");
        caret.style.transform = "rotate(-0.5turn)";
      }
    }
  })
}