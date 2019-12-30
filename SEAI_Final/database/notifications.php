<?php
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