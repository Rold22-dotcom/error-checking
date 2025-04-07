//login function
function login(event) {
//abakada.wuaze.com
//Pzbiw5pjEX0VRi
    event.preventDefault();

    const username = document.getElementById('idusername').value;
    const password = document.getElementById('idpassword').value;
    if (username != "" && password != "") {
        const data = {
            username: username,
            password: password
        };

        $.ajax({
            url: "function.php",
            type: "POST",
            data: data,
            dataType: "text", // Expect Text response
            success: function (response) {
                alert(response);
                //regular expression to check if the response is successful
                const receive_response = response.match(/Successful|guardian|student|Failed|No_Network/);
                if (receive_response[0] === "Successful") {
                    window.location.href = "game_menu.php";
                } else if (receive_response[0] === "guardian") {
                    window.location.href = "guardian_menu.php";

                }else if (receive_response[0] === "student"){
                    window.location.href = "kids_menu.php";
                }else if (receive_response[0] === "Failed") {

                    alert("Please check your username and password or create account if you don't have one");

                } else {
                    alert("An error occurred. Please try again.");
                }
            }
        });

    }

}

//register function
//User-name Password
//this function is used to register a user
function register() {

    const username = document.getElementById('User-name').value;
    const password = document.getElementById('Password').value;

    if (username === "" || password === "") {
        alert("Please fill in the required fields");
    } else if (username.length < 6 || password.length < 16) {
        alert("Username must be at least 6 characters and password must be at least 16 characters");
    } else {
        const data = {
            cu: username,
            cp: password
        };

        $.ajax({
            url: "function.php",
            type: "POST",
            data: data,
            dataType: "text", // Expect Text response
            success: function (response) {
                //regular expression to check if the response is successful
                const receive_response = response.match(/Successful|this is already exists|Username already exists|Password already exists/);
                if (receive_response[0] === "Successful") {
                    alert("User registered successfully");
                } else if (receive_response[0] === "this is already exists") {

                    alert("you are already registered");


                } else if (receive_response[0] === "Username already exists") {

                    alert("Username already exists");


                } else if (receive_response[0] === "Password already exists") {

                    alert("Password already exists");


                } else {
                    alert("An error occurred. Please try again.");
                }
            }
        });

        $('#modal_form').modal('hide'); //hide the modal
        document.getElementById('User-name').value = "";
        document.getElementById('Password').value = "";
    }
}


// navbar scroll
window.addEventListener('scroll', function () {
    let navbar = document.querySelector('.navbar');
    if (this.window.scrollY > 20) {
        navbar.classList.add('scrolled')
    } else {
        navbar.classList.remove('scrolled')
    }
})


// navbar toggle 
const menuBtn = document.getElementById('menu_btn')
const navLinks = document.getElementById('nav_links')
const menuIcon = document.querySelector('i')

menuBtn.addEventListener('click', (e) => {
    navLinks.classList.toggle('open')

    const isOpen = navLinks.classList.contains('open')
    menuIcon.setAttribute('class', isOpen ? 'ri-close-line' : 'ri-menu-line')
})


//Animation

const scrollRevealOption = {
    distance: '50px',
    origin: 'bottom',
    duration: 1000
}

ScrollReveal().reveal('.left', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.right img', {
    ...scrollRevealOption,
    origin: 'right'
});
ScrollReveal().reveal('.heading', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.para', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.box', {
    ...scrollRevealOption,
    delay: 1000,
});
ScrollReveal().reveal('.left_box', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.mid', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.right_box', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.left_box li', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.right_box li', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.blog_box', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.contact_left', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.contact_right', {
    ...scrollRevealOption,
    delay: 500,
});
ScrollReveal().reveal('.footer_col', {
    ...scrollRevealOption,
    delay: 500,
});