// Initializing variables
let stage = 'development';

// Utils
const logger = (str) => {
  if (stage === 'development') {
    console.log(str);
  }
}

// Initializing Selectors
document.querySelectorAll('.selector-group').forEach(selectorGrp => {
  const label = selectorGrp.querySelector('label');

  if (selectorGrp.contains(label)) {
    selectorGrp.classList.add('has-label');
  }
});

// Initializing SelectBoxes
const selectBoxes = {};

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
      }, 1500);
    }
  });

  list.addEventListener("click", () => {
    setTimeout(() => {
      selectBox.removeAttribute('open');
      logger("mouseclick triggered on the list of SelectBox[" + index + "]");
    }, 100);

    // prevent triggering mouseleave event
    setTimeout(() => {
      clearTimeout(selectBoxes[index].timeout);
    }, 1000);
  });
})


// confirmation
logger('Forms: JS loaded successfully!');
