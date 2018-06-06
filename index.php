

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mywebapp - Let Love Lead!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body id = "body">
  <h3>Mywebapp - Let love lead!</h3>

<?php
  
  require_once('connectvars.php');

 
    echo '&#10084; <a href="login.php">Log In</a><br />';
    echo '&#10084; <a href="signup.php">Sign Up</a>';
  

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 



  mysqli_close($dbc);
?>

</body> 
</html>
