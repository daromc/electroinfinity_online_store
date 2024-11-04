<!-- Connection File -->

<?php

$server = 'deepblue.cs.camosun.bc.ca';
$user = 'ICS199Group04';
$pswd = '987654P';
$db='ICS199Group04_DB';

$dbc = mysqli_connect($server,$user,$pswd,$db);
  
// If you want to check if you can connect to database or not, uncomment the code below.
// if ($dbc) {
// 	print "Connected successfully to database " . $db . "<BR><BR>";
//  }
//   else {
// 	print 'MySQL Error:' . mysqli_connect_error(); 
//  }

?>