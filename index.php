<?php 

session_start();// session started

		if(isset($_SESSION['Name'])){ /*
 this check if user is log in  by checking $_SESSION['Name'] variable  */	
		header("Location: online.php"); 
exit();
		}
	
	

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="images/icon.png">
<script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>TIC TAC TOE</title>

<?php 
$error1 = "";// this will be use for displaying error (Username or password is incorrect)
$error = "";// this will be use for displaying sql connect errors
    if(isset($_POST['username'])){ /* this if checks is form is submitted by checking that $_POST['username'] is set or exists */

   include 'connection.php'; /* this file contains variables used for connecting to database ($server,$username,$password,$dbname)*/

$conn = new mysqli($server, $username, $password);// this create connection

if ($conn->connect_error) { //  this checks if there error connecting to server
	$error = die("Connection failed: " . $conn->connect_error); // saves error  in $error
    
} 

$username =  trim(htmlspecialchars($_POST['username']));/* this will trim(remove extra spaces) and remove html tags from username*/
$password= trim(htmlspecialchars($_POST['password']));/* this will trim(remove extra spaces) and remove html tags from password*/

$sql = 'SELECT * FROM '.$dbname.'.users '; //query for selecting data from studentlogin table
$result = $conn->query($sql); // 

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row['username'] == $username && $row['password'] == $password){
			
		    $_SESSION['Name'] =  $row['username'];
			$_SESSION['Id'] = $row['Id'];
			$sql = "DELETE FROM ".$dbname.".`online` WHERE plrid=".$_SESSION["Id"];
			$conn->query($sql);
			$sql = "INSERT INTO ".$dbname.".`online`(`plrid`, `plrname`) VALUES (".$_SESSION['Id'].",'".$_SESSION['Name']."')";
			$conn->query($sql);
			
			
			header("Location: online.php"); /* Redirect browser */
exit();
		}
		else 
		{
			$error1 = "UserName or Password Is Incorrect!";
			
		}
		
        
    }
} 
$conn->close();
	}
	
	 


   
?>
<link href="css/bootstrap.css" rel="stylesheet">
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color:rgb(240, 240, 240);
  color: blue;
  text-align: center;
}
</style>
</head>
<body>
	
<nav class="navbar navbar-default">
  	<div class="container-fluid"> 
    	<h1><img src="images/logo.png" height="50px" width="150px"></h1>      
  	</div>
</nav>

<div class="container text-center" >
  
  <h2 style="color: blue;">Log In</h2> 
 
  <hr>
  
    
    <form action="index.php" method="post" >
    <div class="form-group text-left center-block" style=" width:50%;" >
      <label for="usr">UserName:</label>
      <input placeholder="Enter You Username..." type="text" class="form-control" name="username"required> 
    </div>
    <div class="form-group text-left center-block" style=" width:50%;" >
      <label for="pwd">Password:</label>
      <input placeholder="Enter your Password..." type="password" class="form-control" name="password" required> 
      <center>
      	<?php echo '<p style="color:red">'.$error. $error1. "</p>"?>
  	  </center>
    </div>
    
    	<button class="btn btn-primary" id="submit" type="submit">Log In</button>
    	<button type="button" class="btn btn-info" onclick="window.location.href='signup.php'">Sign Up</button>
    	<button  type="reset"  class="btn btn-danger"> Reset </button>
  </form>
  </div> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<div class="footer">
  	<center>
	    <b>
		    <h4 style="color: blue;">Follow Us</h4>
		    <a href="https://www.instagram.com/_simplethoughts._/?hl=en" target="_blank" title="Instagram"><button type="button" class="btn btn-info"><i class="fa fa-instagram"></i></button></a>
		    <a href="https://www.linkedin.com/in/aditya-pandey-1375a818a/" target="_blank"  title="Linkedin"><button type="button" class="btn btn-info"><i class="fa fa-linkedin"></i></button></a>
		    <a href="https://adityapandey.me/"  target="_blank" title="Portfolio"><button type="button" class="btn btn-info"><i class="fas fa-link"></i></button></a>
		    <a href="https://github.com/adi0603"  target="_blank" title="Github"><button type="button" class="btn btn-info"><i class="fab fa-github"></i></button></a><br><br>
	    	<div class="row">
			    <div class="col-md-12 copy">
			      <p class="text-center" style="color: blue;">&copy; TIC TAC TOE - 2021 | Aditya Pandey<br>  All rights reserved.</p>
			    </div>
	  		</div>
  		</b>
  	</center>
</div>
</body>
</html>
