// Initializing Selectors
document.querySelectorAll('.selector-group').forEach(selectorGrp => {
  const label = selectorGrp.querySelector('label');

  if (selectorGrp.contains(label)) {
    selectorGrp.classList.add('has-label');
  }
});

console.log('Forms: JS loaded successfully!');