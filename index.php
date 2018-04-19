<?php
session_start();
if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in']!=1)
{
	header("location:login.php?i=0");
}


 ?>

<html>
<head>
	<title>Election</title>
	<style>
	body{
		text-align:center;
	}



	.header p{
		font-weight:bold;
	}

	#list,#dis2{
		border:2px solid grey;
		margin:auto;
		padding:10px;
		width: 30%;
		color:white;
	}
	#dis{
		display: none;

	}
	#dis2{
		background:red;
	}

	button{
		margin: 4px;
	}




	</style>

	<script>
	var ajaxObject = new XMLHttpRequest();
	var xhttp = new XMLHttpRequest();


	function getForm(){
		if(!ajaxObject){
			document.getElementById("body2").innerHTML="Ajax Object not created!"
			return;
		}
		ajaxObject.open("POST","form.php");
		ajaxObject.send();
		ajaxObject.onreadystatechange=getResponse;
	}

	function getResponse() {
		if(ajaxObject.readyState == 4 && ajaxObject.status == 200)
		{
			document.getElementById("body2").innerHTML=ajaxObject.responseText;
		}
	}

	function displayValue() {
		var r = confirm("Are you sure?");
		var voted_for = document.getElementById('vinitha').elements['rad'].value;
		if(r==1)
		{

			document.getElementById('dis').style.display="block";
			document.getElementById('dis2').innerHTML=voted_for;
			xhttp.open("POST","count.php",true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("vf="+voted_for);
		}

		else {
				document.getElementById('dis2').innerHTML="Cancelled";
			}
		document.getElementById('bt_hide').style.display="none";
	}

	function displayResult() {
		var result1 = new XMLHttpRequest();
		if(!result1){
			document.getElementById("result").innerHTML="Ajax Object not created!"
			return;
		}
		result1.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("result").innerHTML = this.responseText;
			}
		};
		result1.open("POST","find_max.php",true);
		result1.send();
	}

	var flag=1;
	function changeColor()
	{
		if(flag==0)
		{
			document.getElementById('dis2').style.backgroundColor = "red";
			flag=1;
		}
		else {
			document.getElementById('dis2').style.backgroundColor = "blue";
			flag=0;
		}

	}


	</script>

</head>
<body>
	<div class="header">
		<h2>List of candidates for the post of CR</h2>
		<p>Getting the list from the server</p>
		<input type=button value="List of Candidates " onclick="getForm();" />
		<button onclick="changeColor();" id="color">Change color</button>
	</div>

	<div id="body2">
	</div>
<br>
<div id="bt_hide">

	<input type=button  name="button1" onclick="displayValue();"  value="vote"/>
</div>


	<div id="dis">
		<h4>You have voted for:</h4>
		<div id="dis2">

		</div>

	</div>

	<!-- <hr>
	<div id="rslt">
		<input type=button  name="button2" onclick="displayResult();"  value="Display result"/>
		<div id="result">
		</div>
	</div> -->


<br>
<a style="text-align:center;" href="logout.php">Logout</a>

</body>
</html>
