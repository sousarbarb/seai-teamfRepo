<?php
  /****************************************************************************************************
   ***** CREATEVEHICLE
   ****************************************************************************************************
   * Creates a new vehicle in the database. Also, this function does not creates new sensors, 
   * protocols, etc..., but only adds to the database the basic information about the vehicle.
   * 
   * PARAMETERS:
   * name            : UNIQUE KEY that defines the vehicle name;
   * localization    : string that defines where the vehicle is;
   * comments        : text with comments described by the service_provuder that owns the vehicle;
   * public          : boolean variable to define if the vehicle can be visualized by other users or 
   *                   not;
   * service_provider: username of service provider. In the service_provider table, this variable can 
   *                   be used to search which id is associated with the service_provider.
   * 
   * OBSERVATION: it is not required to return vehicle id in the querie because vehicle_name is also
   * an unique key (and candidate to primary key), so in the following queries you only need to pass
   * vehicle_name to the functions.
   * 
   * SUCCESS RETURNS CONSIDERED:
   *  1: updating an existing vehicle but inactive was completed successfully;
   *  2: insertion of a new vehicle was completed successfully.
   * 
   * ERRORS CONSIDERED:
   * -1: service_provider isn't approved by an administrator;
   * -2: service_provider isn't registed in the platform;
   * -3: the vehicle already exists but service_provider does not own that vehicle;
   * -4: the vehicle is owned by service_provider but it is an active vehicle (so can not be created 
   *     with the same name);
   * -5: updating an existing vehicle but inactive was not completed successfully;
   * -6: insertion was not completed successfully.
   ****************************************************************************************************/
  function createVehicle($name, $localization, $comments, $public, $service_provider) {
    // Global variable: connection to the database
    global $conn;

    // Find service provider's id
    $stm = $conn->prepare("
      SELECT *
      FROM   service_provider
      WHERE  user_id = ?
    ");
    $stm->execute(array($service_provider));
    
    // Error checking for service_provider search
    $results = $stm->fetch();
    if( $results != FALSE ){  // service_provider is registed in the platform
      // If service_provider is approved by an administrator...
      if( $results['approval'] == TRUE )
        $service_provider_id = $results['id'];
      // Else...
      else
        return -1;
    }
    else
      return -2;
    
    // Check if this name of vehicle already exists
    $stm = $conn->prepare("
      SELECT *
      FROM   vehicle
      WHERE  vehicle_name = ?
    ");
    $stm->execute(array($name));

    // Error checking for vehicle's name search
    $results = $stm->fetch();
    if( $results != FALSE ){  // vehicle with the same name as $name already exists
      // If service_provider doesn't owns that vehicle...
      if( $results['service_provider_id'] != $service_provider_id )
        return -3;
      // Else if the vehicle is owned by service_provider but already exists and is active...
      else if( $results['active'] == TRUE )
        return -4;
      // Else, edits the inactive vehicle and this passes to ACTIVE AND NOT APPROVAL
      else{
        $stm = $conn->prepare("
          UPDATE vehicle
          SET    localization = ?,
                 comments     = ?,
                 public       = ?,
                 approval     = ?,
                 active       = ?
          WHERE  vehicle_name = ?
        ");
        try {
          $stm->execute(array($localization,
                              $comments,
                              $public? 'TRUE':'FALSE',
                              'FALSE',
                              'TRUE',
                              $name));
        } catch(PDOexception $e) {
          // Updating was not completed successfully
          return -5;
        }
        // SUCCESS UPDATE: updating an existing vehicle but inactive was successfully
        return 1;
      }
    }

    // Creates a new vehicle
    $stm = $conn->prepare("
      INSERT INTO vehicle (
        vehicle_name,
        localization,
        comments,
        public,
        approval,
        active,
        service_provider_id
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? )
    ");
    try {
      $stm->execute(array($name,
                          $localization,
                          $comments,
                          $public? 'TRUE':'FALSE',
                          'FALSE',
                          'TRUE',
                          $service_provider_id));
    } catch (PDOException $e) {
      // Insertion was not completed successfully
      return -6;
    }

    // SUCCESS INSERTION: inserting a new vehicle was completed successfully
    return 2;
  }

  /****************************************************************************************************
   ***** CREATENEWSPECIFICATIONASSOCIATEDWITHVEHICLE
   ****************************************************************************************************
   * Creates a new specification and associates with a specific vehicle, specified by it's name. The
   * combination between VALUE, SPECIFICATION_TYPE and VEHICLE_ID forms an unique key in the 
   * specification table.
   * 
   * PARAMETERS:
   * type        : string that defines the type of vehicle specification to create;
   * value_min   : string that defines the minimum value of specification;
   * value_max   : string that defines the maximum value of specification;
   * comments    : text with comments described for this specification by the service_provuder that 
   *               owns the vehicle;
   * vehicle_name: UNIQUE KEY that defines the vehicle name.
   * 
   * SUCCESS RETURNS CONSIDERED:
   *  1: updating an existing specification but inactive was completed successfully;
   *  2: insertion of a new specification was completed successfully.
   * 
   * ERRORS CONSIDERED:
   * -1: the vehicle specified by vehicle_name isn't an active vehicle;
   * -2: the vehicle specified by vehicle_name isn't defined in the database;
   * -3: specification type already exists and is active;
   * -4: updating an existing specification but inactive was not completed successfully;
   * -5: inserting was not completed successfully.
   ****************************************************************************************************/
  function createNewSpecificationAssociatedWithVehicle($type, $value_min, $value_max, $comments, $vehicle_name) {
    // Global variable: connection to the database
    global $conn;

    // Find vehicle's id
    $stm = $conn->prepare("
      SELECT *
      FROM   vehicle
      WHERE  vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));

    // Error checking for vehicle search
    $results = $stm->fetch();
    if( $results != FALSE ){  // vehicle is defined in the platform
      // If vehicle is active... 
      // (does not need to be approved because, in the meantime, the service_provider can define new specifications)
      if( $results['active'] == TRUE )
        $vehicle_id = $results['id'];
      // Else...
      else
        return -1;
    }
    else
      return -2;

    // Check if this type of specification already exists associated to vehicle
    $stm = $conn->prepare("
      SELECT *
      FROM   specification
      WHERE  specification_type = ? AND
             vehicle_id         = ?
    ");
    $stm->execute(array($type, $vehicle_id));

    // Error checking for vehicle type specification's search
    $results = $stm->fetch();
    if( $results != FALSE ){  // specification type associathe with vehicle_name exists
      // If specification is active...
      if( $results['active'] == TRUE )
        return -3;
      // Else, edits the inactive specification and passes to ACTIVE
      else{
        $specification_id = $results['id'];
        $stm = $conn->prepare("
          UPDATE specification
          SET    value_min = ?,
                 value_max = ?,
                 active    = ?,
                 comments  = ?
          WHERE  specification_id = ? AND
                 vehicle_id       = ?
        ");
        try {
          $stm->execute(array($value_min,
                              $value_max,
                              'TRUE',
                              $comments,
                              $specification_id,
                              $vehicle_id

          ));
        } catch(PDOexception $e) {
          // Updating was not completed successfully
          return -4;
        }
        // SUCCESS UPDATE: updating an existing specification but inactive was successfully
        return 1;
      }
    }

    // Creates a new specification
    $stm = $conn->prepare("
      INSERT INTO specification (
        specification_type,
        value_min,
        value_max,
        active,
        vehicle_id,
        comments
      )
      VALUES ( ? , ? , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($type,
                          $value_min,
                          $value_max,
                          'TRUE',
                          $vehicle_id,
                          $comments
      ));
    } catch(PDOexception $e) {
      // Insertion was not completed successfully
      return -5;
    }

    // SUCCESS INSERTION: inserting a new specification was completed successfully
    return 2;
  }

  /****************************************************************************************************
   ***** CREATENEWSENSORASSOCIATEDWITHVEHICLE
   ****************************************************************************************************
   * This function creates a new sensor and associates with a certain vehicle. If the sensor
   * is already created, only in the case where this is inactive that it's info is updated and the
   * sensors returns to an active state.
   * 
   * PARAMETERS:
   * name        : string containing the sensor's name;
   * type        : string that defines the type of sensor to create;
   * comments    : text with comments described for this sensor by the service_provider that owns the
   *               vehicle;
   * vehicle_name: UNIQUE KEY that defines the vehicle name.
   * 
   * SUCCESS RETURNS CONSIDERED:
   *  1: updating an existing sensor but inactive was completed successfully;
   *  2: insertion of a new sensor was completed successfully.
   * 
   * ERRORS CONSIDERED:
   * -1: the vehicle specified by vehicle_name isn't an active vehicle;
   * -2: the vehicle specified by vehicle_name isn't defined in the database;
   * -3: sensor already exists and is active;
   * -4: updating an existing sensor but inactive was not completed successfully;
   * -5: inserting was not completed successfully.
   ****************************************************************************************************/
  function createNewSensorAssociatedWithVehicle($name, $type, $comments, $vehicle_name) {
    // Global variable: connection to the database
    global $conn;

    // Find vehicle's id
    $stm = $conn->prepare("
      SELECT *
      FROM   vehicle
      WHERE  vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));

    // Error checking for vehicle search
    $results = $stm->fetch();
    if( $results != FALSE ){  // vehicle is defined in the platform
      // If vehicle is active... 
      // (does not need to be approved because, in the meantime, the service_provider can define new specifications)
      if( $results['active'] == TRUE )
        $vehicle_id = $results['id'];
      // Else...
      else
        return -1;
    }
    else
      return -2;
    
    // Check if this sensor already exists associated to vehicle
    $stm = $conn->prepare("
      SELECT *
      FROM   sensor
      WHERE  sensor_type = ? AND
             sensor_name = ? AND
             vehicle_id  = ?
    ");
    $stm->execute(array($type, $name, $vehicle_id));

    // Error checking for vehicle sensor search
    $results = $stm->fetch();
    if( $results != FALSE ){  // sensor associted with vehicle_name exists
      // If sensor is active...
      if( $results['active'] == TRUE )
        return -3;
      // Else, edits the inactive specification and passes to ACTIVE
      else{
        $sensor_id = $results['id'];
        $stm = $conn->prepare("
          UPDATE sensor
          SET    comments = ?,
                 active   = ?
          WHERE  sensor_type = ? AND
                 sensor_name  = ? AND
                 vehicle_id   = ?
        ");
        try {
          $stm->execute(array($comments,
                              'TRUE',
                              $type,
                              $name,
                              $vehicle_id
          ));
        } catch(PDOexception $e) {
          // Updating was not completed successfully
          return -4;
        }
        // SUCCESS UPDATE: updating an existing sensor but inactive was successfully
        return 1;
      }
    }

    // Creates a new sensor
    $stm = $conn->prepare("
      INSERT INTO sensor (
        sensor_type,
        sensor_name,
        comments,
        active,
        vehicle_id
      )
      VALUES ( ? , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($type,
                          $name,
                          $comments,
                          'TRUE',
                          $vehicle_id
      ));
    } catch(PDOexception $e) {
      // Insertion was not completed successfully
      return -5;
    }

    // SUCCESS INSERTION: inserting a new specification was completed successfully
    return 2;
  }

  /****************************************************************************************************
   ***** CREATENEWRESOLUTIONASSOCIATEDWITHSENSOR
   ****************************************************************************************************
   * This function creates a new resolution and associates with a certain sensor. If the resolution
   * is already created, only in the case where this is inactive that it's info is updated and the
   * resolution returns to an active state.
   * 
   * PARAMETERS:
   * value       : resolution value;
   * vel_sampling: nominal velocity that the vehicle can run at X resolution;
   * consumption : impact of the sensor running at X resolution in the vehicle battery;
   * swath       : float that defines the range of the sensor;
   * cost        : cost in terms of MONETARY UNIT / TIME UNIT of running the sensor at X resolution;
   * comments    : text with comments described for this resolution by the service_provider that owns
   *               the vehicle;
   * sensor_id   : UNIQUE KEY that defines which sensor is to be associated with the specified 
   *               resolution.
   * 
   * SUCCESS RETURNS CONSIDERED:
   *  1: updating an existing resolution but inactive was completed successfully;
   *  2: insertion of a new resolution was completed successfully.
   * 
   * ERRORS CONSIDERED:
   * -1: resolution already exists and is active;
   * -2: updating an existing resolution but inactive was not completed successfully;
   * -3: inserting was not completed successfully.
   ****************************************************************************************************/
  function createNewResolutionAssociatedWithSensor($value, $vel_sampling, $consumption, $swath, $cost, $comments, $sensor_id) {
    // Global variable: connection to the database
    global $conn;

    // Checks if this value of resolution already exists associated to sensor
    $stm = $conn->prepare("
      SELECT *
      FROM   resolution
      WHERE  value     = ? AND
             sensor_id = ?
    ");
    $stm->execute(array($value, $sensor_id));

    // Error checking for resolution search
    $results = $stm->fetch();
    if( $results != FALSE ){  // resolution associted with sensor exists
      // If resolution is active...
      if( $results['active'] == TRUE )
        return -1;
      // Else, edits the inactive resolution and passes to ACTIVE
      else{
        $resolution_id = $results['id'];
        $stm = $conn->prepare("
          UPDATE resolution
          SET    vel_sampling = ?,
                 consumption  = ?,
                 swath        = ?,
                 active       = ?,
                 cost         = ?,
                 comments     = ?
          WHERE  id = ?
        ");
        try {
          $stm->execute(array($vel_sampling, 
                              $consumption, 
                              $swath, 
                              'TRUE', 
                              $cost, 
                              $comments,
                              $resolution_id
          ));
        } catch(PDOexception $e) {
          // Updating was not completed successfully
          return -2;
        }
        // SUCCESS UPDATE: updating an existing resolution but inactive was successfully
        return 1;
      }
    }

    // Creates new resolution
    $stm = $conn->prepare("
      INSERT INTO resolution (
        value,
        vel_sampling,
        consumption,
        swath,
        active,
        sensor_id,
        cost,
        comments
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? , ? )
    ");
    try {
      $stm->execute(array($value,
                          $vel_sampling,
                          $consumption,
                          floatval($swath),
                          'TRUE',
                          $sensor_id,
                          floatval($cost),
                          $comments
      ));
    } catch(PDOexception $e) {
      // Insertion was not completed successfully
      return -3;
    }

    // SUCCESS INSERTION: inserting a new specification was completed successfully
    return 2;
  }

  /****************************************************************************************************
   ***** CREATENEWRESOLUTIONASSOCIATEDWITHSENSOR
   ****************************************************************************************************
   * Creates a new communication or already links with existing ones.
   * 
   * PARAMETERS:
   * type        : communication type;
   * vehicle_name: UNIQUE KEY that defines the vehicle name.
   * 
   * SUCCESS RETURNS CONSIDERED:
   *  1: communication already exists and is already linked with the vehicle;
   *  2: inserting new communication was successfully created.
   * 
   * ERRORS CONSIDERED:
   * -1: the vehicle specified by vehicle_name isn't an active vehicle;
   * -2: the vehicle specified by vehicle_name isn't defined in the database;
   ****************************************************************************************************/
  function createNewCommunicationAssociatedWithVehicle($type, $vehicle_name) {
    // Global variable: connection to the database
    global $conn;

    // Find vehicle's id
    $stm = $conn->prepare("
      SELECT *
      FROM   vehicle
      WHERE  vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));

    // Error checking for vehicle search
    $results = $stm->fetch();
    if( $results != FALSE ){  // vehicle is defined in the platform
      // If vehicle is active... 
      // (does not need to be approved because, in the meantime, the service_provider can define new specifications)
      if( $results['active'] == TRUE )
        $vehicle_id = $results['id'];
      // Else...
      else
        return -1;
    }
    else
      return -2;
    
    // Checks if this type of communication already exists
    $stm = $conn->prepare("
      SELECT *
      FROM   communication
      WHERE  communication_type = ?
    ");
    $stm->execute(array($type));
    $results = $stm->fetch();
    if( $results != FALSE ){  // type of communication is defined in the platform
      $communication_id     = $results['id'];
      $communication_exists = TRUE;
      // Checks if this type of communication is already linked with the vehicle
      $stm = $conn->prepare("
        SELECT *
        FROM   vehicle_communication
        WHERE  vehicle_id       = ? AND
               communication_id = ?
      ");
      $stm->execute(array($vehicle_id, $communication_id));
      $results = $stm->fetch();
      if( $results != FALSE ){
        $commun_linked_vehicle = TRUE;
        return 1;
      }
      else {
        $commun_linked_vehicle = FALSE;
      }
    }
    else{
      $communication_exists  = FALSE;
      $commun_linked_vehicle = FALSE;
    }
    
    // Creation of communication
    if( !$communication_exists ){
      $stm = $conn->prepare("
        INSERT INTO communication (
          communication_type
        )
        VALUES ( ? )
        RETURNING id
      ");
      $stm->execute(array($type));
      $results = $stm->fetch();
      $new_communication_id = $results['id'];
    }
    if( !$commun_linked_vehicle ){
      $stm = $conn->prepare("
        INSERT INTO vehicle_communication (
          vehicle_id,
          communication_id
        )
        VALUES ( ? , ? )
      ");
      $stm->execute(array($vehicle_id,
                          $communication_exists? $communication_id:$new_communication_id
      ));
    }

    // SUCCESS INSERTION: inserting a new communication was completed successfully
    return 2;
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESSERVICEPROVIDERS
   ****************************************************************************************************
   * Get all service providers registed in the platform.
   ****************************************************************************************************/
  function getAllVehiclesServiceProviders() {
    // Global variable: connection to the database
    global $conn;

    // Get all service providers
    $stm = $conn->prepare("
      SELECT user_id
      FROM   service_provider
    ");
    $stm->execute();

    // Return all service providers
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESNAMES
   ****************************************************************************************************
   * Get all vehicle names in order to facilitate new sensor, specification, etc, creations.
   ****************************************************************************************************/
  function getAllVehiclesNames() {
    // Global variable: connection to the database
    global $conn;

    // Get all vehicles names
    $stm = $conn->prepare("
      SELECT vehicle_name
      FROM   vehicle
    ");
    $stm->execute();

    // Return all vehicles names
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESSENSORSIDS
   ****************************************************************************************************
   * Get all sensors ids defined in the database.
   ****************************************************************************************************/
  function getAllVehiclesSensorsIds() {
    // Global variable: connection to the database
    global $conn;

    // Get all sensors ids
    $stm = $conn->prepare("
      SELECT id
      FROM   sensor
    ");
    $stm->execute();

    // Return all sensors ids
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESSPECIFICATIONSTYPES
   ****************************************************************************************************
   * Get all distinct specification types of all vehicles. This is useful for creating a new 
   * specification to show up options with already defined specification types.
   * Returns all distinct specification types.
   ****************************************************************************************************/
  function getAllVehiclesSpecificationsTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get distinct specification types
    $stm = $conn->prepare("
      SELECT DISTINCT specification_type
      FROM            specification
    ");
    $stm->execute();

    // Return all distinct specification type
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESSENSORSTYPES
   ****************************************************************************************************
   * Get all vehicle names in order to facilitate new sensor, specification, etc, creations.
   ****************************************************************************************************/
  function getAllVehiclesSensorsTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get distinct sensors types
    $stm = $conn->prepare("
      SELECT DISTINCT sensor_type
      FROM            sensor
    ");
    $stm->execute();

    // Return all distinct sensors types
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLVEHICLESCOMMUNICATIONSTYPES
   ****************************************************************************************************
   * Get all vehicle names in order to facilitate new sensor, specification, etc, creations.
   ****************************************************************************************************/
  function getAllVehiclesCommunicationsTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get distinct communication types
    $stm = $conn->prepare("
      SELECT DISTINCT communication_type
      FROM            communication
    ");
    $stm->execute();

    // Return all distinct communication types
    return $stm->fetchAll();
  }





  function getAllApprovalServiceProviders() {
    // Global variable: connection to the database
    global $conn;

    // Get all approved service providers identified by its names
    $stm = $conn->prepare("
      SELECT entity_name
      FROM   service_provider
      WHERE  approval='TRUE'
    ");
    $stm->execute();

    // Return all service providers
    return $stm->fetchAll();
  }

  function getAllActiveDistinctSpecifications() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active specifications
    $stm = $conn->prepare("
      SELECT DISTINCT specification_type
      FROM            specification
      WHERE           active='TRUE'
    ");
    $stm->execute();

    // Return all specifications
    return $stm->fetchAll();
  }

  function getAllCommunicationTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get all communications
    $stm = $conn->prepare("
      SELECT communication_type
      FROM   communication
    ");
    $stm->execute();

    // Return all communications
    return $stm->fetchAll();
  }

  function getAllActiveDistinctSensorTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active sensors
    $stm = $conn->prepare("
      SELECT DISTINCT sensor_type
      FROM            sensor
      WHERE           active='TRUE'
    ");
    $stm->execute();

    // Return all sensors
    return $stm->fetchAll();
  }

  function getAllActiveDistinctResolutionValues() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active resolution values
    $stm = $conn->prepare("
      SELECT DISTINCT value
      FROM            resolution
      WHERE           active='TRUE'
    ");
    $stm->execute();

    // Return all resolution values
    return $stm->fetchAll();
  }
?>