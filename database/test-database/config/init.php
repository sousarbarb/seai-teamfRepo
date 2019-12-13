<?php
  // Cookies and session configuration
  session_set_cookie_params(3600, '/seai/test-database/');
  session_start();              // directory in the web server (localhost/seai/test-database/)

  // BASE DIRECTORIES - to not conflit with the different directories necessary to the website
  $BASE_DIR = 'C:\xampp\htdocs\seai\test-database/';
  $BASE_URL = 'http://localhost/seai/test-database/';

  // Include SMARTY library - necessary to compile the templates made
  include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');

  // Database connection. The new user was created using the following commands:
  //    seai@swarmesh:~$ sudo -u postgres psql
  //    ...
  //    postgres=# CREATE USER sousa WITH ENCRYPTED PASSWORD 'sousa';
  //    postgres=# DROP USER sousa;
  //    ...
  //    postgres=# GRANT CONNECT ON DATABASE seai TO sousa;
  //    postgres=# GRANT USAGE ON SCHEMA public TO sousa;
  //    postgres=# GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO username;
  //    postgres=# GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO sousa;
  //    postgres=# GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO sousa;
  //    postgres=# GRANT ALL PRIVILEGES ON DATABASE seai TO sousa;
  //    ...
  //    postgres=# ALTER USER sousa CREATEDB;
  //    ...
  //    postgres=# ALTER USER sousa WITH SUPERUSER;
  //    postgres=# ALTER USER sousa WITH NOSUPERUSER;
  $conn = new PDO('pgsql:host=128.199.59.162;dbname=seai', 'sousa', 'sousa');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Enables by default the associative fetch mode from queries
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       // Enables the exception handling mechanism

  // Start Smarty
  $smarty = new Smarty;
  $smarty->template_dir = $BASE_DIR . 'templates/';
  $smarty->compile_dir  = $BASE_DIR . 'templates_c/';

  // Assign new variables in Smarty
  $smarty->assign('BASE_DIR', $BASE_DIR);
  $smarty->assign('BASE_URL', $BASE_URL);
?>