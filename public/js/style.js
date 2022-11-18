window.onload = () => {
  // Initializing dropdowns
  document.querySelectorAll(".dropdown").forEach(dropdown => {
    const btn = dropdown.querySelector(".btn");
    const dropdownList = dropdown.querySelector(".dropdown-list");
    
    // Initializing caret icon
    const caret = document.createElement("i");
    caret.className = "fa-solid fa-caret-down dropdown-toggle";
    btn.appendChild(caret);

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
        dropdownExpanded = false;
      } else {
        dropdownList.classList.add("dropdown-active");
        caret.style.transform = "rotate(-0.5turn)";
        dropdownExpanded = true;
      }
    }
  })
}