var colors = {
  maingreengrass: "#3D8361",
  greengrass: "#4E833D",
  bluegress: "#A4C6D6",
  pastelbluegress: "#A4D6B4",
  DarkSeaGreengress: "#8DA858",
  Linengress: "#EEF2E6",
  Blackgress: "#050B08",
  CadetBluegress: "#3D8283",
  PaleGoldenRodgress: "#C6D6A4",
  NavajoWhitegress: "#D6CDA4",
  PowderBluegress: "#A4D6CD",
};
var texts = {
  description: `
  <p>
    Are you tired of spending hours cutting and maintaining your lawn?
    Do you want a beautiful and green garden without the upkeep that
    comes with a natural lawn? Then synthetic grass is the solution for
    you!
  </p>
  <p>
    Our high-quality synthetic grass is an aesthetic and practical
    alternative for any outdoor space. It is resistant to UV rays, which
    means it will remain green and lush throughout the year, regardless
    of the climate. Additionally, synthetic grass does not require
    watering, mowing, or fertilizers, making it an eco-friendly and
    low-maintenance option. Forget about spending time and money on
    garden maintenance and spend your time enjoying it with friends and
    family.
  </p>
  <p>
    Install synthetic grass and you will have a beautiful and green
    garden without worries!
  </p>
  `,
  galleryIntro: `
  <p>
    Pongo algo más.
  </p>
  `,
};
(() => {
  document.body.innerHTML += `
  <!-- Scripts -->
  <!-- Components -->
    <iframe id="navbar-iframe" class="d-none" onload="getElement('navbar')" src="./components/navbar.html" frameborder="0"></iframe>
    <iframe id="footer-iframe" class="d-none" onload="getElement('footer')" src="./components/footer.html" frameborder="0"></iframe>
    <iframe id="form-iframe" class="d-none" onload="getElement('form')" src="./components/form.html" frameborder="0"></iframe>
  `;
  for (let key in texts) {
    let docElement = document.getElementById(key + "-text-data");
    if (!!docElement && texts[key] !== '') {
      texts[key] = docElement.innerHTML;
      getText(key);
    }
  }
})();
function getElement(element) {
  let docElement = document.getElementById(element + "-container");
  if (!!docElement) {
    docElement.innerHTML = document
      .getElementById(element + "-iframe")
      .contentWindow.document.getElementById(element + "-component").innerHTML;
    doCssCreate();
  }
}

function getText(element) {
  let docElements = document.getElementsByClassName(
    element + "-text-container"
  );
  console.log(docElements);
  if (!!docElements && docElements[0] && !!texts[element.toString()]) {
    for (const docElement of docElements) {
      docElement.innerHTML = texts[element.toString()];
    }
    doCssCreate();
  }
}

function doCssCreate() {
  setTimeout(() => {
    cssCreate()
  }, 100);
}