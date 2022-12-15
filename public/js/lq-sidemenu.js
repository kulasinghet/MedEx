const lqsCollapsedWidth = 52;
const lqsTemplate = `
<!-- external stylesheet -->
<link href="../scss/main.css" rel="stylesheet"/>

<div class="sidebar-toggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
    </svg>
</div>
<svg xmlns="http://www.w3.org/2000/svg" class="sidebar-blob">
    <path d="M60,500H0V0h60c0,0,20,172,20,250S60,900,60,500z"/>
</svg>
<div class="sidebar-inner">
    <div class="sidebar-context">
        <div class="sidebar-context-top">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx Logo with name" src="../res/logo/logo-text_light.svg"/>
                </a>
            </div>
            <div class="sidebar-handlers">
                <input class="switch" data-action="sidebar-auto-hide" id="sidebar-autohide" type="checkbox">
                <label for="sidebar-autohide">Auto Hide</label>
            </div>
        </div>
        <div class="sidebar-list"></div>
    </div>
</div>
`;

let viewport = {
    x: 0,
    y: 0,
    width: 0,
    height: 0,
};

function trackMousePosition(e) {
    // event handler for mousemove event
    viewport.x = e.x;
    viewport.y = e.y;
}

function registerMouseTracker() {
    window.addEventListener("mousemove", trackMousePosition);
}

function unregisterMouseTracker() {
    window.removeEventListener("mousemove", trackMousePosition);
    // fix x and y to the middle of the screen
    viewport.x = viewport.width / 2;
    viewport.y = viewport.height / 2;
}

window.onload = () => {
    viewport.height = window.innerHeight;
    viewport.width = window.innerWidth;
    viewport.y = viewport.height / 2;

    // Adding a padding to the elements to make space
    document.querySelectorAll("nav").forEach(itm => itm.style.paddingLeft = `${lqsCollapsedWidth}px`);
    document.querySelectorAll(".canvas").forEach(itm => itm.style.paddingLeft = `${lqsCollapsedWidth}px`);

    window.addEventListener("resize", () => {
        viewport.height = window.innerHeight;
        viewport.width = window.innerWidth;
    });
}

class LiquidSideMenu extends HTMLElement {
    constructor() {
        super();
        // element created

        // component variables
        this.menuExpanded = false;
        this.autoHide = true;

        // blob variables
        this.curveX = 10;
        this.curveY = 0;
        this.targetX = 0;
        this.xIteration = 0;
        this.yIteration = 0;
    }

    static get observedAttributes() {
        return ['menu-expanded', 'auto-hide'];
    }

    connectedCallback() {
        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)

        // creating shadow root
        this.isDevMode = this.getAttribute('dev-mode') === "" || false;
        this.attachShadow({mode: this.isDevMode ? "open" : "closed"});

        // rendering the component
        this.renderElement();
        setTimeout(() => {
            this.lqsContext.querySelector(".sidebar-list").innerHTML += this.innerHTML;
            this.innerHTML = "";
        });
        // rendering the animation
        if (this.autoHide) {
            this.registerSVGAnimation();
        }

        // EVENT LISTENERS
        this.lqsInner.addEventListener("mousemove", () => {
            // using this condition to prevent repeating
            if (!this.menuExpanded && this.autoHide) {
                this.expandSidebar(!this.menuExpanded);
            }
        });

        this.lqsInner.addEventListener("mouseleave", () => {
            // using this condition to prevent repeating
            if (this.menuExpanded && this.autoHide) {
                this.expandSidebar(!this.menuExpanded);
            }
        });

        // Toggle does not need a mouse leave event
        this.toggle.addEventListener("mouseenter", () => {
            // using this condition to prevent repeating
            if (!this.menuExpanded && this.autoHide) {
                this.expandSidebar(!this.menuExpanded);
            }
        });

        // https://stackoverflow.com/questions/57387346/adding-event-listener-on-a-dom-element-inside-template-tag
        this.lqsContext.addEventListener("click", (e) => {
            if (e.target.dataset.action === "sidebar-auto-hide") {
                if (e.target.checked) {
                    this.expandSidebar();
                    this.registerSVGAnimation();
                    this.autoHide = true;
                    console.log("Liquid Sidebar: auto hide enabled");
                } else {
                    this.expandSidebar();
                    this.unregisterSVGAnimation();
                    this.autoHide = false;
                    console.log("Liquid Sidebar: auto hide disabled");
                }
            }
        });
        // EVENT LISTENERS
    }

    attributeChangedCallback(name, oldValue, newValue) {
        // called when one of attributes listed above is modified
        this.renderElement();
    }

    #easeOutExpo(currentIteration, startValue, changeInValue, totalIterations) {
        return (changeInValue * (-Math.pow(2, (-10 * currentIteration) / totalIterations) + 1) + startValue);
    }

    renderElement() {
        // rendering the main elements
        this.lqs = document.createElement("div");
        this.lqs.setAttribute("class", "sidebar");

        // creating a template and attaching it to the shadow root
        this.lqsTemp = document.createElement("template");
        this.lqsTemp.innerHTML = lqsTemplate;
        this.lqs.appendChild(this.lqsTemp.content.cloneNode(true));

        // menu toggle
        this.toggle = this.lqs.querySelector(".sidebar-toggle");

        // creating sidebar blob SVG
        this.blob = this.lqs.querySelector(".sidebar-blob");
        this.blobPath = this.blob.querySelector("path");

        this.lqsInner = this.lqs.querySelector(".sidebar-inner");
        this.lqsContext = this.lqs.querySelector(".sidebar-context");
        this.lqsContext.setAttribute("class", "sidebar-context");
        this.lqsAutoHideCheck = this.lqsContext.querySelector("#sidebar-autohide");
        if (this.autoHide) {
            this.lqsAutoHideCheck.setAttribute("checked", true);
        }

        // appending the sidebar to the shadow root
        this.shadowRoot.appendChild(this.lqs);
    }

    renderSVG() {
        const hoverZone = 150;
        const expandAmount = 20;
        const anchorDistance = 200;
        const curliness = anchorDistance - 40;

        if (this.curveX > viewport.x - 1 && this.curveX < viewport.x + 1) {
            this.xIteration = 0;
        } else {
            if (this.menuExpanded) {
                this.targetX = 0;
            } else {

                this.xIteration = 0;
                if (viewport.x > hoverZone) {
                    this.targetX = 0;
                } else {
                    this.targetX = -(((60 + expandAmount) / 100) * (viewport.x - hoverZone));
                }
            }
            this.xIteration++;
        }

        if (this.curveY > viewport.y - 1 && this.curveY < viewport.y + 1) {
            this.yIteration = 0;
        } else {
            this.yIteration = 0;
            this.yIteration++;
        }

        this.curveX = this.#easeOutExpo(this.xIteration, this.curveX, this.targetX - this.curveX, 100);
        this.curveY = this.#easeOutExpo(this.yIteration, this.curveY, viewport.y - this.curveY, 100);

        // generating the new curve
        let newCurve =
            "M60," +
            viewport.height +
            "H0V0h60v" +
            (this.curveY - anchorDistance) +
            "c0," +
            curliness +
            "," +
            this.curveX +
            "," +
            curliness +
            "," +
            this.curveX +
            "," +
            anchorDistance +
            "S60," +
            this.curveY +
            ",60," +
            (this.curveY + anchorDistance * 2) +
            "V" +
            viewport.height +
            "z";

        // Changing the width of the blob object
        this.blob.style.width = `${this.curveX + 60}px`;
        // Changing the blob-path(SVG) data to the new curve
        this.blobPath.setAttribute("d", newCurve);
        // Changing the position of the toggle button
        this.toggle.style.transform = "translate(" + this.curveX + "px, " + this.curveY + "px)";
        // Changing the position of the toggle cover
        //toggleCover.style.transform = 'translateY(' + (curveY - 60) + 'px)';

        this.svgAnimation = requestAnimationFrame(() => this.renderSVG());
    }

    registerSVGAnimation() {
        registerMouseTracker();
        setTimeout(() => this.renderSVG());
    }

    unregisterSVGAnimation() {
        unregisterMouseTracker();
        setTimeout(() => cancelAnimationFrame(this.svgAnimation), 2000);
    }

    expandSidebar(state = true) {
        if (state) {
            this.lqs.classList.add("expanded");
            this.menuExpanded = true;
        } else {
            if (this.autoHide) {
                // asynchronously setting it to false for avoid the sidebar keeps expanded forever
                setTimeout(() => {
                    this.menuExpanded = false;
                    this.lqs.classList.remove("expanded");
                }, 1000);
            }
        }
    }
}

// let the browser know that <lq-side-menu> is served by the new class
customElements.define("lq-side-menu", LiquidSideMenu);