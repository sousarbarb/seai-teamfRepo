<?php
  // Include database connection and database functions libraries
  include_once( '../config/init.php' );
  include_once( $BASE_DIR . 'database/users.php' );

  // Quick test on function editServiceProviderApproval
  // editServiceProviderApproval('Faculdade de Engenharia da Universidade do Porto', FALSE);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Test of Users Database Table</title>
  <meta charset='utf-8'>
  <style>
    form > h3 {
      margin-block-start: 0.5em;
      margin-block-end: 0.25em;
    }

    form > p {
      margin-block-start: 0.25em;
      margin-block-end: 0.125em;
    }

    #messages {
      width: 40em;
      margin: 0 auto;
    }

    #messages {
      width: 40em;
    }

    #messages div {
      padding: 1em;  
      margin-top: 1em;
      border-radius: 2em;
    }

    #messages .error {
      background-color: #F99;
      color: #333;
    }

    #messages .success {
      background-color: #9F9;
      color: #333;
    }

    #registration > article {
      display: inline-block;
      margin: 1em 2em;
    }

    #login > article {
      margin: 1em 2em;
    }

    #updatestatus > article {
      margin: 1em 2em;
    }
  </style>
</head>

<body>
  <section id="messages">
    <!-- Display error messages -->
    <?php if( isset($ERROR_MESSAGES) ) { ?>
      <?php foreach($ERROR_MESSAGES as $error) { ?>
        <div class="error"><?php echo $error; ?></div>
      <?php } ?>
    <?php } ?>

    <!-- Display successfull messages -->
    <?php if( isset($SUCCESS_MESSAGES) ) { ?>
      <?php foreach($SUCCESS_MESSAGES as $success) { ?>
        <div class="success"><?php echo $success; ?></div>
      <?php } ?>
    <?php } ?>
  </section>

  <section id="login">
    <article>
      <h2>Login</h2>
      <form action="<?php echo $BASE_URL; ?>actions/login.php" method="POST">
        <p>Username:</p>
        <input type="text" 
               name="login_username"
               value="<?php if(isset($FORM_VALUES['login_username'])) echo $FORM_VALUES['login_username']; ?>">
        <p>Password:</p>
        <input type="password" 
               name="login_password">
        
        </br></br>
        <input type="submit" value="Login">
      </form>
    </article>
  </section>

  <section id="registration">
    <article>
      <h2>Test Service Provider Registration</h2>
      <form action="<?php echo $BASE_URL; ?>actions/register_servprov.php" method="POST">
        <h3>Login Credentials</h3>
        <p>Username:</p>
        <input type="text" 
              name="service_username"
              value="<?php if(isset($FORM_VALUES['service_username'])) echo $FORM_VALUES['service_username']; ?>">
        <p>Password:</p>
        <input type="password" 
              name="service_password">

        <h3>Service Provider Entity</h3>
        <p>Name:</p>
        <input type="text" 
              name="entity_name"
              value="<?php if(isset($FORM_VALUES['entity_name'])) echo $FORM_VALUES['entity_name']; ?>">
        <p>E-mail:</p>
        <input type="email" 
              name="entity_email"
              value="<?php if(isset($FORM_VALUES['entity_email'])) echo $FORM_VALUES['entity_email']; ?>">
        <p>Address:</p>
        <input type="text" 
              name="entity_address"
              value="<?php if(isset($FORM_VALUES['entity_address'])) echo $FORM_VALUES['entity_address']; ?>">
        <p>Phone Number:</p>
        <input type="text" 
              name="entity_phone"
              value="<?php if(isset($FORM_VALUES['entity_phone'])) echo $FORM_VALUES['entity_phone']; ?>">
        <p>Logo Path (just to test):</p>
        <input type="text" 
              name="entity_logopath"
              value="<?php if(isset($FORM_VALUES['entity_logopath'])) echo $FORM_VALUES['entity_logopath']; ?>">


        <h3>Official Representative</h3>
        <p>Name:</p>
        <input type="text" 
              name="representative_name"
              value="<?php if(isset($FORM_VALUES['representative_name'])) echo $FORM_VALUES['representative_name']; ?>">
        <p>E-mail:</p>
        <input type="email" 
              name="representative_email"
              value="<?php if(isset($FORM_VALUES['representative_email'])) echo $FORM_VALUES['representative_email']; ?>">
        <p>Phone Number:</p>
        <input type="text" 
              name="representative_phone"
              value="<?php if(isset($FORM_VALUES['representative_phone'])) echo $FORM_VALUES['representative_phone']; ?>">
        
        </br></br>
        <input type="submit" value="Submit">
        <input type="reset"  value="Reset">
      </form>
    </article>

    <article>
      <h2>Test Service Client Registration</h2>
      <form action="<?php echo $BASE_URL; ?>actions/register_servclie.php" method="POST">
        <h3>Login Credentials</h3>
        <p>Username:</p>
        <input type="text"
              name="client_username"
              value="<?php if(isset($FORM_VALUES['client_username'])) echo $FORM_VALUES['client_username']; ?>">
        <p>Password:</p>
        <input type="password"
              name="client_password">

        <h3>Client Information</h3>
        <p>Name:</p>
        <input type="text" 
              name="client_name"
              value="<?php if(isset($FORM_VALUES['client_name'])) echo $FORM_VALUES['client_name']; ?>">
        <p>E-mail:</p>
        <input type="email" 
              name="client_email"
              value="<?php if(isset($FORM_VALUES['client_email'])) echo $FORM_VALUES['client_email']; ?>">
        <p>Address:</p>
        <input type="text" 
              name="client_address"
              value="<?php if(isset($FORM_VALUES['client_address'])) echo $FORM_VALUES['client_address']; ?>">
        <p>Phone Number:</p>
        <input type="text" 
              name="client_phone"
              value="<?php if(isset($FORM_VALUES['client_phone'])) echo $FORM_VALUES['client_phone']; ?>">
        
        </br></br>
        <input type="submit" value="Submit">
        <input type="reset"  value="Reset">
      </form>
    </article>
  </section>

  <section id="updatestatus">
    <article>
      <h2>Update status</h2>
      <form action="<?php echo $BASE_URL; ?>actions/update_user_status.php" method="POST">
        <p>Username:</p>
        <input type="text" 
               name="updatestatus_username"
               value="<?php if(isset($FORM_VALUES['updatestatus_username'])) echo $FORM_VALUES['updatestatus_username']; ?>">
        <p>Status:</p>
        <input type="text" 
               name="updatestatus_status">
        
        </br></br>
        <input type="submit" value="Update">
      </form>
    </article>
  </section>
</body>

</html>