<?php 
session_start();
if(!(isset($_SESSION['requestid']))){
	header("Location: online.php"); /* if requestid is not set then redirect it to online.php */
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $_SESSION['Name'];?> - TIC TAC TOE</title>
<!-- Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js" type="text/javascript"></script>
<link rel="shortcut icon" type="image/png" href="images/icon.png">
<script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
<body style="background:#646BF4; color:white;">
<nav class="navbar navbar-default">
    <div class="container-fluid"> 
      <h1><a href="online.php"><img src="images/logo.png" height="30px" width="120px"></a></h1>
      <button type="button" class="btn btn-danger" style="float:right; margin:2%;" onclick="window.location.href='Logout.php'"><i class="fas fa-sign-out-alt"></i> &nbsp;Logout</button>      
    </div>
</nav>

<div class="container text-center" style="text-align:center;">
  
  <h4> Waiting For Your Opponent To Accept Your Challenge... </h4>
  <hr>
  <center>
    <img src="images/loading.gif" height="100px" width="100px">
  </center>
  <div style="width:80%; margin-left:10%; text-align:center"><div style="width:80%; margin-left:10%; text-align:left;">
 <script>
 var id = <?php echo $_SESSION['requestid'] ?>; 
 function check(){ // this function send requestid to checkrequest.php page to check if the request is accepted or not
	 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
				if(this.responseText == "true"){
					document.getElementById("txt").innerHTML = "<center><h2> Accepted!</h2></center>";
				deleterequest();	
				window.location = "game.php";	
				}
            }
        };
        xmlhttp.open("GET","checkrequest.php?requestid="+id,true);
        xmlhttp.send();
		}
		function deleterequest(){ // this function send requestid to checkrequest.php page to check if the request is accepted or not
	 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","requestaccepted.php?requestid="+id,true);
        xmlhttp.send();
		}
		
 check();
setInterval("check();",600);
//}5000;
</script><span id="txt"> </span><span id="txt1"> </span>
   </div>
  </div></div>
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
