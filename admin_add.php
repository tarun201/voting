<?php
session_start();
if(!isset($_SESSION['logged_in']) && $_SESSION['role']!='admin')
{
	header("location:login.php?i=3");
}
include "connection.php";

$query = "select * from candidates";
$result = mysqli_query($dbc,$query) or die("Querying error");
$n=mysqli_num_rows($result);

if(!empty($_POST['candidate']))
{
  $candidate=$_POST['candidate'];
  $filename=$_FILES["manifesto"]["name"];
    $dest='../vote/'.$candidate;
  if(move_uploaded_file($_FILES["manifesto"]["tmp_name"],$dest))
  {
    $query1 = "update candidates set manifesto='$dest' where id=$candidate";
    $result1 = mysqli_query($dbc,$query1) or die("Querying error<br>".mysqli_error($dbc));
    echo "<script>alert('File Uploaded');</script>";
  }


}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add manifesto</title>
  </head>
  <body>
    <div class="" style="text-align:center">
      <h2>Add Manifesto here:</h2>

      <form class="" action="admin_add.php" method="post" enctype='multipart/form-data'>

        <select class="" name="candidate">
          <option value="-1" selected>Select candidate..</option>
          <?php for($i=0;$i<$n;$i++){
            $row=mysqli_fetch_array($result);
           ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php } ?>
        </select>  <input type="file" name="manifesto" value="" required><br>
      <br>  <input type="submit" name="submit" value="Submit">
      </form>

    </div>
    <div class="" style="text-align:center">
      <br> <a href="logout.php">Log Out</a> <br>
    </div>
  </body>
</html>
