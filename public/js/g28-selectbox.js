const sbPlaceholderDef = 'Please select an item';
const sbShadowTmp = `
<div class="selectbox">
    <div class="selectbox-display" tabindex="0">
        <span class="selectbox-display-text placeholder">Please select an item</span>
    </div>
    <ul class="selectbox-list"></ul>
</div>
`;
//const itmListTimeout = 1000;

class G28Selectbox extends HTMLElement {
    constructor() {
        super();
        // element created
    }

    connectedCallback() {
        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)

        // initializing selectbox variables
        this.opened = this.getAttribute('opened') === "" || false;
        this.placeholder = this.getAttribute('placeholder') || sbPlaceholderDef;

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
            this.sbList.appendChild(sbListItm);
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
                logger("mouseenter triggered on the list of SelectBox[]");
            }
        });

        this.sbList.addEventListener('mouseleave', (e) => {
            if (e.target === this.sbList  && this.opened) {
                this.sbListExistTimeout = setTimeout(() => {
                    // this.toggleAttribute('opened', false);
                    logger("mouseleave triggered on the list of SelectBox[]");
                }, itmListTimeout);
            }
        });

        this.sbList.querySelectorAll('li').forEach(listItm => {
            listItm.addEventListener('click', (e) => {
                e.preventDefault();
                this.setAttribute('value', listItm.innerText);

                setTimeout(() => {
                    this.toggleAttribute('opened', false);
                    logger("mouseclick triggered on the list of SelectBox[]");
                }, itmListTimeout * 10 / 100);

                // prevent triggering mouseleave event
                setTimeout(() => {
                    clearTimeout(this.sbListExistTimeout);
                }, itmListTimeout * 80 / 100);
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
        }

        if (name === 'value') {
            // removing placeholder class from the display text
            this.toggleClass(this.sbDisplayText, 'placeholder', false);

            this.sbDisplayText.innerText = newValue;
        }
    }

    renderElement() {
        // creating a template and attaching it to the shadow root
        this.sbTemp = document.createElement("template");

        // adding stylesheet to the shadow DOM
        const styleLink = document.createElement('link');
        styleLink.rel = 'stylesheet';
        styleLink.href = '../scss/components/forms/selectbox.css';
        this.shadowRoot.appendChild(styleLink);

        this.sbTemp.innerHTML = sbShadowTmp;
        this.shadowRoot.appendChild(this.sbTemp.content.cloneNode(true));

        this.sb = this.shadowRoot.querySelector('.selectbox');
        this.sbDisplay = this.shadowRoot.querySelector('.selectbox-display');
        this.sbDisplayText = this.shadowRoot.querySelector('.selectbox-display-text');
        this.sbList = this.shadowRoot.querySelector('.selectbox-list');
    }

    toggleClass(elm, className, force = null) {
        if (elm !== null) {
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
}

customElements.define('g28-selectbox', G28Selectbox);