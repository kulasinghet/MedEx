// Initializing config variables
initConfigs({stage: 'dev'});
initConfigs({customFormElmPath: '../scss/components/forms'});


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Selector ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
document.querySelectorAll('.selector-group').forEach(selectorGrp => {
  const label = selectorGrp.querySelector('label');

  if (selectorGrp.contains(label)) {
    selectorGrp.classList.add('has-label');
  }
});
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Selector ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SelectBox ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
class G28Selectbox extends HTMLElement {
  constructor() {
    super();
    // element created

    this.valueChanged = false;
    this.sbListExistTimeoutVal = 1000;
    this.sbTemplate = `
    <div class="selectbox" tabindex="0">
        <div class="selectbox-display">
            <span class="selectbox-display-text placeholder">Please select an item</span>
        </div>
        <div class="selectbox-list">
            <ul></ul>
        </div>
    </div>
    `;
  }

  connectedCallback() {
    // browser calls this method when the element is added to the document
    // (can be called many times if an element is repeatedly added/removed)

    // initializing selectbox variables
    this.opened = this.getAttribute('opened') === "" || false;
    this.placeholder = this.getAttribute('placeholder') || '';

    // taking the list of content into an array
    const listContents = this.innerText.trim().split(/,\s+/);
    this.innerHTML = ''; // clean up

    // --------------------- RENDERING THE ELEMENT ---------------------
    // creating shadow root
    this.attachShadow({mode: "open"});
    this.renderElement();
    // adding list items
    for (const itm of listContents) {
      const sbListItm = document.createElement('li');
      sbListItm.innerText = itm;
      this.sbListInner.appendChild(sbListItm);
    }
    // adding simplebar api
    new SimpleBar(this.sbList, { autoHide: false });

    // adding disabled styles if the element is disabled.
    if (this.isDisabled()) {
      this.sb.classList.add('disabled');
    }

    // initializing the value of the selectbox
    if (this.hasAttribute('value')) {
      // removing placeholder class from the display text
      this.toggleClass(this.sbDisplayText, 'placeholder', false);

      setTimeout(() => this.sbDisplayText.innerText = this.getAttribute('value'));
      this.valueChanged = true;
    }
    // --------------------- RENDERING THE ELEMENT ---------------------

    // --------------------- EVENT LISTENERS ---------------------
    this.sbDisplay.addEventListener('click', (e) => {
      e.preventDefault();
      this.toggleAttribute('opened');
    });

    this.sbList.addEventListener('mouseenter', (e) => {
      if (e.target === this.sbList  && this.opened) {
        clearTimeout(this.sbListExistTimeout);
        logger("mouseenter triggered on the list of SelectBox");
      }
    });

    this.sbList.addEventListener('mouseleave', (e) => {
      if (e.target === this.sbList  && this.opened) {
        this.sbListExistTimeout = setTimeout(() => {
          this.toggleAttribute('opened', false);
          logger("mouseleave triggered on the list of SelectBox");
        }, this.sbListExistTimeoutVal);
      }
    });

    this.sbList.querySelectorAll('li').forEach(listItm => {
      listItm.addEventListener('click', (e) => {
        e.preventDefault();
        this.setAttribute('value', listItm.innerText);
        // creating a custom event triggered when the value is changed
        this.valueChanged = true;
        this.dispatchEvent(
            new CustomEvent('change',
                {
                  detail: {value: listItm.innerText}
                }
                )
        );

        setTimeout(() => {
          this.toggleAttribute('opened', false);
          logger("mouseclick triggered on the list of SelectBox");
        }, this.sbListExistTimeoutVal * 10 / 100);

        // prevent triggering mouseleave event
        setTimeout(() => {
          clearTimeout(this.sbListExistTimeout);
        }, this.sbListExistTimeoutVal * 80 / 100);
      });
    });
  }

  disconnectedCallback() {
    // browser calls this method when the element is removed from the document
    // (can be called many times if an element is repeatedly added/removed)
  }

  static get observedAttributes() {
    return ['opened','placeholder', 'value'];
  }

  attributeChangedCallback(name, oldValue, newValue) {
    // called when one of attributes listed above is modified

    if (name === 'opened') {
      if (newValue !== null) {
        this.toggleClass(this.sb, 'opened', true);
        this.opened = true;
      } else {
        this.toggleClass(this.sb, 'opened', false);
        this.opened = false;
      }
    } else if (name === 'value' && this.valueChanged) {
      // removing placeholder class from the display text
      this.toggleClass(this.sbDisplayText, 'placeholder', false);

      this.sbDisplayText.innerText = newValue;
    } else if (name === 'placeholder' && !this.valueChanged) {
      setTimeout(() => this.sbDisplayText.innerText = newValue);
    }
  }

  renderElement() {
    // creating a template and attaching it to the shadow root
    const sbTemp = document.createElement("template");

    // adding simplebar API
    const simpleBarLink = document.createElement('link');
    simpleBarLink.rel = 'stylesheet';
    simpleBarLink.href = "https://unpkg.com/simplebar@latest/dist/simplebar.css";
    this.shadowRoot.appendChild(simpleBarLink);

    // adding stylesheet to the shadow DOM
    const styleLink = document.createElement('link');
    styleLink.rel = 'stylesheet';
    styleLink.href = configs.scssStylePath + 'components/forms/form-selectbox.css';
    this.shadowRoot.appendChild(styleLink);

    sbTemp.innerHTML = this.sbTemplate;
    this.shadowRoot.appendChild(sbTemp.content.cloneNode(true));

    this.sb = this.shadowRoot.querySelector('.selectbox');
    this.sbDisplay = this.shadowRoot.querySelector('.selectbox-display');
    this.sbDisplayText = this.shadowRoot.querySelector('.selectbox-display-text');
    this.sbList = this.shadowRoot.querySelector('.selectbox-list');
    this.sbListInner = this.shadowRoot.querySelector('.selectbox-list ul');
  }

  toggleClass(elm, className, force = null) {
    if (elm) {
      if (elm.classList.contains(className) && force !== true) {
        elm.classList.remove(className);

        // removing class attribute
        if (elm.className === '') {
          elm.removeAttribute('class');
        }
      } else {
        if (force !== false) {
          elm.classList.add(className);
        }
      }
    }

    return elm;
  }

  isDisabled() {
    return this.classList.contains('disabled');
  }

  getValue() {
    return this.getAttribute('value') || '';
  }

  setValue(val) {
    this.setAttribute('value', val);
  }
}

customElements.define('g28-selectbox', G28Selectbox);
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SelectBox ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Overrides ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
document.querySelectorAll('form').forEach(frm => {
  const frmElements = frm.querySelectorAll('input, select, textarea, g28-selectbox');

  frm.addEventListener('submit', (e) => {
    // Creating a new FormData object
    const formData = new FormData(frm);
    frmElements.forEach(elem => {
      // Adding the value of the custom input element to the form data
      if (elem.nodeName === 'G28-SELECTBOX') {
        formData.append(elem.id, elem.getValue());
      } else if (elem.getAttribute('type') === 'radio' ||
          elem.getAttribute('type') === 'checkbox') {
        formData.append(elem.id, elem.checked);
      }
      else {
        formData.append(elem.id, elem.value);
      }
    })

    // Submitting the form with the updated form data
    fetch(frm.action, {
      method: frm.method,
      body: formData,
    }).then(r => {
      logger('Form is submitted! Showing key-value pairs.');
      for (const pair of formData.entries()) {
        logger(pair[0]+ ': ' + pair[1]);
      }

      // redirect to the URL in the response
      window.location.href = r.url;
    });

    e.preventDefault();
  });
});
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Overrides ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
