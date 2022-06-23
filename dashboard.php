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
  $oppo_userid=$_POST['searchUserId'];
  $room_code=rand(100000,999999);
  $result = mysqli_query($con,"INSERT into game (userid,oppo_userid,room_code) values ('$userid','$oppo_userid','$room_code')");
  $_SESSION['oppoUserId']=$oppo_userid;
  $_SESSION['roomCode']=$room_code;
  header('Location: waiting.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="image/icon.png">
    <title>Dashboard | TIC-TAC-TOE</title>
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
                <span class="menu__icon">
                   <img src="image/svg/dashboard.svg" width="20px" height="20px">
                 </span>Dashboard
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
             <!-- <div class="main__search">
                <input type="search" size="25" placeholder="Search" />
                <span class="icon-search">
                   <img src="image/svg/search.svg" width="20px" height="20px">
                </span>
             </div> -->
             <div class="main__user">
                <!-- <span class="main__icon">
                   <svg width="48" height="48" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="48" height="48" rx="11" fill="#fff" />
                      <path d="M26 30h-4c0 1.1.9 2 2 2s2-.9 2-2zM31 27h-.5c-.7-.7-1.5-1.7-1.5-3v-3c0-2.8-2.2-5-5-5s-5 2.2-5 5v3c0 1.3-.8 2.3-1.5 3H17c-.6 0-1 .4-1 1s.4 1 1 1h14c.6 0 1-.4 1-1s-.4-1-1-1z" fill="#A4A8BD" />
                   </svg>
                </span> -->
                <div class="main__avatar">
                   <img src="image/avatar.png" height="50px" width="50px" />
                </div>
                <div class="main__title">
                   <h5><?php echo $fname; ?></h5>
                </div>
             </div>
          </header>
          <div class="team">
             <h1>Friend List</h1>
          </div>
          
          <?php
              $result = mysqli_query($con,"select * from friendlist where user_userid='$userid'");
              if (mysqli_num_rows($result) > 0) {
               $i=1;
               ?>

                  
               <?php
                while($row = mysqli_fetch_array($result)) {
                  $friend_userid=$row['friend_userid'];
                  $result1 = mysqli_query($con,"select * from login where userid='$friend_userid'");
                  $fetch1=mysqli_fetch_array($result1);
                    $result5 = mysqli_query($con,"SELECT COUNT(*)played FROM game where (userid='$friend_userid' and (winner=1 or winner=2 or winner=3)) or (oppo_userid='$friend_userid' and (winner=1 or winner=2 or winner=3))");
                        $result6 = mysqli_query($con,"SELECT COUNT(*)won FROM game where (userid='$friend_userid' and winner=1) or (oppo_userid='$friend_userid' and winner=2);");
                        $result7 = mysqli_query($con,"SELECT COUNT(*)lost FROM game where (userid='$friend_userid' and winner=2) or (oppo_userid='$friend_userid' and winner=1);");
                        $fetch5=mysqli_fetch_array($result5);
                        $fetch6=mysqli_fetch_array($result6);
                        $fetch7=mysqli_fetch_array($result7);
                  if($i % 2 !=0){
                     ?>
                     <div class="cards">
                     <?php
                  }
                ?>
                  
                   <div class="card">
                      <header class="card__header">
                         <div class="card__img">
                            <img src="image/friend.png" width="100px" height="100px" alt="avatar" />
                         </div>
                         <div class="card__name">
                            <h6><?php echo $fetch1['name']; ?></h6>
                            <span class="card__role"><b><span style="color: blue;"><i class="fas fa-id-card-alt"></i></span>&nbsp;:&nbsp;<?php echo $row['friend_userid']; ?></b></span>
                         </div>
                      </header>
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
                      <form method="POST">
                        <center>
                           <button style="color: #fff;border-radius: 20px;background-color: #3366ff;border-color: #3366ff;" name="play" type="submit">Play Game &nbsp; <i class="fas fa-gamepad"></i></button>
                           <input type="hidden" name="searchUserId" value="<?php echo $friend_userid; ?>">
                        </center>
                      </form>

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
              <p>You don't have any friend in your list. Please add friends from Add Friend section.</p>
              <?php
            }
            ?>




          <br>
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