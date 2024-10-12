document.getElementById('toggle-menu').addEventListener('click', function() {
  var sidebar = document.getElementById('sidebar');
  var content = document.getElementById('content');
  if (sidebar.style.left === '-150px') {
    sidebar.style.left = '0';
    content.style.marginLeft = '150px';
  } else {
    sidebar.style.left = '-150px';
    content.style.marginLeft = '20px';
  }
});

function toggleMenu() {
  var sidebar = document.getElementById("sidebar");
  if (sidebar.style.left === "0px") {
    sidebar.style.left = "-150px";
  } else {
    sidebar.style.left = "0px";
  }
}
