<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <title>mywebapp - email confirmation</title>
  <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body id="body">
<?php

mysql_connect("localhost", "root", "") or die(mysql_error()); // Connect to database server(localhost) with username and password.
mysql_select_db("mywebapp") or die(mysql_error()); // Select registration database.;

if(isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['confirmcode']) && !empty($_GET['confirmcode'])){
	
	$username = mysql_escape_string($_GET['username']); // Set email variable
    $confirmcode = mysql_escape_string($_GET['confirmcode']); // Set hash variable
                 
    $search = mysql_query("SELECT username, confirmcode, confirmed FROM web_user WHERE username='".$username."' AND confirmcode='".$confirmcode."' AND confirmed='0'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);

	
	if($match > 0){
        // We have a match, activate the account
        mysql_query("UPDATE web_user SET confirmed='1' WHERE username='".$username."' AND confirmcode='".$confirmcode."' AND confirmed='0'") or die(mysql_error());
        echo '<p class="correct">Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<p class="error">Your account has already been activated. Go ahead and <a href="login.php">log in</a></p>';
    }
                 
}else{
    // Invalid approach
    echo '<p>Invalid approach, please use the link that has been send to your email.</p>';
}


?>
</body>
</html>