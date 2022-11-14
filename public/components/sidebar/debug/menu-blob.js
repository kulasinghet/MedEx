window.onload = () => {
  let height = window.innerHeight;
  let x = 0;
  let y = height / 2;
  let curveX = 10;
  let curveY = 0;
  let targetX = 0;
  let xIteration = 0;
  let yIteration = 0;
  let menuExpanded = false;

  const sidebar = document.getElementById("sidebar");
  // for debugging
  console.log(window.getComputedStyle(sidebar).backgroundColor);
  const blob = createSVGBlob();
  const blobPath = blob.children[0];
  const toggle = sidebar.querySelector("#sidebar-toggle");
  const toggleCover = createSVGCover();

  // Initialize the menu with the blob
  sidebar.appendChild(blob);
  sidebar.appendChild(toggleCover);

  window.addEventListener("mousemove", (e) => {
    x = e.pageX;
    y = e.pageY;

    // For Debugging purposes
    document.getElementById("text").innerHTML =
      "<p>X: " + x + " Y: " + y + "</p>";
  });

  // menu open-close mechanism
  document.querySelectorAll(".sidebar-inner").forEach((ham) => {
    ham.addEventListener("mousemove", (e) => {
      const target = e.currentTarget;
      // using this condition to prevent repeating
      if (!menuExpanded) {
        target.parentNode.classList.add("expanded");
        menuExpanded = true;
      }
    });

    ham.addEventListener("mouseleave", (e) => {
      const target = e.currentTarget;
      // using this condition to prevent repeating
      if (menuExpanded) {
        target.parentNode.classList.remove("expanded");
        menuExpanded = false;
      }
    });
  });

  toggle.addEventListener("mouseenter", (e) => {
    const target = e.currentTarget;
    // using this condition to prevent repeating
    if (!menuExpanded) {
      target.parentNode.classList.add("expanded");
      menuExpanded = true;
    }
  });

  function createSVGBlob() {
    // Creating SVG element
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute("class", ".sidebar-blob");
    svg.style.position = "absolute";
    svg.style.height = "100%";
    svg.style.top = "0";
    svg.style.right = "60px";
    svg.style.zIndex = "-1";
    svg.style.transform = "translateX(100%)";

    // Creating path element
    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    // path.setAttribute("class", ".sidebar-blob-path");
    path.setAttribute("d", "M60,500H0V0h60c0,0,20,172,20,250S60,900,60,500z");
    path.style.height = "100%";
    path.style.fill = window.getComputedStyle(sidebar).backgroundColor;

    // appending path element to svg
    svg.appendChild(path);
    return svg;
  }

  function createSVGCover() {
    // Creating SVG element
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute("viewBox", "0 0 60 120");
    svg.style.position = "absolute";
    svg.style.width = "60px";
    svg.style.height = "120px";
    svg.style.top = "0";
    svg.style.right = "0";
    svg.style.zIndex = "1";

    // Creating path element
    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute("d", "M60,0V120c0-12.09-13.43-21.89-30-21.89S0,88.3,0,76.21V43.79c0-12.09,13.43-21.9,30-21.9S60,12.09,60,0Z");
    path.style.fill = window.getComputedStyle(sidebar).backgroundColor;

    // appending path element to svg
    svg.appendChild(path);
    return svg;
  }

  function easeOutExpo(currentIteration, startValue, changeInValue, totalIterations) {
    return (changeInValue * (-Math.pow(2, (-10 * currentIteration) / totalIterations) + 1) + startValue);
  }

  function svgRender() {
    const hoverZone = 150;
    const expandAmount = 20;
    const anchorDistance = 200;
    const curliness = anchorDistance - 40;

    if (curveX > x - 1 && curveX < x + 1) {
      xIteration = 0;
    } else {
      if (menuExpanded) {
        targetX = 0;
      } else {

        xIteration = 0;
        if (x > hoverZone) {
          targetX = 0;
        } else {
          targetX = -(((60 + expandAmount) / 100) * (x - hoverZone));
        }
      }
      xIteration++;
    }

    if (curveY > y - 1 && curveY < y + 1) {
      yIteration = 0;
    } else {
      yIteration = 0;
      yIteration++;
    }

    curveX = easeOutExpo(xIteration, curveX, targetX - curveX, 100);
    curveY = easeOutExpo(yIteration, curveY, y - curveY, 100);

    // generating the new curve
    let newCurve =
      "M60," +
      height +
      "H0V0h60v" +
      (curveY - anchorDistance) +
      "c0," +
      curliness +
      "," +
      curveX +
      "," +
      curliness +
      "," +
      curveX +
      "," +
      anchorDistance +
      "S60," +
      curveY +
      ",60," +
      (curveY + anchorDistance * 2) +
      "V" +
      height +
      "z";

    // Changing the width of the blob object
    blob.style.width = curveX + 60;
    // Changing the blob-path(SVG) data to the new curve
    blobPath.setAttribute("d", newCurve);
    // Changing the position of the toggle button
    toggle.style.transform =
      "translate(" + curveX + "px, " + curveY + "px)";
    // Changing the position of the toggle cover
    toggleCover.style.transform = 'translateY(' + (curveY - 60) + 'px)';

    window.requestAnimationFrame(svgRender);
  }

  window.requestAnimationFrame(svgRender);
};
