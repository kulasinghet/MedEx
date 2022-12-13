window.onload = () => {
  // Initializing dropdowns
  document.querySelectorAll(".dropdown").forEach(dropdown => {
    const btn = dropdown.querySelector(".btn");
    const dropdownList = dropdown.querySelector(".dropdown-list");
    let dropdownExpanded = false;

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
      if (dropdownList.classList.contains("active")) {
        dropdownList.classList.remove("active");
        caret.style.transform = "rotate(0)";
        dropdownExpanded = false;
      } else {
        dropdownList.classList.add("active");
        caret.style.transform = "rotate(-0.5turn)";
        dropdownExpanded = true;
      }
    }
  });
}