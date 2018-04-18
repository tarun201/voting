<?php
session_start();
include 'connection.php';
$query = "select max(count),name from candidates where section='$_SESSION[section]' group by name";
$result = mysqli_query($dbc,$query) or die ("Error updating");
$row=mysqli_fetch_array($result);

 ?>

<p>The winner of the Election is :</p>
<h4><?php echo $row['name']; ?></h4>
