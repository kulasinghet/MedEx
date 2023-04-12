// Initializing variables
initConfigs({stage: 'development'});

// Initializing Selectors
document.querySelectorAll('.selector-group').forEach(selectorGrp => {
  const label = selectorGrp.querySelector('label');

  if (selectorGrp.contains(label)) {
    selectorGrp.classList.add('has-label');
  }
});

// Initializing SelectBoxes
const selectBoxes = {};
const itmListTimeout = 1000;

document.querySelectorAll('details.form-selectbox').forEach((selectBox, index) => {
  const list = selectBox.querySelector('ul');

  selectBoxes[index] = {
    timeout: null
  };

  list.addEventListener("mouseenter", (e) => {
    if (e.target === list) {
      clearTimeout(selectBoxes[index].timeout);
      logger("mouseenter triggered on the list of SelectBox[" + index + "]");
    }
  });

  list.addEventListener("mouseleave", (e) => {
    if (e.target === list) {
      selectBoxes[index].timeout = setTimeout(() => {
        selectBox.removeAttribute('open');
        logger("mouseleave triggered on the list of SelectBox[" + index + "]");
      }, itmListTimeout);
    }
  });

  list.addEventListener("click", () => {
    setTimeout(() => {
      selectBox.removeAttribute('open');
      logger("mouseclick triggered on the list of SelectBox[" + index + "]");
    }, itmListTimeout * 10 / 100);

    // prevent triggering mouseleave event
    setTimeout(() => {
      clearTimeout(selectBoxes[index].timeout);
    }, itmListTimeout * 80 / 100);
  });
})
