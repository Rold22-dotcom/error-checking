<?php
session_start();
if (!isset($_SESSION['kid-name'])) {

  header("Location: index.php");
  exit();
}
if ($_SESSION['kid-name'] != "") {
  $kid = $_SESSION['kid-name'];
  $kidjs = json_encode($kid);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main</title>

  <style>
    body {
      background-image: url(img/background.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;

    }


    button:hover {
      background-color: rgb(204, 153, 0) !important;
    }

    button {
      background-color: rgb(148, 76, 43);
      color: rgb(15, 13, 15);
      height: 50px;
      font-family: 'Times New Roman', Times, serif;
      font-size: 150px;
      width: 200px;

    }


    .btn1 {
      background-color: transparent;

    }

    .btn1 button {
      background-color: rgb(148, 76, 43);
    }

    @media only screen and (max-width: 414px) {



      img {
        width: 200px;
        height: 70px;
      }

      button {
        font-size: 30px;
      }
    }
  </style>

  <link rel="icon" href="data:,">


</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->

<body loading="lazy">
  <audio id="background-audio" src="music/Puzzle Dance (@fowksprod).mp3" autoplay loop>
    Your browser does not support the audio element.
  </audio>
  <!-- this is side bar -->
  <nav class="btn1 navbar fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="span navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Home
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Go to Login Page</a></li>
                <li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Settings
              </a>
              <ul class="dropdown-menu">
                <li>
                  <label class="text-center">Music: <input type="range" id="rangeaudio" style="width: 250px;" min="0" max="100" value="100"></label>
                </li>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="choicemode position-absolute top-50 start-50 translate-middle d-grid gap-2">

    <button class="rounded" onclick="change()">Start</button>

  </div>

  <script>
    // <!-- this is button to go on game.php file -->
    function change() {
      window.location = "game.php";
    }

    const rangevolume = document.getElementById('rangeaudio');
    const audiovolume = document.getElementById('background-audio');
    rangevolume.addEventListener('input', function() {

      audiovolume.volume = rangevolume.value / 100;



    });

    document.body.addEventListener('click', function() {
      var audioElement = document.getElementById('background-audio');

      audioElement.play();

    }, {

      once: true

    });
    

    //window.onload = function(){
    // document.getElementById('background-audio').play();
    // }
  </script>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>