<!DOCTYPE html>
<html>
	<head>
		<title>TIC TAC TOE</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		 <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" type="image/ico" href="image/icon.png">
		<style type="text/css">
			body {
			  	background: white;
			}
			img {   
			   	left: 30%;
			   	position: absolute;
			   	top: 30%;
			}
			@media only screen and (max-width: 360px) {
			  	img {		   
				  	left: 25%;
				  	position: absolute;
				  	top: 30%;
				}
			}
		</style>
	</head>



	<body onload="myFunction()">
		<div id="loader">
			<img class="preloader" src="image/tic_tac_toe_loader_.gif">	
			
		</div>
		<script>
			var myVar;

			function myFunction() {
			  myVar = setTimeout(showPage,5000);
			}

			function showPage() {
			  window.open("login.php","_self");
			}
		</script>
	</body>
</html>