<!DOCTYPE html>
<html>
<body>
<!                               NAVIGATION                                    >
  <div class="vertical-nav bg-white" id="sidebar">
      <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center"><img src="{$BASE_URL}images/logo/feup.png"  width="150" >
        </div>
      </div>

      <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a href="{$BASE_URL}pages/index.php" class="nav-link text-dark font-italic menu-highlight {if $menu=="1"} menu-highlight-active {/if}">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    My Account
                </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight {if $menu=="2"} menu-highlight-active {/if}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
            Data
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_my_data.php">My Data</a>
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_data.php">Full List</a>
          </div>
        </li>
        {*if 1*}
        {if $acc_type=="client"}
        <li class="nav-item">
          <a href="{$BASE_URL}pages/menu_vehicles.php" class="nav-link text-dark font-italic menu-highlight {if $menu=="3"} menu-highlight-active {/if}">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-submarine.png"></i>
                    Vehicles
                </a>
        </li>
        {*elseif 0*}
        {elseif $acc_type="provider"}
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight {if $menu=="3"} menu-highlight-active {/if}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-submarine.png"></i>
            Vehicles
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_my_vehicles.php">My Vehicles</a>
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_vehicles.php">Full List</a>
          </div>
        </li>
        {/if}
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight {if $menu=="4"} menu-highlight-active {/if}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
            Requests
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_requests_history.php">History</a>
            <a class="dropdown-in" href="{$BASE_URL}pages/menu_requests_progress.php">In Progess</a>
            <!--<div class="dropdown-divider"></div>-->
            <a class="dropdown-in" href="{$BASE_URL}pages/map.php">New</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="{$BASE_URL}pages/menu_notifications.php" class="nav-link text-dark font-italic menu-highlight {if $menu=="5"} menu-highlight-active {/if}">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-notification.png"></i>
                    Notifications
                </a>
        </li>
      </ul>
    </div>

</body>
</html>
