<?php
session_start();
// this is to know who is the user a guardian , admin or a child
if (!isset($_SESSION['loginuser'])) {

  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mode</title>
  <link rel="icon" href="data:,">
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






    #easy {
      background-image: url(img/easymode.jpg);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      width: 400px;
      height: 100px;
    }

    #normal {
      background-image: url(img/test.jpg);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      width: 400px;
      height: 100px;
    }

    #hard {
      background-image: url(img/mahirap.png);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      width: 400px;
      height: 100px;
    }

    @media only screen and (max-width: 414px) {


      #easy {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 200px;
        height: 100px;
      }

      #normal {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 200px;
        height: 100px;
      }

      #hard {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 200px;
        height: 100px;
      }

      .choicemode {
        margin-top: 20px;
      }

    }
  </style>


</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                Game Menu
              </a>
              <ul class="dropdown-menu">
                <?php

                if ($_SESSION['loginuser'] == 'admin') {
                  echo '<li><a class="dropdown-item" href="game_menu.php">Go to menu Page</a></li>';
                } elseif ($_SESSION['loginuser'] == 'guardian') {
                  echo '<li><a class="dropdown-item" href="guardian_menu.php">Go to menu Page</a></li>';
                } elseif ($_SESSION['loginuser'] == 'student') {
                  echo '<li><a class="dropdown-item" href="kids_menu.php">Go to menu Page</a></li>';
                } else {
                  echo '<li><a class="dropdown-item" href="index.php">Error Go back to login page</a></li>';
                }

                ?>
                <li>

              </ul>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Settings
              </a>
              <ul class="dropdown-menu">
                <li>
                  <label class="text-center">Music: <input type="range" id="rangeaudio" style="width: 250px;" min="0" max="100" value="100"></label>
                </li>
                <li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Mode -->
  <div class="choicemode position-absolute top-50 start-50 translate-middle d-grid gap-2">

    <button class=" rounded text-center" id="easy" onclick="easymode()" atl="#easy" loading="lazy>"></button>
    <button class=" rounded" id="normal" onclick="normalmode()" atl="#normal" loading="lazy>"></button>
    <button class=" rounded" id="hard" onclick="hardmode()" atl="#hard" loading="lazy>"> </button>

  </div>
  <!-- this is button to go on another php file -->
  <script>
    const rangevolume = document.getElementById('rangeaudio');
    const audiovolume = document.getElementById('background-audio');

    // this is for volume adjustment
    rangevolume.addEventListener('input', function() {

      audiovolume.volume = rangevolume.value / 100;

    });

    document.body.addEventListener('click', function() {
      var audioElement = document.getElementById('background-audio');

      audioElement.play();

    }, {

      once: true

    });

    function easymode() {
      window.location = "easy.php";
    }
  </script>

  <script>
    function normalmode() {
      window.location = "normal.php";
    }
  </script>

  <script>
    function hardmode() {
      window.location = "hard.php";
    }
  </script>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>