<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>mywebapp - Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body id = "body">
  <h1>mywebapp - Sign Up</h1>

<?php
  
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
     
	 $confirmcode = rand();
	 
	 if (!empty($username) && !empty($username) && !empty($email) && !empty($email) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM web_user WHERE username = '$username'";
	  
      $data = mysqli_query($dbc, $query);
	  
	 if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 
     
      
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO web_user (username, password, join_date, email, confirmed, confirmcode) VALUES ('$username', SHA('$password1'), NOW(), '$email', '0', '$confirmcode')";
        mysqli_query($dbc, $query);
		
		 $message =
		 
		 "
		 Confirm your email
		 Click the link below to verify your account
		 
		 http;//localhost/myweb/emailconfirm.php?username=$username&confirmcode=$confirmcode
		 ";
		 
		 mail( $email,"Mywebapp confirm Email", $message,"From: mywebapp@gmail.com");

        // Confirm success with the user
        echo '<p class="correct">Your account has been made,<br/> please verify it by clicking the link that has been sent to your email. </p>';

        mysqli_close($dbc);
        exit();
      }
	  
	 
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
	}
	 else { 
        echo '<p class="error">Invalid email address.</p>'; 
      }
	} 
    else {
      echo '<p class="error">You must enter all of the sign-up data.</p>';
    }
	  
  }

  mysqli_close($dbc);
?>
  <div align = "center" id="mainform">
  <h3>Please enter your username and desired password to sign up to mywebapp.<h3>
  <form method="post" id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
	  <label for="email">Email address:</label>
      <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password(retype):</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" />
  </form>
  </div>
</body> 
</html>
