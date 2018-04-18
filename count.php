<?php
session_start();
include 'connection.php';
$vf =  $_POST['vf'];
$query = "update candidates set count = count+1 where name='$vf'";
$result = mysqli_query($dbc,$query) or die ("Error updating<br>".mysqli_error($dbc));

$query2 = "update login set voted=1 where username='$_SESSION[username]'";
$result2 = mysqli_query($dbc,$query2) or die ("Error updating login<br>".mysqli_error($dbc));
$_SESSION[voted]=1;

header("location:index.php");
 ?>
