<?php 
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
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


$notify_value=0;
if (isset($_POST['search'])) {
  $searchUserId=$_POST['searchUserId'];
  if($searchUserId!=$userid){
      $result1 = mysqli_query($con,"SELECT id FROM friendlist WHERE friend_userid='$searchUserId' and user_userid='$userid'");
      if ($result1->num_rows < 1) {
        $result = mysqli_query($con,"SELECT userid,name FROM login WHERE userid='$searchUserId'");
        if ($result->num_rows > 0) {
          $fetch = mysqli_fetch_array($result);
          $searchUserName=$fetch['name'];
          $notify_value=1;
        }
        else{
         $notify_value=2;
        }
      }
     else{
      $notify_value=5;
     }
  }
  else{
   $notify_value=3;
  }
}

if (isset($_POST['addFriend'])) {
   $searchUserId=$_POST['searchUserId'];
   $result1 = mysqli_query($con,"INSERT into friendlist (user_userid,friend_userid) values ('$userid','$searchUserId')");
   $notify_value=4;
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


    <!-- Notification -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/test.js"></script>
    <link rel="stylesheet" type="text/css" href="css/test.css">

    <style> 
         /* Rounded Responsive Search Box by CodeHim.com*/ /* Remove this line if you have already installed Adobe Font Awesome Icons*/ @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"); /*Removable*/ 
         .search-area { 
            background: transparent; 
            padding: 10px; 
            border: none; 
            margin: 10px; 
            text-align: center; 
            border-radius: 10px; 
         } 
         .codehim-ss-bar { 
            padding: 10px; 
            box-sizing: border-box; 
         } 
         .codehim-ss-bar input[type=number] { 
            color: #3366ff; 
            caret-color: #000; 
            font-size: 10pt; 
            width: 80%; 
            padding: 13px; 
            display: inline; 
            background: #fff; 
            border: 1px solid #e6e6e6; 
            outline: 0; 
            border-radius: 30px 0 0 30px; 
         } 
         .codehim-circle-search-button:hover { 
            box-shadow: 1px 2px 6px #444; 
            color: #3366ff; 
            background: #fff; 
         } 
         .codehim-circle-search-button { 
            display: inline-block; 
            margin-left: -33px; 
            border: none; 
            outline: 0; 
            background: #3366ff; 
            color: #fff; 
            width: 50px; 
            height: 50px; 
            cursor: pointer; 
            transition: .3s; 
            -webkit-transition: .3s; 
            -moz-transition: .3s; 
            font-size: 14pt; 
            border-radius: 50%; 
         } 
         .codehim-circle-search-button:before { 
            content: "\f002"; 
            font-family: FontAwesome; 
            font-weight: normal; 
         } 
      </style>
  </head>

  <body>
   <?php
        if($notify_value==2){
          ?>
          <script type="text/javascript">
            toastr["error"]("Account you are searching for doesn't exist!", "Error!");
          </script>
          <?php
        }
        elseif ($notify_value==3) {
          ?>
          <script type="text/javascript">
            toastr["error"]("You are searching your own account!", "Error!");
          </script>
          <?php
        }
        elseif ($notify_value==4) {
          ?>
          <script type="text/javascript">
            toastr["success"]("User has been added to your friend list!", "Success!");
          </script>
          <?php
        }
        elseif ($notify_value==5) {
          ?>
          <script type="text/javascript">
            toastr["error"]("You have already added user as your friend!", "Error!");
          </script>
          <?php
        }
      ?>
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
                <span class="menu__icon">
                   <img src="image/svg/addfriend.svg" width="20px" height="20px">
                </span>Add Friend
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
             <h1>Add Friends</h1>
             <br>
          </div>
          
          <div class='search-area'> 
            <div class='codehim-ss-bar'> 
               <form  method="POST"> 
                  <input type='number'  autocomplete="off" max="999999" min="100000"  name="searchUserId" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter friends User Id..."/> 
                  <button type="submit" name="search" class="codehim-circle-search-button"> </button> 
               </form> 
            </div> 
          </div>
          <?php 
            if ($notify_value==1) {
               
          ?>
          <div class="cards">
             <div class="card">
                <header class="card__header">
                   <div class="card__img">
                      <img src="image/friend.png" width="100px" height="100px" alt="avatar" />
                   </div>
                   <div class="card__name">
                      <h6><?php echo $searchUserName; ?></h6>
                      <span class="card__role"><b><span style="color: blue;"><i class="fas fa-id-card-alt"></i></span>&nbsp;:&nbsp;<?php echo $searchUserId; ?></b></span>
                   </div>
                   <?php 
                        $result5 = mysqli_query($con,"SELECT COUNT(*)played FROM game where (userid='$searchUserId' and (winner=1 or winner=2 or winner=3)) or (oppo_userid='$searchUserId' and (winner=1 or winner=2 or winner=3))");
                        $result6 = mysqli_query($con,"SELECT COUNT(*)won FROM game where (userid='$searchUserId' and winner=1) or (oppo_userid='$searchUserId' and winner=2);");
                        $result7 = mysqli_query($con,"SELECT COUNT(*)lost FROM game where (userid='$searchUserId' and winner=2) or (oppo_userid='$searchUserId' and winner=1);");
                        $fetch5=mysqli_fetch_array($result5);
                        $fetch6=mysqli_fetch_array($result6);
                        $fetch7=mysqli_fetch_array($result7);
                   ?>
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
                  <button style="color: #fff;border-radius: 20px;background-color: #3366ff;border-color: #3366ff;" name="addFriend" type="submit">Add Friend &nbsp; <i class="fas fa-user-plus"></i></button>
                  <input type="hidden" name="searchUserId" value="<?php echo $searchUserId; ?>">
               </center>
             </form>
             </div>
             </div>

             
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