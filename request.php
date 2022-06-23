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

if (isset($_POST['play'])) {
  $room_code=$_POST['roomcode'];
  $oppo_userid=$_POST['oppo_userid'];
  $result = mysqli_query($con,"UPDATE game SET start='1' where oppo_userid='$userid' and room_code='$room_code'");
  $_SESSION['roomCode']=$room_code;
  $_SESSION['oppo_userid']=$oppo_userid;
  header('Location: gameboard_receive.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <title>Request | TIC-TAC-TOE</title>
    <link rel="stylesheet" href="css/dashboard.css?rnd=123">
    <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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
             <h1>Invites</h1>
          </div>
          
          <?php
              $result = mysqli_query($con,"select userid,oppo_userid,room_code from game where oppo_userid='$userid' and start='0' ORDER BY id DESC");
              if (mysqli_num_rows($result) > 0) {
               $i=1;
               ?>

                  
               <?php
                while($row = mysqli_fetch_array($result)) {
                  $oppo_userid=$row['userid'];
                  $result1 = mysqli_query($con,"select name from login where userid='$oppo_userid'");
                  $fetch1=mysqli_fetch_array($result1);
                  $name1=$fetch1['name'];
                  $parts1 = explode(" ", $name1);
                  if(count($parts1) > 1) {
                      $lname1 = array_pop($parts1);
                      $fname1 = implode(" ", $parts1);
                  }
                  else
                  {
                      $fname1 = $name1;
                      $lname1 = " ";
                  }
                  if($i % 2 !=0){
                     ?>
                     <div class="cards">
                     <?php
                  }
                ?>
                  
                   <div class="card">
                      <header class="card__header">
                         <div class="card__img">
                            <img src="image/icon.png" width="100px" height="100px" alt="avatar" />
                         </div>
                         <div class="card__name">
                            <h6><?php echo $fname ?>&nbsp;<b>VS</b>&nbsp;<?php echo $fname1; ?></h6>
                            <p>Accept the request to play a game with user....</p>
                         </div>
                      </header>
                      <div class="card__body">
                         <form method="POST">
                        <center>
                           <button style="color: #fff;border-radius: 20px;background-color: #3366ff;border-color: #3366ff;" name="play" type="submit">Accept &nbsp; <i class="fas fa-gamepad"></i></button>
                           <input type="hidden" name="roomcode" value="<?php echo $row['room_code']; ?>">
                           <input type="hidden" name="oppo_userid" value="<?php echo $oppo_userid; ?>">
                        </center>
                      </form>
                         </div>
                      </div>
                   </div>
                  
                <?php
                if($i % 2 ==0){
                  ?>
               </div>
               <?php
               }
               $i++;
              }
            }else{
              ?>
              <p>You don't have any request in your list.</p>
              <?php
            }
            ?>




          <br>
          <center><p style="font-size: 15px;">Design & developed by <br><span style="color: blue;">Aditya Pandey</span></p></center>
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
    </body>
</html>