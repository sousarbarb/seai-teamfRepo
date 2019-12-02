<!DOCTYPE html>
<html>
<body>
<!                               NAVIGATION                                    >
  <div class="vertical-nav bg-white" id="sidebar">
      <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center"><img src="https://paginas.fe.up.pt/~cesg/images/logo_feup.png"  width="150" >
        </div>
      </div>

      <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    My Account
                </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-submarine.png"></i>
                    Vehicles
                </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
            Requests
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">History</a>
            <a class="dropdown-item" href="#">In Progess</a>
            <!--<div class="dropdown-divider"></div>-->
            <a class="dropdown-item" href="#">New</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-notification.png"></i>
                    Notifications
                </a>
        </li>
      </ul>
    </div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-toggle");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
</body>
</html>
