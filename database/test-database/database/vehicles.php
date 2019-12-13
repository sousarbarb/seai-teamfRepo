<?php
  /*************************************** TABLE SENSOR **************************************/

  /*******************************************************************************************
   ***** editVehicleSensor 
   *******************************************************************************************
   * Edit a sensor associated with a certain vehicle.
   *******************************************************************************************
   * sensor_type : sensor type;
   * sensor_name : name of the sensor;
   * consumption : sensor consumption;
   * vel_sampling: sensor sampling velocity;
   * active      : parameter that defines if a sensor is active or not;
   * comments    : possible comments to add related with a certain sensor.
   *******************************************************************************************/
  function editVehicleSensor($id, $sensor_type, $sensor_name, $consumption, $vel_sampling, $active, 
                             $comments) {
    global $conn;
    $stmt = $conn->prepare("UPDATE sensor
                            SET    sensor_type = ?,
                                   sensor_name = ?;
                                   consumption = ?;
                                   vel_sampling = ?;
                                   active = ?;
                                   comments = ?
                            WHERE  id = ?
                            RETURNING *");
    $stmt->execute( array($sensor_type, $sensor_name, $consumption, $vel_sampling, $active, $comments, $id) );
    return $stmt->fetchAll();
  }

  /*********************************** TABLE COMMUNICATION ***********************************/

  /*******************************************************************************************
   ***** createCommunication 
   *******************************************************************************************
   * Creates a new type of communication.
   *******************************************************************************************
   * commun_type: communication type.
   *******************************************************************************************/
  function createCommunication($commun_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO communication(communication_type)
                            VALUES                   (                 ?)
                            RETURNING *");
    $stmt->execute( array($commun_type) );
    return $stmt->fetchAll();
  }

  /*******************************************************************************************
   ***** createVehicleCommunication 
   *******************************************************************************************
   * Associates a type of communication with a certain vehicle.
   *******************************************************************************************
   * vehicle_id : vehicle id;
   * commun_type: communication type.
   *******************************************************************************************/
  function createVehicleCommunication($vehicle_id, $commun_type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO vehicle_communication(vehicle_id, communication_id)
                            VALUES                           (         ?,                ?)
                            RETURNING *");
    $stmt->execute( array($vehicle_id, $commun_type) );
    return $stmt->fetchAll();
  }

  /*******************************************************************************************
   ***** deleteVehicleCommunication 
   *******************************************************************************************
   * Delete a certain type of communication from a certain vehicle.
   *******************************************************************************************
   * vehicle_id : vehicle id;
   * commun_type: communication type.
   *******************************************************************************************/
  function deleteVehicleCommunication($vehicle_id, $commun_type) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM vehicle_communication
                            WHERE  vehicle_id = ? AND
                                   communication_id = ?");
    $stmt->execute( array($vehicle_id, $commun_type) );
    return $stmt->fetchAll();
  }

  /*********************************** TABLE SPECIFICATION ***********************************/

  /*******************************************************************************************
   ***** createVehicleSpecification 
   *******************************************************************************************
   * Create a new specification for a certain vehicles.
   *******************************************************************************************
   * spec_type : type of specification;
   * value     : specification value;
   * comments  : possible comments to be added to the specific specification;
   * vehicle_id: vehicle id for the specific specification.
   *******************************************************************************************/
  function createVehicleSpecification($spec_type, $value, $comments, $vehicle_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO specification(specification_type, value, comments, vehicle_id)
                            VALUES                   (                 ?,     ?,        ?,          ?)
                            RETURNING *");
    $stmt->execute( array($spec_type, $value, $comments, $vehicle_id) );
    return $stmt->fetchAll();
  }

  /*******************************************************************************************
   ***** editVehicleSpecification 
   *******************************************************************************************
   * Edit a certain specification described by its id.
   *******************************************************************************************
   * id       : specification id to identity which specifition needs to be updated;
   * spec_type: specification type;
   * value    : specification value;
   * comments : possible comments to be associated to the desired specification.
   *******************************************************************************************/
  function editVehicleSpecification($id, $spec_type, $value, $comments) {
    global $conn;
    $stmt = $conn->prepare("UPDATE specification
                            SET    specification_type = ?,
                                   value              = ?,
                                   comments           = ?
                            WHERE  id = ?
                            RETURNING *");
    $stmt->execute( array($spec_type, $value, $comments, $id) );
    return $stmt->fetchAll();
  }

  /*******************************************************************************************
   ***** selectAllSpecifications 
   *******************************************************************************************
   * Select all specifications described in the respective table.
   *******************************************************************************************/
  function selectAllSpecifications() {
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM   specification");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /*******************************************************************************************
   ***** selectAllVehicleSpecifications 
   *******************************************************************************************
   * Select all the specifications associated with a certain vehicle.
   *******************************************************************************************
   * id_vehicle: vehicle id to search all the specifications associted with it.
   *******************************************************************************************/
  function selectAllVehicleSpecifications($id_vehicle) {
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM   specification
                            WHERE  vehicle_id = ?");
    $stmt->execute( array($id_vehicle) );
    return $stmt->fetchAll();
  }
?>