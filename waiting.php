<?php 
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
$status=0;
require 'config.php';
$name=$_SESSION['name'];
$userid=$_SESSION['userid'];
$email=$_SESSION['email'];
$oppo_userid=$_SESSION['oppoUserId'];
$room_code=$_SESSION['roomCode'];

$parts = explode(" ", $name);
if(count($parts) > 1) {
    $lname = array_pop($parts);
    $fname = implode(" ", $parts);
}
else
{
    $fname = $name;
    $lname = " ";
}

// $result1 = mysqli_query($con,"select start from game where room_code='$room_code' and userid='$userid'");
// $fetch1 = mysqli_fetch_array($result1);
// $start=$fetch1['start'];
// if ($start==1) {
//   header('Location: gameboard_send.php');
// }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <title>Waiting Area | TIC-TAC-TOE</title>
    <link rel="stylesheet" href="css/dashboard.css?rnd=123">
    <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->


    <!-- Notification -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/test.js"></script>
    <link rel="stylesheet" type="text/css" href="css/test.css">

     <script type="text/javascript">
      $(document).ready(function(e) {
            var refresher = setInterval("update_content();", 1000); 
          })
          function update_content(){  
            $.ajax({  
              url : "gamecheck.php",  
              type : "POST",  
              success:function(data){  
                  $("#waiting").html(data);  
               }  
            });  
          } 
    </script> 
    // <script type = "text/JavaScript">
    //         function AutoRefresh( t ) {
    //           setTimeout("location.reload(true);", t);
    //         }
    //   </script>

  </head>
<!--onload="JavaScript:AutoRefresh(2000);"-->
  <body >
    <div class="app">
       <aside class="nav">
          <div class="burger">
             <span class="line"></span>
          </div>
          <div class="nav__logo">
             <img src="image/icon.png" height="50px" width="50px" />
          </div>
          <ul class="menu">
             <li class="menu__item" >
               <a href="dashboard.php" style="text-decoration: none;">
                <span class="menu__icon">
                  
                     <img src="image/svg/dashboard.svg" width="20px" height="20px">
                  
                 </span>Dashboard
                 </a>
             </li>
             <li class="menu__item">
              <a href="profile.php" style="text-decoration: none;">
                <span class="menu__icon">
                   <img src="image/svg/profile.svg" width="20px" height="20px">
                </span>Profile
              </a>
             </li>
             <li class="menu__item">
               <a href="addfriend.php" style="text-decoration: none;">
                <span class="menu__icon">
                   <img src="image/svg/addfriend.svg" width="20px" height="20px">
                </span>Add Friend
             </a>
             </li>
             <li class="menu__item">
              <a href="request.php" style="text-decoration: none;">
                <span class="menu__icon">
                   <img src="image/svg/request.svg" width="20px" height="20px">
                </span>Invites
              </a>
             </li>
             <li class="menu__item">
               <a href="about.php" style="text-decoration: none;">
                <span class="menu__icon">
                   <img src="image/svg/about.svg" width="20px" height="20px">
                </span>About Us
               </a>
             </li>
             <div class="menu__item">
             <a class="nav__link" href="logout.php">
                <span class="icon">
                   <img src="image/svg/logout.svg" width="20px" height="20px">
                </span>Logout
              </a>
          </div>
          </ul>
          
       </aside>
       <main class="main">
          <header class="main__header" style="display: flex; justify-content: flex-end;">
            <div class="main__user">
                <div class="main__avatar">
                   <img src="image/avatar.png" height="50px" width="50px" />
                </div>
                <div class="main__title">
                   <h5><?php echo $fname; ?></h5>
                </div>
             </div>
          </header>

          <div class="team">
             <h1>Waiting Area</h1>
             
          </div>

          <div class="cards"  id="waiting">
             
             </div>
       </main>
    </div>

    <script type="text/javascript">
      const burger = document.querySelector(".burger");
       const nav = document.querySelector(".nav");
       $(document).ready(function() {
          burger.addEventListener("click", () => {
             burger.classList.toggle("is-open");
             nav.classList.toggle("is-open");
          });
       });   

    </script>
<?php

  $con->close();
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </body>
</html>