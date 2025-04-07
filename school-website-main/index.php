<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A BA CA DA</title>
    <link rel="stylesheet" href="style.css">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<body>

    <div class="modal" id="createAccountModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="User-name" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="User-name" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="col-form-label">Password:</label>
                            <input class="form-control" id="Password" autocomplete="off" required></input>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="register()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <section class="background" id="home">
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="">
                <span>A BA CA DA</span>
            </div>

            <ul class="nav_items" id="nav_links">
                <div class="item">
                    <li><a href="#home">Pangunahing Pahina</a></li>
                    <li><a href="#contact">Mag Log-in</a></li>
                </div>
            </ul>

            <div class="nav_menu" id="menu_btn">
                <i class="ri-menu-line"></i>
            </div>
        </nav>

        <section class="main">
            <div class="left">
                <h3>Gabay sa Matatag na Pagkatuto,</h3>
                <h1>Hakbang Tungo sa Tagumpay!</h1>
            </div>
            <div class="right">
                <img src="img/bata.jpg" alt="">
            </div>
        </section>
    </section>
    <!-- _________features -->
    <section class="sec" id="services">
        <h1 class="heading">Pangunahing Tampok</h1>

        <div class="box">
            <div class="boxes">
                <i class="ri-file-word-2-line"></i>
                <h2 class="sub_heading">Kakayahang Mag-aral Sa Sarili</h2>
                <p class="para_1">Ang E-Learning ay Nagbibigay Daan Sa Mag-Aaral Na Matuto Sa Kanilang Sarili </p>
            </div>
            <div class="boxes">
                <i class="ri-time-zone-line"></i>
                <h2 class="sub_heading">Pag-Access sa Iba't Ibang Materyales</h2>
                <p class="para_1">Ang E-Learning Ay Nag-Aalok Ng Iba't Ibang Uri ng Pag-Aaral.</p>
            </div>
            <div class="boxes">
                <i class="ri-award-line"></i>
                <h2 class="sub_heading">Pagiging Madaling Ma-Access </h2>
                <p class="para_1">Ang E-Learning Ay Maaaring Ma-Access Mula Sa Kahit Saan Sa Mundo</p>
            </div>
        </div>
    </section>
    <!-- _____________About -->
    
  

    <section class="sec" id="contact">

        <div class="box_1">
            <div class="contact_left">
                <form id="loginForm" onsubmit="return login(event);">
                    <h1 class="heading">Login</h1>
                    <input type="text" name="name" id="idusername" placeholder="Username" autocomplete="off" required>
                    <input type="password" name="pass" id="idpassword" placeholder="Password" autocomplete="off" required>
                    <button class="thisbutton btn btn1">Login</button>
                    <a class="modal_link" href="#" data-bs-toggle="modal" data-bs-target="#createAccountModal">Create New Account</a>
                </form>

            </div>
            <div class="contact_right">
                <img src="img/pic1.jpg" alt="">
                <img src="img/pic2.jpg" alt="">
                <img src="img/pic3.jpg" alt="">
                <img src="img/pic4.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- ___________footer -->
    <footer>

        <div class="sec footer_container">

            <div class="footer_col">
                <h4>about</h4>
                <ul class="footer_links">
                    <li><a href="#">about us</a></li>
                    <li><a href="#">features</a></li>
                    <li><a href="#">news</a></li>
                    <li><a href="#">menu</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <h4>company</h4>
                <ul class="footer_links">
                    <li><a href="#">partners</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">blog</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <h4>support</h4>
                <ul class="footer_links">
                    <li><a href="#">account</a></li>
                    <li><a href="#">support center</a></li>
                    <li><a href="#">feedback</a></li>
                    <li><a href="#">accessibility</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <div class="footer_logo logo">
                    <img src="img/logo.png" alt="">
                    <span>A BA CAI DA</span>
                </div>
                <ul class="footer_socials">
                    <li><a href="#"><i class="ri-instagram-fill"></i></a></li>
                    <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                    <li><a href="#"><i class="ri-twitter-fill"></i></a></li>
                </ul>
            </div>
    </footer>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="index.js"></script>



</body>

</html>