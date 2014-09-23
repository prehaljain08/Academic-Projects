<?php

$name = $_POST['nametxt'];
$password = $_POST['passwordtxt'];
$email = $_POST['emailtxt'];

mysql_connect('127.0.0.1', 'root', 'password');

$query1 = "INSERT INTO person set name = '$name'";
mysql_db_query("webdesignEnterpriseDb", $query1);

$personid = mysql_insert_id(); 

$query2 = "insert into useraccount set email = '$email', password = '$password', pid = $personid";
mysql_db_query("webdesignEnterpriseDb", $query2);        
        
?>
