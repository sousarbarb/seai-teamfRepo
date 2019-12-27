<?php
  /****************************************************************************************************
   ***** NOTIFYPROVIDERVEHICLEAPPROVAL
   ****************************************************************************************************
   * This function notifies the vehicle proprietary (a specific service provider defined by 
   * $povider_username) that the vehicle was approved by the administration.
   * 
   * PROCEDURE:
   *  1: call editVehicleApproval($id, 'TRUE') to approve a specific vehicle by an administrator
   *     (only admin privileges can do this, of course);
   *  2: call notifyProviderVehicleApproval($provider_username, $vehicle_name) to notify the service
   *     provider about the administration approval of its specific vehicle.
   * 
   * RETURNS:
   *  0: success in creating the new notification;
   * -1: insuccess in this operation execution.
   * 
   * NOTE: keep attention to the input arguments and user the following functions if necessary:
   * - getServiceProviderUsername (entity_name -> provider_username)
   * - 
   ****************************************************************************************************/
  function notifyProviderVehicleApproval($provider_username, $vehicle_name){
    // Global variable: connection to the database
    global $conn;

    // Notification text
    $information = "$vehicle_name approved by the administration";

    // Send to specific service provider the notification about a specific vehicle administrator approval
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? )
    ");
    try{
      $stm->execute(array($information,
                          'FALSE',
                          $provider_username
      ));
    } catch (PDOexception $e) {
      // Error creating the new notification
      return -1;
    }

    // Success creating the new notification
    return 0;
  }

  /****************************************************************************************************
   ***** NOTIFYPROVIDERNEWPOSSIBLEREQUESTTOAPPLY
   ****************************************************************************************************
   * Notifies a service provider of an new request that can apply to.
   * Remember that this function does not execute the validation algorithm to the new request that 
   * are created by service clients.
   * 
   * PROCEDURE:
   *  1: creation of a new request by a specific service client;
   *  2: execute the validation / association algorithm for all service providers. Select the valid
   *     ones to apply to the request;
   *  3: for each service provider, call notifyProviderNewPossibleRequestToApply($provider_username, 
   *     $request_id).
   * 
   * RETURNS:
   *  0: success in creating the new notification;
   * -1: insuccess in this operation execution.
   ****************************************************************************************************/
  function notifyProviderNewPossibleRequestToApply($provider_username, $request_id){
    // Global variable: connection to the database
    global $conn;

    // Notification text
    $information = "New request ($request_id) available to apply";

    // Sends the notification for the service provider of a new valid request to apply
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id, request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($information,
                          'FALSE',
                          $provider_username,
                          $request_id
      ));
    } catch (PDOexception $e) {
      // Error creating the new notification
      return -1;
    }

    // Success creating the new notification
    return 0;
  }

  /****************************************************************************************************
   ***** NOTIFYPROVIDERNEWPOSSIBLEREQUESTTOAPPLY
   ****************************************************************************************************
   * Notify the service client of a change in the mission status. This mission is related to a 
   * specific request made by the service client.
   * Remember that this notification meants to only be sent in case of new missions, i.e., for 
   * requests made by a service client to obtain new data.
   * 
   * PROCEDURE:
   *  1: alter mission status;
   *  2: call notifyClientNewMissionStatus($client_username, $mission_id, $mission_status).
   * 
   * RETURNS:
   *  0: success in creating the new notification;
   * -1: mission_id is not valid (the request for new data was not founded);
   * -2: insuccess in this operation execution.
   * 
   * NOTE: take attention to input arguments. Use the following functions if needed:
   * - PUT HERE MISSION ID 
   * - getServiceClientId;
   * - getServiceClientName;
   * - getServiceProviderUsername.
   ****************************************************************************************************/
  function notifyClientNewMissionStatus($client_username, $request_id, $mission_id, $mission_status){
    // Global variable: connection to the database
    global $conn;
/*
    // Get request id
    $stm = $conn->prepare("
      SELECT  request.id,
              request.client_id
      FROM    request
      WHERE   request.sensor_type        IS NOT NULL  AND
              request.resolution_type    IS NOT NULL  AND
              request_mission.request_id = request.id AND
              request_mission.mission_id = ?
    ");
    $stm->execute(array($mission_id));
    $result = $stm->fetchAll();
    if( count($result) != 1 ){
      return -1;
    }
    $request_id = $result['id'];*/

    // Creates new notification
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id, mission_id, request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($information,
                          'FALSE',
                          $client_username,
                          $mission_id,
                          $request_id
      ));
    } catch (PDOexception $e) {
      // Error creating the new notification
      return -2;
    }

    // Success creating the new notification
    return 0;
  }

  /****************************************************************************************************
   ***** UPDATENOTIFICATIONACKNOWLOEDGE
   ****************************************************************************************************
   * Updates the notification status if the user already seen the notification.
   * Returns TRUE or FALSE (boolean condition) if the update operation was completed succefully or 
   * not.
   * The notification id can be obtained by the querie that gets all unacknoledged notifications.
   ****************************************************************************************************/
  function updateNotificationAcknowledge($id){
    // Global variable: connection to the database
    global $conn;

    // Update Notification Acknowledge
    $stm = $conn->prepare("
      UPDATE  notification
      SET     acknowledged = ?
      WHERE   id = ?
    ");
    try{
      $stm->execute(array('TRUE', $id));
    } catch(PDOexception $e) {
      return FALSE;
    }

    // Returns true or false if the update was not successful
    return ( $stm->rowCount() > 0 );
  }

  /****************************************************************************************************
   ***** GETUNACKNOWLEDGEDNOTIFICATIONSSPECIFICUSER
   ****************************************************************************************************
   * Get all notifications that aren't acknowledge for a specific user, defined by $username.
   * These notifications are ordered by most recent ones.
   ****************************************************************************************************/
  function getUnacknowledgedNotificationsSpecificUser($username) {
    // Global variable: connection to the database
    global $conn;

    // Get all unacknowledge notifications for the specific username
    $stm = $conn->prepare("
      SELECT  id           AS notification_id        ,
              date         AS notification_date      ,
              information  AS notification_info      ,
              acknowledged AS notification_ack       ,
              mission_id   AS notification_mission_id,
              request_id   AS notification_request_id
      FROM  notification
      WHERE acknowledged = 'FALSE' AND
            user_id      = ?
      ORDER BY date DESC
    ");
    $stm->execute(array($username));

    // Returns all results
    return $stm->fetchAll();
  }
?>