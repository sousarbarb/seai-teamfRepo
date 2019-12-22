<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/vehicles.php' );

  // Display template refered to contacts
  $smarty->assign('PAGE', 'delete');
  $smarty->display('delete.tpl');
?>