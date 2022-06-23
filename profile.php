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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <title>Add Friend | TIC-TAC-TOE</title>
    <link rel="stylesheet" href="css/dashboard.css?rnd=123">
    <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>


    <!-- Notification -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/test.js"></script>
    <link rel="stylesheet" type="text/css" href="css/test.css">

  </head>

  <body>
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
             <h1>Profile</h1>
             
          </div>

          <div class="cards">
             <div class="card">
                <header class="card__header">
                   <div class="card__img">
                      <img src="image/user.png" width="150px" height="150px" alt="avatar" />
                   </div>
                   <div class="card__name">
                      <h6><?php echo $name; ?></h6>
                      <span class="card__role"><b><span style="color: blue;"><i class="fas fa-id-card-alt"></i></span>&nbsp;:&nbsp;<?php echo $userid; ?></b></span>
                      <span class="card__role"><b><span style="color: red;"><i class="fas fa-envelope"></i></span>&nbsp;:&nbsp;<?php echo $email; ?></b></span>

                      <?php 
                        $result5 = mysqli_query($con,"SELECT COUNT(*)played FROM game where (userid='$userid' and (winner=1 or winner=2 or winner=3)) or (oppo_userid='$userid' and (winner=1 or winner=2 or winner=3))");
                        $result6 = mysqli_query($con,"SELECT COUNT(*)won FROM game where (userid='$userid' and winner=1) or (oppo_userid='$userid' and winner=2);");
                        $result7 = mysqli_query($con,"SELECT COUNT(*)lost FROM game where (userid='$userid' and winner=2) or (oppo_userid='$userid' and winner=1);");
                        $fetch5=mysqli_fetch_array($result5);
                        $fetch6=mysqli_fetch_array($result6);
                        $fetch7=mysqli_fetch_array($result7);
                        $result1 = mysqli_query($con,"select logintime,ip_addr from log where userid='$userid' order by logintime DESC LIMIT 1,1;");
                        if ($result1->num_rows > 0) {
                          $fetch1=mysqli_fetch_array($result1);
                          $ipValue= $fetch1['ip_addr'];
                          $logValue= $fetch1['logintime'];
                        }else{
                          $ipValue= "This is the first login";
                          $logValue= "This is the first login";
                        }
                      ?>


                      <span class="card__role"><b><span style="color: greenyellow;"><i class="fas fa-map-marker-alt"></i></span>&nbsp;:&nbsp;<?php echo $ipValue; ?></b></span>
                      <span class="card__role"><b><span style="color: purple;"><i class="far fa-clock"></i></span>&nbsp;:&nbsp;<?php echo $logValue; ?></b></span>
                   </div>
                </header>
                <div class="card__body">
                   <div class="card__body">
                   <div class="stats">
                      <div class="score">
                         <h3><?php echo $fetch5['played']; ?></h3>
                         <small class="title">Played</small>
                      </div>
                      <div class="score">
                         <h3><?php echo $fetch6['won']; ?></h3>
                         <small class="title">Won</small>
                      </div>
                      <div class="score">
                         <h3><?php echo $fetch7['lost']; ?></h3>
                         <small class="title">Lost</small>
                      </div>
                   </div>
                </div>
             </div>
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