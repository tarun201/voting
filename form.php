<?php
session_start();
echo "<br>";
if($_SESSION['voted']==0){

	include 'connection.php';
	$query = "select * from candidates where section='$_SESSION[section]'";
	$result = mysqli_query($dbc,$query) or die("Querying error");

	echo '<form id="vinitha" method="post">';
	$n=mysqli_num_rows($result);
	for($i=1;$i<=$n;$i++)
	{
		$res = mysqli_fetch_array($result);
		echo "<input type=radio id='option1' name='rad' value=".$res['name'].">".$res['name']."</input>";
		if($res['manifesto']==NULL){
			echo " <a href='#'>No manisfesto added</a><br />";
		}
		else {
			echo " <a href='".$res['manifesto']."'download>See manisfesto</a><br />";
		}

	}
	echo "</form>";

}
else {
	echo "<br><p style='color:red;'>You have already voted</p>";
}


?>
