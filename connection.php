<?php
  define('db_hostname',"localhost");
  define('db_username',"root");
  define('db_password',"root");
  define('db_dbname',"crisp");

  $conn = mysqli_connect(db_hostname, db_username, db_password, db_dbname);
  if (!$conn) {
    echo "Error: Could not connect to database! Try again later...";
  }
?>