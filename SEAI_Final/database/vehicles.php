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
      if( $results['approval'] == TRUE ){
        $service_provider_id = $results['id'];
        $service_provider_name = $results['entity_name'];
      }
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

        // Notifies administrators of new vehicle creation
        notifyAdminNewVehicle($service_provider_name, $service_provider, $name);

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

    // Notifies administrators of new vehicle creation
    notifyAdminNewVehicle($service_provider_name, $service_provider, $name);

    // SUCCESS INSERTION: inserting a new vehicle was completed successfully
    return 2;
  }
  function notifyAdminNewVehicle($provider_entityname, $provider_username, $vehicle_name){   // !!!!! NOTIFICATION !!!!!
    // Global variable: connection to the database
    global $conn;

    // Gets all platform administrators
    $stm = $conn->prepare("
      SELECT  users.username
      FROM    users
      INNER JOIN admin
        ON  admin.user_id = users.username
      WHERE   users.status = 'Active'
    ");
    try{
      $stm->execute();
    } catch(PDOexception $e) {
      return -1;                  // Error get all admins
    }
    $results = $stm->fetchAll();
    if($results == FALSE){
      return 0;                   // There aren't any administrators defined in the platform.
    }

    // Notifies each admin to validate a new vehicle
    $notification_info = "New vehicle created ($vehicle_name) by $provider_entityname ($provider_username). Waiting administration approval.";
    foreach ($results as $result) {
      $stm = $conn->prepare("
        INSERT INTO notification( date , information , acknowledged , user_id, vehicle_id )
        VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
      ");
      try{
        $stm->execute(array($notification_info,         // inserts the string notification_info as the notification description
                            'FALSE',                    // by default, the administrator $result['username'] didn't see the new notification
                            $result['username'],        // sets FK for the specific administrator $result['username']
                            getVehicleId($vehicle_name) // sets FK for vehicle created
        ));
      } catch(PDOexception $e) {
        return -1;                // Error inserting new notification
      }
    }

    // After notifying all administrators, return 0
    return 0;
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
          WHERE  id         = ? AND
                 vehicle_id = ?
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

  /****************************************************************************************************
   ***** GETALLAPPROVALSERVICEPROVIDERS
   ****************************************************************************************************
   * Get all entity name of service providers that are approved by an administrator. Also, it orders
   * alphabeticaly by entity_name.
   ****************************************************************************************************/
  function getAllApprovalServiceProviders() {
    // Global variable: connection to the database
    global $conn;

    // Get all approved service providers identified by its names
    $stm = $conn->prepare("
      SELECT entity_name
      FROM   service_provider
      WHERE  approval='TRUE'
      ORDER BY entity_name ASC
    ");
    $stm->execute();

    // Return all service providers
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLACTIVEDISTINCTSPECIFICATIONS
   ****************************************************************************************************
   * Get all distinct vehicles specifications that are active at the moment. Also, it orders
   * alphabeticaly by specification_type.
   ****************************************************************************************************/
  function getAllActiveDistinctSpecifications() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active specifications
    $stm = $conn->prepare("
      SELECT DISTINCT specification_type
      FROM            specification
      WHERE           active='TRUE'
      ORDER BY specification_type ASC
    ");
    $stm->execute();

    // Return all specifications
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLCOMMUNICATIONTYPES
   ****************************************************************************************************
   * Get all communications defined in the database. Also, it orders alphabeticaly by 
   * communication_type.
   ****************************************************************************************************/
  function getAllCommunicationTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get all communications
    $stm = $conn->prepare("
      SELECT communication_type
      FROM   communication
      ORDER BY communication_type ASC
    ");
    $stm->execute();

    // Return all communications
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLACTIVEDISTINCTSENSORTYPES
   ****************************************************************************************************
   * Get all distinct sensor types and active declared in the database. Also, it orders alphabeticaly 
   * by sensor_type.
   ****************************************************************************************************/
  function getAllActiveDistinctSensorTypes() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active sensors
    $stm = $conn->prepare("
      SELECT DISTINCT sensor_type
      FROM            sensor
      WHERE           active='TRUE'
      ORDER BY sensor_type ASC
    ");
    $stm->execute();

    // Return all sensors
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLACTIVEDISTINCTRESOLUTIONVALUES
   ****************************************************************************************************
   * Get all distinct resolution values and active declared in the database. Also, it orders 
   * alphabeticaly by value.
   ****************************************************************************************************/
  function getAllActiveDistinctResolutionValues() {
    // Global variable: connection to the database
    global $conn;

    // Get all distinct and active resolution values
    $stm = $conn->prepare("
      SELECT DISTINCT value
      FROM            resolution
      WHERE           active='TRUE'
      ORDER BY value ASC
    ");
    $stm->execute();

    // Return all resolution values
    return $stm->fetchAll();
  }





  /****************************************************************************************************
   ***** SEARCHVEHICLESWITHFILTERS
   ****************************************************************************************************
   * QUERIES FOR DEBUGGING:
   * --> processing sensors and resolutions selection:
WITH vehicle_sensor_resolution AS (
  SELECT vehicle.id          AS vehicle_id       ,
        vehicle.vehicle_name AS vehicle_name     ,
        vehicle.active       AS vehicle_active   ,
        vehicle.approval     AS vehicle_approval ,
        vehicle.public       AS vehicle_public   ,
        sensor.id            AS sensor_id        ,
        sensor.sensor_type   AS sensor_type      ,
        sensor.active        AS sensor_active    ,
        resolution.id        AS resolution_id    ,
        resolution.value     AS resolution_value ,
        resolution.active    AS resolution_active
  FROM  vehicle, sensor, resolution
  WHERE vehicle.id        = sensor.vehicle_id    AND
        sensor.id         = resolution.sensor_id AND
        sensor.active     = 'TRUE'               AND
        resolution.active = 'TRUE'                    -- put here other restrictions
  ORDER BY vehicle_name    ASC,
          sensor_type      ASC,
          resolution_value ASC
) SELECT * FROM vehicle_sensor_resolution;        

   * 
   * --> processing communications:
WITH vehicle_sensor_resolution AS (
  SELECT vehicle.id                       AS vehicle_id        ,
         vehicle.vehicle_name             AS vehicle_name      ,
         vehicle.active                   AS vehicle_active    ,
         vehicle.approval                 AS vehicle_approval  ,
         vehicle.public                   AS vehicle_public    ,
         communication.id                 AS communication_id  ,
         communication.communication_type AS communication_type
  FROM   vehicle, vehicle_communication, communication
  WHERE  vehicle_communication.vehicle_id       = vehicle.id       AND
         vehicle_communication.communication_id = communication.id      -- put here other restrictions
  ORDER BY vehicle_name       ASC,
           communication_type ASC
)
SELECT * FROM vehicle_sensor_resolution;

   * --> processing specifications types:
WITH vehicle_sensor_resolution AS (
  SELECT vehicle.id                       AS vehicle_id          ,
         vehicle.vehicle_name             AS vehicle_name        ,
         vehicle.active                   AS vehicle_active      ,
         vehicle.approval                 AS vehicle_approval    ,
         vehicle.public                   AS vehicle_public      ,
         specification.id                 AS specification_id    ,
         specification.specification_type AS specification_type  ,
         specification.active             AS specification_active
  FROM   vehicle, specification
  WHERE  specification.vehicle_id = vehicle.id AND
         specification.active     = 'TRUE'
  ORDER BY vehicle_name       ASC,
           specification_type ASC
)
SELECT * FROM vehicle_sensor_resolution;
   ****************************************************************************************************/
  function searchVehiclesWithFilters($VEHICLE_ACTIVE, $VEHICLE_APPROVAL, $VEHICLE_PUBLIC, 
                                    $service_providers_selected, $specifications_selected, $communications_selected, $sensors_selected, $resolutions_selected) {
    // Global variable: connection to the database
    global $conn;
    
    // --------------------------------------------------------------------------------
    // PROCESSING FILTERS
    $sql_prepare = [];
    $sql = "
      WITH vehicle_sensor_resolution_filter AS (
        SELECT vehicle.id          AS vehicle_id       ,
              vehicle.vehicle_name AS vehicle_name     ,
              vehicle.active       AS vehicle_active   ,
              vehicle.approval     AS vehicle_approval ,
              vehicle.public       AS vehicle_public   ,
              sensor.id            AS sensor_id        ,
              sensor.sensor_type   AS sensor_type      ,
              sensor.active        AS sensor_active    ,
              resolution.id        AS resolution_id    ,
              resolution.value     AS resolution_value ,
              resolution.active    AS resolution_active
        FROM  vehicle, sensor, resolution
        WHERE vehicle.id        = sensor.vehicle_id    AND
              sensor.id         = resolution.sensor_id AND
              sensor.active     = 'TRUE'               AND
              resolution.active = 'TRUE'               
    ";
    
    // Sensors Types filtering
    if(!empty($sensors_selected)){
      $sql .= " AND (";
      foreach($sensors_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " sensor.sensor_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }

    // Resolutions Values filtering
    if(!empty($resolutions_selected)){
      $sql .= " AND (";
      foreach($resolutions_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " resolution.value = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }

    // Communication Types filtering
    $sql .= "
      ORDER BY vehicle_name    ASC,
              sensor_type      ASC,
              resolution_value ASC
      ) , 
      vehicle_communication_filter AS (
        SELECT vehicle.id                      AS vehicle_id        ,
              vehicle.vehicle_name             AS vehicle_name      ,
              vehicle.active                   AS vehicle_active    ,
              vehicle.approval                 AS vehicle_approval  ,
              vehicle.public                   AS vehicle_public    ,
              communication.id                 AS communication_id  ,
              communication.communication_type AS communication_type
        FROM  vehicle, vehicle_communication, communication
        WHERE vehicle_communication.vehicle_id       = vehicle.id       AND
              vehicle_communication.communication_id = communication.id    ";
    
    if(!empty($communications_selected)){
      $sql .= " AND (";
      foreach($communications_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " communication.communication_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }

    // Specifications filtering
    $sql .= "
        ORDER BY vehicle_name      ASC,
                communication_type ASC
      ) , 
      vehicle_specification_filter AS (
        SELECT vehicle.id                      AS vehicle_id          ,
              vehicle.vehicle_name             AS vehicle_name        ,
              vehicle.active                   AS vehicle_active      ,
              vehicle.approval                 AS vehicle_approval    ,
              vehicle.public                   AS vehicle_public      ,
              specification.id                 AS specification_id    ,
              specification.specification_type AS specification_type  ,
              specification.active             AS specification_active
        FROM  vehicle, specification
        WHERE specification.vehicle_id = vehicle.id AND
              specification.active     = 'TRUE' 
    ";
    
    if(!empty($specifications_selected)){
      $sql .= " AND (";
      foreach($specifications_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " specification.specification_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }
    $sql .= "
      ORDER BY vehicle_name      ASC,
              specification_type ASC
    )
    ";

    // --------------------------------------------------------------------------------
    // INTERSECTING TABLES
    // Information to obtain
    $sql .= "
      SELECT DISTINCT
        service_provider.id          AS provider_id        ,
        service_provider.entity_name AS provider_entityname,
        service_provider.user_id     AS provider_username  ,
        users.e_mail                 AS provider_email     ,
        service_provider.official_representative AS provider_repres_name ,
        service_provider.mail_representative     AS provider_repres_email,
        users.status                 AS provider_status  ,
        service_provider.approval    AS provider_approval,
        vehicle.id           AS vehicle_id          ,
        vehicle.vehicle_name AS vehicle_name        ,
        vehicle.localization AS vehicle_localization,
        vehicle.active       AS vehicle_active      ,
        vehicle.approval     AS vehicle_approval    ,
        vehicle.public       AS vehicle_public  
      FROM users, service_provider, vehicle
    ";
    // Intersecting tables
    if(!empty($sensors_selected) || !empty($resolutions_selected)){
      $sql .= "
        INNER JOIN vehicle_sensor_resolution_filter
          ON vehicle_sensor_resolution_filter.vehicle_id = vehicle.id
      ";
    }
    if(!empty($communications_selected)){
      $sql .= "
        INNER JOIN vehicle_communication_filter
          ON vehicle_communication_filter.vehicle_id     = vehicle.id
      ";
    }
    if(!empty($specifications_selected)){
      $sql .= "
        INNER JOIN vehicle_specification_filter
          ON vehicle_specification_filter.vehicle_id     = vehicle.id
      ";
    }

    // --------------------------------------------------------------------------------
    // OTHER RESTRICTIONS (service_providers, vehicles active, public, etc...)
    $sql .= "
      WHERE
        service_provider.user_id = users.username              AND
        service_provider.id      = vehicle.service_provider_id    
    ";

    // Process Service Providers
    if(!empty($service_providers_selected)){
      $sql .= " AND (";
      foreach($service_providers_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " service_provider.entity_name = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }

    // Restrictions on vehicles state
    if(isset($VEHICLE_ACTIVE)){
      // --> DEBUG
      // echo '<p>VEHICLE_ACTIVE SET</p>';
      $sql .= " AND ( vehicle.active = ? ) ";
      array_push( $sql_prepare , $VEHICLE_ACTIVE? 'TRUE':'FALSE' );
    }
    if(isset($VEHICLE_APPROVAL)){
      // --> DEBUG
      // echo '<p>VEHICLE_APPROVAL SET</p>';
      $sql .= " AND ( vehicle.approval = ? ) ";
      array_push( $sql_prepare , $VEHICLE_APPROVAL? 'TRUE':'FALSE' );
    }
    if(isset($VEHICLE_PUBLIC)){
      // --> DEBUG
      // echo '<p>VEHICLE_PUBLIC SET</p>';
      $sql .= " AND ( vehicle.public = ? ) ";
      array_push( $sql_prepare , $VEHICLE_PUBLIC? 'TRUE':'FALSE' );
    }
    
    // --------------------------------------------------------------------------------
    // EXECUTING QUERIE
    $stm = $conn->prepare($sql);
    $stm->execute($sql_prepare);

    // Return search results
    return $stm->fetchAll();
  }



/****************************************************************************************************
 ***** GETVEHICLEGENERALINFORMATION
 ****************************************************************************************************/
  function getVehicleGeneralInformation($vehicle_name){
    // Global variable: connection to the database
    global $conn;

    // Get all informations abou the vehicle stored in database
    $stm = $conn->prepare("
      SELECT  id                  AS vehicle_id          ,
              vehicle_name        AS vehicle_name        ,
              service_provider_id AS provider_id         ,
              localization        AS vehicle_localization,
              comments            AS vehicle_comments    ,
              active              AS vehicle_active      ,
              approval            AS vehicle_approval    ,
              public              AS vehicle_public
      FROM    vehicle
      WHERE   vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));

    // Return row with vehicle information
    return $stm->fetch();
  }
  function getVehicleActiveGeneralInformation($vehicle_name){
    // Global variable: connection to the database
    global $conn;

    // Get all informations abou the vehicle stored in database
    $stm = $conn->prepare("
      SELECT  service_provider.entity_name AS provider_entity_name,
              service_provider.user_id     AS provider_username   ,
              vehicle.service_provider_id  AS provider_id         ,
              vehicle.id                   AS vehicle_id          ,
              vehicle.vehicle_name         AS vehicle_name        ,
              vehicle.localization         AS vehicle_localization,
              vehicle.comments             AS vehicle_comments    ,
              vehicle.active               AS vehicle_active      ,
              vehicle.approval             AS vehicle_approval    ,
              vehicle.public               AS vehicle_public
      FROM    vehicle
      INNER JOIN service_provider
        ON service_provider.id = vehicle.service_provider_id
      WHERE   vehicle.vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));

    // Return row with vehicle information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ***** GETVEHICLESPECIFICATIONS
   ****************************************************************************************************/
  function getVehicleSpecifications($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all specifications of an vehicle
    $stm = $conn->prepare("
      SELECT  id                 AS spec_id      ,
              specification_type AS spec_type    ,
              value_min          AS spec_valuemin,
              value_max          AS spec_valuemax,
              active             AS spec_active  ,
              comments           AS spec_comments
      FROM    specification
      WHERE   vehicle_id = ?
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle specifications
    return $stm->fetchAll();
  }
  function getVehicleActiveSpecifications($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all specifications of an vehicle
    $stm = $conn->prepare("
      SELECT  id                 AS spec_id      ,
              specification_type AS spec_type    ,
              value_min          AS spec_valuemin,
              value_max          AS spec_valuemax,
              active             AS spec_active  ,
              comments           AS spec_comments
      FROM    specification
      WHERE   active     = 'TRUE' AND
              vehicle_id = ?
      ORDER BY  specification_type ASC
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle specifications
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETVEHICLECOMMUNICATIONS
   ****************************************************************************************************/
  function getVehicleCommunications($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all communications of an vehicle
    $stm = $conn->prepare("
      SELECT  communication.id                 AS communication_id  ,
              communication.communication_type AS communication_type
      FROM    communication, vehicle_communication
      WHERE   vehicle_communication.vehicle_id       = ?                AND
              vehicle_communication.communication_id = communication.id
      ORDER BY  communication.communication_type ASC
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle communications
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETVEHICLESENSORSANDRESOLUTIONS
   ****************************************************************************************************/
  function getVehicleSensorsAndResolutions($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all sensors and respective resolutions of a vehicle
    $stm = $conn->prepare("
      SELECT
        sensor.id          AS sensor_id      ,
        sensor.sensor_type AS sensor_type    ,
        sensor.sensor_name AS sensor_name    ,
        sensor.active      AS sensor_active  ,
        sensor.comments    AS sensor_comments,
        
        resolution.id           AS res_id         ,
        resolution.value        AS res_value      ,
        resolution.consumption  AS res_consumption,
        resolution.vel_sampling AS res_velocity   ,
        resolution.cost         AS res_cost       ,
        resolution.swath        AS res_swath      ,
        resolution.active       AS res_active     ,
        resolution.comments     AS res_comments
      FROM sensor
      FULL OUTER JOIN resolution
        ON resolution.sensor_id = sensor.id
      WHERE sensor.vehicle_id = ?
      ORDER BY sensor_type ASC,
               res_value   ASC
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle sensorial capabilities
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETVEHICLESENSORS
   ****************************************************************************************************/
  function getVehicleSensors($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all sensors and respective resolutions of a vehicle
    $stm = $conn->prepare("
      SELECT
        sensor.id          AS sensor_id      ,
        sensor.sensor_type AS sensor_type    ,
        sensor.sensor_name AS sensor_name    ,
        sensor.active      AS sensor_active  ,
        sensor.comments    AS sensor_comments
      FROM  sensor
      WHERE sensor.vehicle_id = ?
      ORDER BY  sensor.sensor_type ASC,
                sensor.sensor_name ASC
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle sensorial capabilities
    return $stm->fetchAll();
  }
  function getVehicleActiveSensors($vehicle_id){
    // Global variable: connection to the database
    global $conn;

    // Get all sensors and respective resolutions of a vehicle
    $stm = $conn->prepare("
      SELECT
        sensor.id          AS sensor_id      ,
        sensor.sensor_type AS sensor_type    ,
        sensor.sensor_name AS sensor_name    ,
        sensor.active      AS sensor_active  ,
        sensor.comments    AS sensor_comments
      FROM  sensor
      WHERE sensor.active     = 'TRUE' AND
            sensor.vehicle_id = ?
      ORDER BY  sensor.sensor_type ASC,
                sensor.sensor_name ASC
    ");
    $stm->execute(array($vehicle_id));

    // Return rows with vehicle sensorial capabilities
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETSENSORRESOLUTIONS
   ****************************************************************************************************/
  function getSensorResolutions($sensor_id){
    // Global variable: connection to the database
    global $conn;

    // Get all sensors and respective resolutions of a vehicle
    $stm = $conn->prepare("
      SELECT
        resolution.id           AS res_id         ,
        resolution.sensor_id    AS res_sensorid   ,
        resolution.value        AS res_value      ,
        resolution.consumption  AS res_consumption,
        resolution.vel_sampling AS res_velocity   ,
        resolution.cost         AS res_cost       ,
        resolution.swath        AS res_swath      ,
        resolution.active       AS res_active     ,
        resolution.comments     AS res_comments
      FROM  resolution
      WHERE resolution.sensor_id = ?
      ORDER BY  resolution.value ASC
    ");
    $stm->execute(array($sensor_id));

    // Return rows with vehicle sensorial capabilities
    return $stm->fetchAll();
  }
  function getSensorActiveResolutions($sensor_id){
    // Global variable: connection to the database
    global $conn;

    // Get all sensors and respective resolutions of a vehicle
    $stm = $conn->prepare("
      SELECT
        resolution.id           AS res_id         ,
        resolution.sensor_id    AS res_sensorid   ,
        resolution.value        AS res_value      ,
        resolution.consumption  AS res_consumption,
        resolution.vel_sampling AS res_velocity   ,
        resolution.cost         AS res_cost       ,
        resolution.swath        AS res_swath      ,
        resolution.active       AS res_active     ,
        resolution.comments     AS res_comments
      FROM  resolution
      WHERE resolution.active    = 'TRUE' AND
            resolution.sensor_id = ?
      ORDER BY  resolution.value ASC
    ");
    $stm->execute(array($sensor_id));

    // Return rows with vehicle sensorial capabilities
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** EDITVEHICLE
   ****************************************************************************************************/
  function editVehicle($id, $name, $localization, $comments, $public){
    // Global variable: connection to the database
    global $conn;

    // Updates vehicle information
    $stm = $conn->prepare("
        UPDATE vehicle
        SET    vehicle_name = ?,
               localization = ?,
               comments     = ?,
               public       = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($name, 
                          $localization, 
                          $comments, 
                          $public? 'TRUE':'FALSE', 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }

    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITVEHICLEAPPROVAL
   ****************************************************************************************************/
  function editVehicleApproval($id, $approval){
    // Global variable: connection to the database
    global $conn;

    // Updates vehicle approval
    $stm = $conn->prepare("
        UPDATE vehicle
        SET    approval = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($approval? 'TRUE':'FALSE', 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
        return -1;
    }

    // If approval it's TRUE, the service provider it's notified.
    if($approval)
      notifyProviderVehicleApproval( $id );
    
    // Updating was successful
    return 0;
  }
  function notifyProviderVehicleApproval($vehicle_id){                              // !!!!! NOTIFICATION !!!!!
    // Global variable: connection to the database
    global $conn;

    // Get service provider given a vehicle id
    $provider_username = getVehicleServiceProvider($vehicle_id);
    if( $provider_username )
      return -1;                // Error because vehicle_id invalid

    // Notification text
    $notification_info = "Vehicle $vehicle_name approved by the administration";

    // Send to specific service provider the notification about its new vehicle administrator approval
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id, vehicle_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($notification_info,         // inserts the string notification_info as the notification description
                          'FALSE',                    // by default, the administrator $result['username'] didn't see the new notification
                          $provider_username,         // sets FK for the specific administrator $result['username']
                          $vehicle_id                 // sets FK for vehicle created
      ));
    } catch(PDOexception $e) {
      return -1;                // Error inserting new notification
    }

    // Success creating the new notification
    return 0;
  }

  /****************************************************************************************************
   ***** DELETEALLVEHICLESSERVICEPROVIDER
   ****************************************************************************************************/
  function deleteAllVehiclesServiceProvider($username) {
    // Global variable: connection to the database
    global $conn;
    
    // Get all vehicles of a specific service provider
    $stm = $conn->prepare("
      SELECT vehicle.id                   AS vehicle_id     ,
             vehicle.vehicle_name         AS vehicle_name   ,
             service_provider.user_id     AS entity_username,
             service_provider.entity_name AS entity_name
      FROM   vehicle
      INNER JOIN service_provider
        ON  service_provider.id = vehicle.service_provider_id
      WHERE service_provider.user_id = ?
    ");
    $stm->execute(array($username));
    $vehicles = $stm->fetchAll();
    
    // Deactivate each vehicle from service_provider
    foreach($vehicles as $vehicle){
      editVehicleActive($vehicle['vehicle_id'], FALSE);
    }
  }

  /****************************************************************************************************
   ***** EDITVEHICLEACTIVE
   ****************************************************************************************************/
  function editVehicleActive($id, $active){
    // Global variable: connection to the database
    global $conn;

    // Updates vehicle active
    $stm = $conn->prepare("
        UPDATE vehicle
        SET    active = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($active? 'TRUE':'FALSE', 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // In case active = FALSE...
    if($active == FALSE){
      // If a vehicle is no longer active, loses the administrator approval
      editVehicleApproval($id, FALSE);

      // Searches all notifications related with vehicle
      $stm = $conn->prepare("
        SELECT  *
        FROM  notification
        WHERE vehicle_id = ?
      ");
      $stm->execute(array($id));
      $results = $stm->fetchAll();
      if( $results != FALSE ){
        foreach( $results as $result ){
          $stm = $conn->prepare("
            DELETE FROM notification
            WHERE id = ?
          ");
          $stm->execute(array($result['id']));
        }
      }
      
      // Search active sensors
      $stm = $conn->prepare("
        SELECT  *
        FROM    sensor
        WHERE   vehicle_id = ? AND
                active     = ?
      ");
      $stm->execute(array($id, 'TRUE'));
      $results = $stm->fetchAll();
      
      // Executes the deactivation for each sensor (and, recursing, each active resolution)
      foreach($results as $result) {
        editSensorActive($result['id'], FALSE);
      }

      // Search active specifications
      $stm = $conn->prepare("
        SELECT  *
        FROM    specification
        WHERE   vehicle_id = ? AND
                active     = ?
      ");
      $stm->execute(array($id, 'TRUE'));
      $results = $stm->fetchAll();
      
      // Executes the deactivation for each active specification
      foreach($results as $result) {
        editSpecificationActive($result['id'], FALSE);
      }
      
      // Delete all current communications protocols
      $stm = $conn->prepare("
        SELECT  *
        FROM    vehicle_communication
        WHERE   vehicle_id = ?
      ");
      $stm->execute(array($id));
      $results = $stm->fetchAll();
      
      // Executes the elimination for each existing protocol communication of the vehicle
      foreach($results as $result) {
        deleteVehicleCommunication($result['communication_id']);
      }
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITSPECIFICATION
   ****************************************************************************************************/
  function editSpecification($id, $value_min, $value_max, $comments){
    // Global variable: connection to the database
    global $conn;

    // Updates specification
    $stm = $conn->prepare("
        UPDATE specification
        SET    comments  = ?,
               value_min = ?,
               value_max = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($comments, 
                          $value_min, 
                          $value_max, 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITSPECIFICATIONACTIVE
   ****************************************************************************************************/
  function editSpecificationActive($id, $active){
    // Global variable: connection to the database
    global $conn;

    // Updates specification active
    $stm = $conn->prepare("
        UPDATE specification
        SET    active = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($active? 'TRUE':'FALSE', 
                          $id)); 
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITSENSOR
   ****************************************************************************************************/
  function editSensor($id, $name, $comments){
    // Global variable: connection to the database
    global $conn;

    // Updates sensor
    $stm = $conn->prepare("
        UPDATE sensor
        SET    sensor_name     = ?,
               comments = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($name, 
                          $comments, 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITSENSORACTIVE
   ****************************************************************************************************/
  function editSensorActive($id, $active){
    // Global variable: connection to the database
    global $conn;

    // Updates sensor active
    $stm = $conn->prepare("
        UPDATE sensor
        SET    active = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($active? 'TRUE':'FALSE', 
                          $id)); 
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // In case active = FALSE...
    if($active == FALSE){
      // Search active resolutions
      $stm = $conn->prepare("
        SELECT  *
        FROM    resolution
        WHERE   sensor_id = ? AND
                active    = ?
      ");
      $stm->execute(array($id, 'TRUE'));
      $results = $stm->fetchAll();
      
      // Executes the deactivation for each active resolution associated with sensor
      foreach($results as $result) {
        editResolutionActive($result['id'], FALSE);
      }        
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITRESOLUTION
   ****************************************************************************************************/
  function editResolution($id, $vel_sampling, $consumption, $swath, $cost, $comments){
    // Global variable: connection to the database
    global $conn;

    // Updates resolution
    $stm = $conn->prepare("
        UPDATE resolution
        SET    vel_sampling = ?,
               consumption  = ?,
               swath        = ?,
               cost         = ?,
               comments     = ?
        WHERE  id = ?");
    try{
      $stm->execute(array($vel_sampling, 
                          $consumption,
                          $swath, 
                          $cost, 
                          $comments, 
                          $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** EDITRESOLUTIONACTIVE
   ****************************************************************************************************/
  function editResolutionActive($id, $active){
    // Global variable: connection to the database
    global $conn;

    // Updates resolution active
    $stm = $conn->prepare("
        UPDATE resolution
        SET    active = ?
        WHERE  id = ?");
    try{$stm->execute(array($active? 'TRUE':'FALSE', 
                            $id));
    } catch(PDOexception $e) {
      // Updating was not completed successfully
      return -1;
    }
    
    // Updating was successful
    return 0;
  }

  /****************************************************************************************************
   ***** DELETEVEHICLECOMMUNICATION
   ****************************************************************************************************/
  function deleteVehicleCommunication($communication_id){
    // Global variable: connection to the database
    global $conn;

    // Deletes vehicle communication (assuming that exists)
    $stm = $conn->prepare("
      DELETE
      FROM  vehicle_communication
      WHERE communication_id = ?
    ");
    $stm->execute(array($communication_id));
  }

  /****************************************************************************************************
   ***** GETVEHICLEID
   ****************************************************************************************************/
  function getVehicleId($vehicle_name){
    // Global variable: connection to the database
    global $conn;
    
    // Get the vehicle id
    $stm = $conn->prepare("
      SELECT  id
      FROM    vehicle
      WHERE   vehicle_name = ?
    ");
    $stm->execute(array($vehicle_name));
    $result = $stm->fetch();

    // Returns vehicle id
    if($result != FALSE)
      return $result['id'];
    else
      return NULL;
  }

  /****************************************************************************************************
   ***** GETVEHICLENAME
   ****************************************************************************************************/
  function getVehicleName($vehicle_id){
    // Global variable: connection to the database
    global $conn;
    
    // Get the vehicle id
    $stm = $conn->prepare("
      SELECT  vehicle_name
      FROM    vehicle
      WHERE   id = ?
    ");
    $stm->execute(array($vehicle_id));
    $result = $stm->fetch();

    // Returns vehicle id
    if($result != FALSE)
      return $result['vehicle_name'];
    else
      return NULL;
  }

  /****************************************************************************************************
   ***** GETVEHICLESERVICEPROVIDER
   ****************************************************************************************************/
  function getVehicleServiceProvider($vehicle_id){
    // Global variable: connection to the database
    global $conn;
    
    // Get the service provider username
    $stm = $conn->prepare("
      SELECT  vehicle.id                   AS vehicle_id       ,
              vehicle.vehicle_name         AS vehicle_name     ,
              service_provider.user_id     AS provider_username,
              service_provider.entity_name AS provider_name
      FROM vehicle
      INNER JOIN service_provider
        ON service_provider.id = vehicle.service_provider_id
      WHERE vehicle.id = ?
    ");
    $stm->execute(array($vehicle_id));
    $result = $stm->fetch();

    // Returns service provider username
    if($result != FALSE)
      return $result['provider_username'];
    else
      return NULL;
  }
?>