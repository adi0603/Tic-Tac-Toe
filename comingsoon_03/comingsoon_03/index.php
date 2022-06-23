
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/png" href="../../image/icon.png">
	<title>TIC TAC TOE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" >
		<div class="wsize1 bor1 bg1 p-t-175 p-b-45 p-l-15 p-r-15 respon1">
			<div class="wrappic1">
				<b><h1 style="color: #05728f;">TIC TAC TOE</h1></b>
			</div>

			<p class="txt-center m1-txt1 p-t-33 p-b-68">
				Our website is under construction.<br> We are currently making some new stuffs for you.<br> Stay Connected we will be back soon.<br><img src="images/loader.gif">
			</p>
			
			<div class="wsize2 flex-w flex-c hsize1 cd100">
				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 days" id="days">00</span>
					<span class="s1-txt1">Days</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 hours" id="hours">00</span>
					<span class="s1-txt1">Hours</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 minutes" id="mins">00</span>
					<span class="s1-txt1">Minutes</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 seconds" id="secs">00</span>
					<span class="s1-txt1">Seconds</span>
				</div>
			</div>
			<center><h3>Thank You</h3></center>
			

			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/moment.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script>
		var countDownDate = new Date("Jun 7, 2022 15:59:59").getTime();
		var myfunc = setInterval(function() {
		var now = new Date().getTime();
		var timeleft = countDownDate - now;
		    
		var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
		var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
		document.getElementById("days").innerHTML = days 
		document.getElementById("hours").innerHTML = hours 
		document.getElementById("mins").innerHTML = minutes  
		document.getElementById("secs").innerHTML = seconds 
		}, 1000)
	</script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>