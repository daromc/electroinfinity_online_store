<!-- Connection File -->

<?php

$server = 'localhost';
$user = 'daromc';
$pswd = 'daromc';
$db='db_daromc';

$dbc = mysqli_connect($server,$user,$pswd,$db);
  
// If you want to check if you can connect to database or not, uncomment the code below.
// if ($dbc) {
// 	print "Connected successfully to database " . $db . "<BR><BR>";
//  }
//   else {
// 	print 'MySQL Error:' . mysqli_connect_error(); 
//  }

?>