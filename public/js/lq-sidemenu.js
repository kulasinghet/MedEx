const lqsCollapsedWidth = 52;
const lqsZIndex = 100; // z-index of the LQS: Max z index of the page
const lqsBackground = `#2536b8`;
const lqsStyle = `
.sidebar {
  position: fixed;
  height: 100%;
  background-color: ${lqsBackground};
  width: 260px;
  transition: 1000ms all cubic-bezier(0.19, 1, 0.22, 1);
  transform: translateX(-100%);
  left: 52px;
  z-index: 100;
}
.sidebar.expanded {
  transform: translateX(0%);
  left: 0;
}
.sidebar .sidebar-toggle {
  position: absolute;
  width: 20px;
  height: 20px;
  right: 16px;
  z-index: 102;
  margin-top: -10px;
  font-size: 20px;
  text-align: center;
}
.sidebar .sidebar-toggle svg path {
  fill: #fff;
}
.sidebar .sidebar-blob {
    position: absolute;
    height: 100%;
    top: 0;
    right: 60px;
    z-index: ${lqsZIndex - 1};
    transform: translateX(100%);
}
.sidebar .sidebar-inner {
  width: 100%;
  height: 100%;
  position: relative;
  z-index: 100;
  background: linear-gradient(180deg, #D8EEF8 0%, #B5C3DE 100%);
}
.sidebar .sidebar-inner .sidebar-context {
  width: 208px;
  height: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.sidebar .sidebar-inner .sidebar-context::after {
  content: "";
  height: 100%;
  background: rgba(133, 146, 200, 0.2509803922);
  width: 1px;
  position: absolute;
  top: 0;
  right: 0;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-context-top {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  width: 208px;
  flex-direction: column;
  align-items: center;
  gap: 0.8rem;
  padding-top: 5px;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-context-top .sidebar-logo {
  display: inline-block;
  overflow: hidden;
  padding: 5px;
  width: 200px;
  flex: 0 0 auto;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-context-top .sidebar-logo img {
  width: 100%;
  vertical-align: center;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-list {
  width: 100%;
  padding: 20px 14px;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-list .sidebar-list-itm {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 13px 18px;
  gap: 10px;
  margin-bottom: 10px;
  transition: all 300ms ease-out;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-list .sidebar-list-itm:link, .sidebar .sidebar-inner .sidebar-context .sidebar-list .sidebar-list-itm:visited {
  text-decoration: none;
  color: #343A40;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-list .sidebar-list-itm:hover {
  padding-left: 30px;
  background: rgba(2, 160, 252, 0.5);
  box-shadow: 1px 4px 4px rgba(97, 193, 249, 0.28);
  border-radius: 10px;
}
.sidebar .sidebar-inner .sidebar-context .sidebar-list .sidebar-list-itm:active {
  padding-left: 30px;
  background: rgba(52, 58, 64, 0.5);
  box-shadow: inset 1px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 10px;
  color: #F8F9FA;
}
`;

const lqsTemplate = `
<!-- external stylesheet -->
<link href="../scss/main.css" rel="stylesheet"/>

<div class="sidebar-context-top">
    <div class="sidebar-logo">
        <a href="#">
            <img alt="MedEx Logo with name" src="../res/logo/logo-text_light.svg"/>
        </a>
    </div>
    <div class="sidebar-handlers">
        <input id="sidebar-autohide" type="checkbox" class="switch" data-action="sidebar-auto-hide">
        <label for="sidebar-autohide">Auto Hide</label>
    </div>
</div>
`;

const lqsToggle  = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
</svg>
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

        // for debugging
        console.log(`width: ${viewport.width}, height: ${viewport.height}`);
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
        return [];
    }

    connectedCallback() {
        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)

        // creating shadow root
        this.isDevMode = this.getAttribute('dev-mode') === "" || false;
        this.attachShadow({mode: this.isDevMode ? "open" : "closed"});

        // rendering the style
        const style = document.createElement('style');
        style.innerHTML = lqsStyle;
        this.shadowRoot.appendChild(style);

        // rendering the component
        this.renderElement();

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
            if (e.target.dataset.action === "sidebar-auto-hide" && e.target.checked) {
                this.expandSidebar();
                this.registerSVGAnimation();
                this.autoHide = true;
                console.log("Liquid Sidebar: auto hide enabled");
            } else if (e.target.dataset.action === "sidebar-auto-hide") {
                this.expandSidebar();
                this.unregisterSVGAnimation();
                this.autoHide = false;
                console.log("Liquid Sidebar: auto hide disabled");
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

        // creating menu toggle
        this.toggle = document.createElement("div");
        this.toggle.setAttribute("class", "sidebar-toggle");
        this.toggle.innerHTML = lqsToggle;
        this.toggle.style.position = "absolute";
        this.toggle.style.width = "20px";
        this.toggle.style.height = "20px";
        this.toggle.style.right = "16px";
        this.toggle.style.zIndex = `${lqsZIndex + 2}`;
        this.toggle.style.marginTop = "-10px";
        this.toggle.style.fontSize = "20px";
        this.toggle.style.textAlign = "center";
        this.toggle.style.color = "fff";
        this.lqs.appendChild(this.toggle);

        // creating sidebar blob SVG
        this.blob = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        this.blob.setAttribute("class", "sidebar-blob");
        this.blobPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        this.blobPath.setAttribute("d", "M60,500H0V0h60c0,0,20,172,20,250S60,900,60,500z");
        this.blobPath.style.height = "100%";
        this.blobPath.style.fill = lqsBackground;

        // appending blob elements to the sidebar
        this.blob.appendChild(this.blobPath);
        this.lqs.appendChild(this.blob);

        // sidebar inner
        this.lqsInner = document.createElement("div");
        this.lqsInner.setAttribute("class", "sidebar-inner");
        this.lqs.appendChild(this.lqsInner);

        // sidebar context
        this.lqsContext = document.createElement("div");
        this.lqsContext.setAttribute("class", "sidebar-context");
        this.lqsContextTmp = document.createElement("template");
        this.lqsContextTmp.innerHTML = lqsTemplate;
        this.lqsContext.appendChild(this.lqsContextTmp.content.cloneNode(true));
        this.lqsAutoHideCheck = this.lqsContext.querySelector("#sidebar-autohide");
        if (this.autoHide) {
            this.lqsAutoHideCheck.setAttribute("checked", true);
        }
        setTimeout(() => {
            this.lqsContext.innerHTML += this.innerHTML;
        });
        this.lqsInner.appendChild(this.lqsContext);

        // appending the sidebar to the shadow root
        this.shadowRoot.appendChild(this.lqs);

        // rendering the animation
        if (this.autoHide) {
            this.registerSVGAnimation();
        }
        // setTimeout(() => this.unregisterSVGAnimation(), 10000);
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