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
(() => {
  document.body.innerHTML += `
  <!-- Scripts -->
  <!-- Components -->
    <iframe id="navbar-iframe" class="d-none" onload="getElement('navbar')" src="./components/navbar.html" frameborder="0"></iframe>
    <iframe id="footer-iframe" class="d-none" onload="getElement('footer')" src="./components/footer.html" frameborder="0"></iframe>
  `;
})();
function getElement(element) {
  document.getElementById(element + "-container").innerHTML = document
    .getElementById(element + "-iframe")
    .contentWindow.document.getElementById(element + "-component").innerHTML;
  cssCreate();
}
