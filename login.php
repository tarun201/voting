<?php
session_start();
$_SESSION['logged_in']=0;
include 'connection.php';

$err = array("Please login to access this area!","Invalid Username or Password","You have been logout. Please log-in again","Not authorized user!");

if(isset($_POST['username']))
{


  $username=$_POST['username'];
  $password=$_POST['password'];

  $query_login="select * from login where username='$username'";
  $result_login=mysqli_query($dbc,$query_login) or die("Login error<br>".mysqli_error($dbc));

  if(mysqli_num_rows($result_login)==0)
  {
    header("location:login.php?i=1");
  }
  else {
    $row=mysqli_fetch_array($result_login);
    if($row['password']==$password)
    {
      $_SESSION['logged_in']=1;
      $_SESSION['username']=$username;
      $_SESSION['voted']=$row['voted'];
      $_SESSION['section']=$row['section'];
      $_SESSION['role']=$row['role'];

      if($_SESSION['role']=='user')
        header("location:index.php");
      else
        header("location:admin_add.php");

    }
    else {
        header("location:login.php?i=1");
    }
  }
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>

    <script type="text/javascript">
      // if(err==1)
      // {
      //   document.getElementById('err').innerHTML='Hello';
      // }
    </script>

    <style media="screen">
      div{
        margin-left: 35%;
        margin-top: 13%;
        width: 30%;
        text-align: center;
      }
      input{
        padding: 2px;
        margin: 4px;
      }
      label{
        margin: 2px;
      }
    </style>
  </head>
  <body>

  <div class="">
    <h3>Login</h3>
<hr>
<?php
if(isset($_GET['i']))
{
  $i=$_GET['i'];
    echo "<p style='color:red;'>$err[$i]</p>";
}
 ?>
<form class="" action="#" method="post">

    <label for="username">Username:</label><br>
    <input type="text" name="username" id="username" placeholder="Your username.." required><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" placeholder="Your Password.." required><br>
    <input type="submit" name="submit" value="Login">

</form>
</div>
<div id="error">

</div>
  </body>
</html>
