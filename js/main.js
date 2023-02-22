function getBody() {
  document.body.innerHTML += `
  <!-- Components -->
    <iframe id="navbar-iframe" class="d-none" onload="getNavBar()" src="./components/navbar.html" frameborder="0"></iframe>
  `;
}
function getNavBar() {
  document.getElementById("navbar-Container").innerHTML = document.getElementById("navbar-iframe").contentWindow.document.getElementById("navbar-component").innerHTML;
  cssCreate();
}