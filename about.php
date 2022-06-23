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
                <span class="menu__icon">
                   <img src="image/svg/about.svg" width="20px" height="20px">
                </span>About Us
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
             <h1>About Us</h1>
             
          </div>

          <div class="cards">
             <div class="card">
                <header class="card__header">
                   <div class="card__img">
                      <img src="image/developer.png" width="300px" height="300px" alt="avatar" />
                   </div>
                   <div class="card__name">
                      <h6>Aditya Pandey</h6>
                      <span class="card__role"><b><i class="fas fa-code"></i>&nbsp;Designer & Developer</b></span>
                   </div>
                </header>
                <div class="card__body">
                  <p style="text-align: justify; text-justify: inter-word;">
                     Hi All,<br>
                     &nbsp;&nbsp;This is a Tic-Tac-Toe Game designed for you to play with your friends. We have designed this game with a attractive interface and you wil surely love this game and if you like this please share this game with your friends. <br>
                     If you face any issue or have a query please reach out to us on our below email we will surely help you out. We are also open for any suggestions. <br>
                     Thank You All
                  </p>
                   <div class="stats">
                      <div class="score">
                         <h3><a href="https://adipandey.in/"  target="_blank"><i class="fas fa-link"></i></a></h3>
                         <small class="title">Portfolio</small>
                      </div>
                      <div class="score">
                         <h3 ><a href="https://www.linkedin.com/in/aditya-pandey-1375a818a/"  target="_blank"><span style="color: #3399ff;"><i class="fab fa-linkedin"></i></i></span></a></h3>
                         <small class="title">Linkdin</small>
                      </div>
                      <div class="score">
                         <h3 title="info@tictactoe.adipandey.in"><a href="javascript:void(0);"  onclick="copyEmail();return false;"><span style="color: red;"><i class="fas fa-envelope"></i></span></a></h3>
                         <small class="title">Email</small>
                      </div>
                   </div>
                </div>
             </div>
             </div>
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

       function copyEmail() {
         var copyText = "info@tictactoe.adipandey.in";
         copyText.select();
         copyText.setSelectionRange(0, 99999)
         document.execCommand("copy");
         toastr["success"]("Email Id has been copied successfully!", "Success!");
      }
    </script>
<?php

  $con->close();
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </body>
</html>