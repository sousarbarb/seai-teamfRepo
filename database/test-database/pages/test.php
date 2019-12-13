<?php
  // Includes of files need to connect with database, functions libraries, etc.
  include_once ('../config/init.php');
  include_once ($BASE_DIR . 'database/users.php');
  include_once ($BASE_DIR . 'database/vehicles.php');

  // Link para exception codes in PostgreSQL:
  //    https://www.postgresql.org/docs/9.4/errcodes-appendix.html

  echo "<p>Querie print - to see it right do \'Right click + Inspect\' or \'Ctrl+Shift+I\' and see elements->body";
  echo "</br>     or see Page Source!!!</p>";
  
  //----> createVehicleSpecification:
  if( false ) {
    try {
      $query = createVehicleSpecification('velocity','302 m/s', NULL, 1);
      echo "<p><b>createVehicleSpecification:</b></p>";
      print_r($query);
      echo "<p></p>";
    } catch (PDOException $e) {
      if( $e->getCode() == 23503 ){
        echo "<p><b>ERROR:</b> Foreign key violation.<p>";
      }
      if( $e->getCode() == 23505 ){
        echo "<p><b>ERROR:</b> Duplicated key value violates an unique constraint.<p>";
      }
      if( $e->getCode() == 23514 ){
        echo "<p><b>ERROR:</b> Check violation.<p>";
      }
    }
  }

  //----> editVehicleSpecification:
  if( false ) {
    try {
      $query = editVehicleSpecification(14,'capacity','320 Ah', NULL);
      echo "<p><b>editVehicleSpecification:</b></p>";
      print_r($query);
      echo "<p></p>";
    } catch (PDOException $e) {
      if( $e->getCode() == 23503 ){
        echo "<p><b>ERROR:</b> Foreign key violation.<p>";
      }
      if( $e->getCode() == 23505 ){
        echo "<p><b>ERROR:</b> Duplicated key value violates an unique constraint.<p>";
      }
      if( $e->getCode() == 23514 ){
        echo "<p><b>ERROR:</b> Check violation.<p>";
      }
    }
  }

  //----> selectAllSpecifications:
  if( true ) {
    try {
      $query = selectAllSpecifications();
      echo "<p><b>selectAllSpecifications:</b></p>";
      print_r($query);
      echo "<p></p>";
    } catch (PDOException $e) {
      if( $e->getCode() == 23503 ){
        echo "<p><b>ERROR:</b> Foreign key violation.<p>";
      }
      if( $e->getCode() == 23505 ){
        echo "<p><b>ERROR:</b> Duplicated key value violates an unique constraint.<p>";
      }
      if( $e->getCode() == 23514 ){
        echo "<p><b>ERROR:</b> Check violation.<p>";
      }
    }
  }

  //----> selectAllVehicleSpecifications:
  if( true ) {
    try {
      $query = selectAllVehicleSpecifications(1);
      echo "<p><b>selectAllVehicleSpecifications:</b></p>";
      print_r($query);
      echo "<p></p>";
    } catch (PDOException $e) {
      if( $e->getCode() == 23503 ){
        echo "<p><b>ERROR:</b> Foreign key violation.<p>";
      }
      if( $e->getCode() == 23505 ){
        echo "<p><b>ERROR:</b> Duplicated key value violates an unique constraint.<p>";
      }
      if( $e->getCode() == 23514 ){
        echo "<p><b>ERROR:</b> Check violation.<p>";
      }
    }
  }

  //----> createCommunication:
  if( true ) {
    try {
      $query = createCommunication('Wi-FI');
      echo "<p><b>createCommunication:</b></p>";
      print_r($query);
      echo "<p></p>";
    } catch (PDOException $e) {
      if( $e->getCode() == 23503 ){
        echo "<p><b>ERROR:</b> Foreign key violation.<p>";
      }
      if( $e->getCode() == 23505 ){
        echo "<p><b>ERROR:</b> Duplicated key value violates an unique constraint.<p>";
      }
      if( $e->getCode() == 23514 ){
        echo "<p><b>ERROR:</b> Check violation.<p>";
      }
    }
  }


?>