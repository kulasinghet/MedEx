function initGrid() {
  document.querySelectorAll(".grid").forEach(grid => {
    let max_row = 1;

    Array.from(grid.children).forEach(child => {
      child.classList.forEach(cls => {
        // considering grid rows
        if (cls.startsWith('g-row-')) {
          // https://www.regular-expressions.info/lookaround.html
          let row = Number(cls.match(/(?<=g-row-)[0-9]+/i));
          let span = Number(cls.match(/(?<!g-row-)[0-9]+/i));
          // console.log("row: " + row + " span: " + span); // for debugging

          // calculating the max value of the row that used in the grid
          let value = row + ((span !== 0)? span - 1 : 0);
          if (max_row < value) {
            max_row = value;
          }
        }
      })
    });

    // setting template grid rows of the grid
    grid.style.gridTemplateRows = `repeat(${max_row}, 1fr)`;
  });
}

function initDropDown() {
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

window.onload = () => {
  // Initializing components
  initGrid();
  // initDropDown(); // not included with the new scss framework
}