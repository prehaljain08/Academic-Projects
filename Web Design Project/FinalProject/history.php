<?php
session_start();

$pid = $_SESSION['pid'];

mysql_connect('127.0.0.1', 'root', 'password');
$query = "Select pickdate, picklocation from bookingdetails where pid = 1 order by pickdate";
$result = mysql_db_query('webdesignEnterpriseDb', $query);
$returnresult = "<table><tr><th>Pick Date</th><th>Pick Location</tr>";

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $pickdate = $row['pickdate'];
    $picklocation = $row['picklocation'];
    $returnresult = "$returnresult<tr><td>$pickdate</td><td>$picklocation</td></tr>"; 
}

    echo $returnresult;
?>
