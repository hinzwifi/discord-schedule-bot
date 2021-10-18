<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /accounts/index.html');
	exit;
}
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
<script src="https://use.fontawesome.com/2fb24c7815.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{display:none;}

    </style>
    <title>
        hinzwifi
    </title>
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bx-home'></i>
      <span class="logo_name"><?=$_SESSION['username']?></span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="../index.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Category</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Category</a></li>
          <li><a href="#">HTML & CSS</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">PHP & MySQL</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Posts</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Posts</a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Login Form</a></li>
          <li><a href="#">Card Design</a></li>
        </ul>
      </li>
      <li>
        <a href="https://hinzwifi.speedtestcustom.com"  target="myiframe">
          <i class='bx bx-cloud-lightning' ></i>
          <span class="link_name">Speedtest</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Speedtest</a></li>
        </ul>
      </li>
      <li>
        <a href="/birthday/index.php" target="myiframe">
          <i class="fa fa-birthday-cake" aria-hidden="true"></i>
          <span class="link_name">Birthday</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Birthday</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-plug' ></i>
            <span class="link_name">Plugins</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Plugins</a></li>
          <li><a href="#">UI Face</a></li>
          <li><a href="#">Pigments</a></li>
          <li><a href="#">Box Icons</a></li>
        </ul>
      </li>
      <li>
        <a href="/events/index.php" target="myiframe">
          <i class='bx bxs-calendar'></i>
          <span class="link_name">Calendar</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Calendar</a></li>
        </ul>
      </li>
      <li>
        <a href="/discord-hack/index.php" target="myiframe">
          <i class='bx bxs-vial'></i>
          <span class="link_name">Schedule</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Schedule</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Settings</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Settings</a></li>
        </ul>
      </li>
      <li>
     <li>
        <a href="/accounts/logout.php">
            <i class="bx bx-log-out"></i>
            <span class="link_name">Log out</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Log out</a></li>
            </ul>
          </li>
  
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
        <i class='bx bx-chevrons-right' id="home-icon"></i>
      <span class="text">Home</span>
      
    
    </div>
    <iframe name="myiframe"  width="100%"
    style="height:92.9vh;" frameBorder="0"></iframe>
  </section>
 <script src="js/style.js"></script>
</body>
</html>
