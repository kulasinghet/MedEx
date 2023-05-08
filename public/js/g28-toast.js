// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Toast ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
class G28ToastNotification extends HTMLElement {
    constructor() {
        super();
        // element created

        this.toastTemplate = `
<div class="toast">
  <div class="toast-content">
    <div class="toast-icon success"></div>
    <div class="message">
      <span class="text text-1">Subject</span>
      <span class="text text-2">Message</span>
    </div>
  </div>
  <div class="close"></div>
  <div class="progress"></div>
</div>
    `;
    }

    connectedCallback() {
        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)

        const self = this; // Create a reference to the instance of G28ToastNotification
        this.timer1 = 0;
        this.timer2 = 0;

        // initializing toast variables
        let subject_text = this.getAttribute('subject') || '';
        let message_text = this.getAttribute('message') || '';
        let status = this.getAttribute('status') || 'success';

        // --------------------- RENDERING THE ELEMENT ---------------------
        // creating shadow root
        this.attachShadow({mode: "open"});
        this.renderElement();

        // initializing data of the toast
        this.subject.innerText = subject_text;
        this.message.innerText = message_text;
        this.changeStatus(status);

        // setting the animation after the element is rendered
        setTimeout(() => {
            this.toast.style.transition = "all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35)";
            // self.showToast(); // Call showToast after the toast element is available
        }, 100);
        // --------------------- RENDERING THE ELEMENT ---------------------

        // --------------------- EVENT LISTENERS ---------------------
        this.closeIcon.addEventListener("click", () => {
            this.toast.classList.remove("active");

            setTimeout(() => {
                this.progress.classList.remove("active");
            }, 300);

            clearTimeout(this.timer1);
            clearTimeout(this.timer2);
        });
        // --------------------- EVENT LISTENERS ---------------------
    }

    disconnectedCallback() {
        // browser calls this method when the element is removed from the document
        // (can be called many times if an element is repeatedly added/removed)
    }

    static get observedAttributes() {
        return ['status','subject', 'message'];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        // called when one of attributes listed above is modified

        if (name === 'status') {
            if (this.statusIcon) {
                this.changeStatus(newValue);
            }
        } else if (name === 'subject') {
            if (this.subject) {
                this.subject.innerText = newValue;
            }
        } else if (name === 'message') {
            if (this.message) {
                this.message.innerText = newValue;
            }
        }
    }

    renderElement() {
        // creating a template and attaching it to the shadow root
        const toastTemp = document.createElement("template");

        // adding stylesheet to the shadow DOM
        const styleLink = document.createElement('link');
        styleLink.rel = 'stylesheet';
        styleLink.href = configs.scssStylePath + '/components/toast.css';
        this.shadowRoot.appendChild(styleLink);

        toastTemp.innerHTML = this.toastTemplate;
        this.shadowRoot.appendChild(toastTemp.content.cloneNode(true));

        this.toast = this.shadowRoot.querySelector('.toast');
        this.closeIcon = this.shadowRoot.querySelector('.close');
        this.progress = this.shadowRoot.querySelector('.progress');
        this.statusIcon = this.shadowRoot.querySelector('.toast-icon');
        this.subject = this.shadowRoot.querySelector('.text-1');
        this.message = this.shadowRoot.querySelector('.text-2');
    }

    showToast() {
        this.toast.classList.add("active");
        this.progress.classList.add("active");

        this.timer1 = setTimeout(() => {
            this.toast.classList.remove("active");
        }, 5000); //1s = 1000 milliseconds

        this.timer2 = setTimeout(() => {
            this.progress.classList.remove("active");
            this.removeToast();
        }, 5300);
    }

    removeToast() {
        if (this.parentNode) {
            this.parentNode.removeChild(this);
        }
    }

    changeStatus(status) {
        if (status === 'success') {
            this.statusIcon.classList.remove('error');
            this.statusIcon.classList.add('success');
        } else if (status === 'error') {
            this.statusIcon.classList.remove('success');
            this.statusIcon.classList.add('error');
        }
    }
}

customElements.define('g28-toast', G28ToastNotification);
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Toast ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// Automatically show the toast notifications
window.onload = function () {
    let toastNotifications = document.querySelectorAll('g28-toast');
    let toastIndex = 0;

    toastNotifications.forEach((toast) => {
        const toast_inner = toast.shadowRoot.querySelector('.toast');
        let top = 64 + toastIndex * 100; // Adjust the values as needed

        // setting the position of the toast
        toast_inner.style.top = `${top}px`;

        // Show the toast after a delay
        setTimeout(() => {
            toast.showToast();
        }, 800 * toastIndex); // Delay based on the index
        toastIndex++;
    });
}

// JS version of creating a toast
function createToast(subject, message, type = null) {
    const toastElement = document.createElement('g28-toast');
    toastElement.setAttribute('status', type);
    toastElement.setAttribute('subject', subject);
    toastElement.setAttribute('message', message);
    document.body.appendChild(toastElement);

    return toastElement;
}
