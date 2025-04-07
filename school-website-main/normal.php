<?php

session_start();
// this is to know who is the user a guardian , admin or a child
if (!isset($_SESSION['loginuser'])) {

    header("Location: index.php");
    exit();
}
$logintype = $_SESSION['loginuser'];
$logintypejson = json_encode($logintype);


if (isset($_POST['score'])) {
    echo "Score received: " . htmlspecialchars($_POST['score']);
    $_SESSION['scoreget'] = $_POST['score'];
}
//$_SESSION['scoreget']
$previewsscorejs = json_encode(0);
$typeuser = null;
if (isset($_SESSION['kid-name']) && $_SESSION['kid-name']) {
    $typeuserjs = json_encode($_SESSION['kid-name']);
} else {
    $typeuserjs = json_encode($typeuser);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NORMAL LEVEL</title>
    <style>
        body {
            background-image: url(img/background.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }

        button:hover {
            background-color: rgb(204, 153, 0);
        }

        button {
            background-color: rgb(148, 76, 43);
            color: rgb(15, 13, 15);
            height: 50px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;

        }

        .button-back {
            width: 200px;
            height: 50px;

        }

        .incorrect:hover {
            background-color: red;
        }

        .labelscore {
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            background: transparent;
            border: none;

        }

        #score {

            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
        }

        h3 {
            padding-top: 70px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
        }

        .back {
            width: 200px;
        }

        @media only screen and (max-width: 700px) {

            #score {
                width: 200px;
            }

            #question {
                font-size: 20px;
                margin-top: 20px;
            }

            #img {
                width: 200px;
                height: 100px;
            }

            .back {
                font-size: 50px;
            }

            .button-back {
                height: 50px;
                width: 100px;
            }

        }

        @media only screen and (max-width: 414px) {

            #score {
                width: 200px;
            }

            #question {
                margin-top: 40px;
                font-size: 20px;
            }

            #img {
                width: 300px;
                height: 70px;
            }

            .back {
                font-size: 100px;

            }

        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="#"> <!-- prevent error for favicon.ico 404 (Not Found) -->
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



<body>

    <!-- Modal  if player say the right thing-->
    <div class="modal" id="complete_modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="getanswer">Mahusay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">
                        Mahusay nasagot mo and tanong</p>
                    <img src="img/giphy.gif" alt="Tama ang sagot" width="200px" height="200px">
                </div>

            </div>
        </div>
    </div>

    <!-- Modal  if player failed-->
    <div class="modal" tabindex="-1" id="failed_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="getanswer">Mali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: medium; font-family: Arial, Helvetica, sans-serif;">
                        Mali ang iyong sagot</p>
                    <img src="img/sadimage.gif" alt="mali ang sagot" width="200px" height="200px">
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container mt-5">

            <?php

            // question for hardmode
            $scorehave = 0;
            $quizquestion = [
                [
                    "question" => " completuhin ang pangalan ng hayop kuwa__",
                    "img" => "img/owl.jpg",
                    "choices" => ["kuwago", "aso", "hayop", "ibon"],
                    "answer" => 0 // Correct answer index (A)
                ],
                [
                    "question" => "completuhin ang pangalan ng hayop __on",
                    "img" => "img/lion.png",
                    "choices" => ["tigre", "pusa", "lion", "aso"],
                    "answer" => 2
                ],
                [
                    "question" => "completuhin ang pangalan ng hayop el_p__te",
                    "img" => "img/elephant.jpg",
                    "choices" => ["pusa", "elepante", "lion", "kuwago"],
                    "answer" => 1
                ]
            ];

            //change the php to json
            $quizjson = json_encode($quizquestion);

            ?>
            <div class="text-center"> <input class="labelscore text-center font-italic" value="Score" readonly></div>
            <div class="container">
                <div class="mx-auto text-center">
                    <input class="text-center rounded" id="score" type="text" readonly value=<?= $scorehave ?>>
                </div>
            </div>

            <div class="position-absolute top-50 start-50 translate-middle d-grid gap-2">
                <div class="mx-auto text-center">
                    <h3 class="text-center" id="question"></h3>
                </div>
                <div class="mx-auto text-center">
                    <img id="img" src="" alt="quiz question" class="text-center" width="600px" height="150px">
                </div>
                <button id="button_1" onclick="nextQuestion(0)"></button>
                <button id="button_2" onclick="nextQuestion(1)"></button>
                <button id="button_3" onclick="nextQuestion(2)"></button>
                <button id="button_4" onclick="nextQuestion(3)"></button>
            </div>

            <div class="position-absolute bottom-0 start-0"><button class="button-back rounded" onclick="back()">back</button></div>

            <script>
                //using the quizjson to pass it value to quizjs
                var quizjs = <?= $quizjson ?>;
                var currentQuestionIndex = 0;
                var scorecount = document.getElementById('score');
                var previewsscore = <?= $previewsscorejs ?>;
                console.log("this is the value ", previewsscore);
                const playmusicsuccess = new Audio('music/Sfx - Success (@fowksprod).mp3');
                const playmusicfailed = new Audio('music/error.mp3');
                var currentScore = parseInt(scorecount.value) + parseInt(previewsscore);


                function updateQuiz() {
                    document.getElementById('question').innerHTML = quizjs[currentQuestionIndex].question;
                    document.getElementById('img').src = quizjs[currentQuestionIndex].img;
                    document.getElementById('button_1').innerHTML = "A. " + quizjs[currentQuestionIndex].choices[0];
                    document.getElementById('button_2').innerHTML = "B. " + quizjs[currentQuestionIndex].choices[1];
                    document.getElementById('button_3').innerHTML = "C. " + quizjs[currentQuestionIndex].choices[2];
                    document.getElementById('button_4').innerHTML = "D. " + quizjs[currentQuestionIndex].choices[3];
                }

                function ajaxrecord() {
                    const usertype = <?= $typeuserjs ?>; // Define usertype using PHP variab
                    if (usertype != null) {
                        const normalmode = "normal";
                        const data = {
                            finalscore: scorecount.value,
                            finaltype: usertype,
                            mode: normalmode
                        };

                        $.ajax({
                            url: 'function.php',
                            method: 'POST',
                            data: data,
                            success: function(response) {

                                // console.log("Response: " + response); // Confirm value arrives
                                setTimeout(() => {
                                    // Ensure AJAX completes first

                                    window.location = "game.php";

                                }, 2000);
                            }
                        });
                    } else {
                        setTimeout(() => {
                            const usertype = <?= $logintypejson ?>;
                            if (usertype === "admin") {
                                window.location = "game.php";
                            } else if (usertype === "guardian") {
                                window.location = "guardian_menu.php";
                            }

                        }, 2000);
                    }
                }

                // Function to move to the next question
                function nextQuestion(choiceIndex) {
                    selectedAnswer = document.getElementById('button_' + (choiceIndex + 1));
                    // Check if the selected answer is correct
                    if (choiceIndex === quizjs[currentQuestionIndex].answer) {
                        currentScore++;
                        scorecount.value = currentScore;
                        // Move to the next question if available
                        if (currentQuestionIndex < quizjs.length - 1) { //width: 300px;
                            currentQuestionIndex++;
                            playmusicsuccess.play();
                            $("#complete_modal").modal('show');
                            updateQuiz();
                        } else {
                            playmusicsuccess.play();
                            $("#complete_modal").modal('show');
                            ajaxrecord();


                        }
                    } else {
                        selectedAnswer.classList.add("incorrect");
                        setTimeout(() => {
                            selectedAnswer.classList.remove("incorrect");
                        }, 800);
                        if (currentQuestionIndex < quizjs.length - 1) {
                            currentQuestionIndex++;
                            playmusicfailed.play();
                            $('#failed_modal').modal('show');
                            updateQuiz();
                        } else {
                            playmusicfailed.play();
                            $('#failed_modal').modal('show');
                            ajaxrecord();

                        }
                    }


                }

                // Initialize the first question when the page loads
                updateQuiz();

                function back() {
                    var checking = <?= $logintypejson ?>;
                    if (checking === "admin") {
                        window.location = "game_menu.php";
                    } else if (checking === "guardian") {
                        window.location = "guardian_menu.php";
                    } else {
                        window.location = "kids_menu.php";
                    }
                }
                $('#complete_modal').on('hidden.bs.modal', function() {
                    document.activeElement.blur(); // Remove focus from the modal
                });
                $('#failed_modal').on('hidden.bs.modal', function() {
                    document.activeElement.blur(); // Remove focus from the modal
                });
            </script>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>