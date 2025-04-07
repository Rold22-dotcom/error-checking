<?php
require 'connection.php';
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Make sure your database connection is valid
        try {
            $stmt = $con->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Successful";
                // check if the user is admin
                $_SESSION['loginuser'] = "admin";
                $_SESSION['admin-name'] = $username;
            } else {
                $stmt = $con->prepare("SELECT * FROM guardian WHERE username = ? AND password = ?");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "guardian";
                    // this is to show if the user is guardian if yes get his/her name
                    $_SESSION['loginuser'] = "guardian";
                    $_SESSION['guardian-name'] = $username;
                } else {
                    $stmt = $con->prepare("SELECT * FROM student WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        echo "student";
                        // this is to show if the user is kid if yes get his/her name
                        $_SESSION['loginuser'] = "student";
                        $_SESSION['kid-name'] = $username;
                        $stmt = $con->prepare("INSERT INTO login (kidname,guardian,message,unreadmessage) VALUES (?, ?,?,?)");
                        $row = $result->fetch_assoc();
                        $childName = $row['name'];
                        $guardianName = $row['guardian'];
                        $message = "your child name '$childName'";
                        $unreadMessage = 1;
                        $stmt->bind_param("sssi", $childName, $guardianName, $message, $unreadMessage);
                        $stmt->execute();
                    } else {
                        echo "Failed";
                    }
                }
            }
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo "No_Network";
            echo $e->getMessage();
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // this is for creating new account
        // cu means creatuser and cp means createpassword
        if (isset($_POST['cu']) && isset($_POST['cp'])) {
            $createusername = $_POST['cu'];
            $createpassword = $_POST['cp'];

            // Make sure your database connection is valid
            try {
                $stmt = $con->prepare("Select * from guardian where username = ?");
                $stmt->bind_param("s", $createusername);
                $stmt->execute();
                $usernamereceive = $result->fetch_assoc();

                $stmt = $con->prepare("Select * from guardian where password = ?");
                $stmt->bind_param("s", $createpassword);
                $stmt->execute();
                $passwordreceive = $result->fetch_assoc();
                if ($usernamereceive && $passwordreceive) {
                    echo "this is already exists";
                } else if ($usernamereceive) {
                    echo "Username already exists";
                } else if ($passwordreceive) {
                    echo "Password already exists";
                } else {
                    $stmt = $con->prepare("INSERT INTO guardian (username, password) VALUES (?, ?)");
                    $stmt->bind_param("ss", $createusername, $createpassword);
                    $stmt->execute();
                    echo "Successful";
                }
                $stmt->close();
                $con->close();
            } catch (mysqli_sql_exception $e) {
                echo $e->getMessage();
            }
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['cun']) && isset($_POST['cpuse'])) {
            //cun means child username and cpuse child password use
            $childname = $_POST['childsname'];
            $childage = $_POST['age'];
            $childparent = $_POST['parent'];
            $childusername = $_POST['cun'];
            $childpassword = $_POST['cpuse'];

            $stmt = $con->prepare("SELECT * FROM student where username = ?");
            $stmt->bind_param("s", $childusername);
            $stmt->execute();
            $result = $stmt->get_result();
            $username = $result->fetch_assoc();


            $stmt = $con->prepare("SELECT * FROM student where password = ?");
            $stmt->bind_param("s", $childpassword);
            $stmt->execute();
            $result = $stmt->get_result();
            $password = $result->fetch_assoc();


            if ($username && $password) {
                echo "this is already exists";
            } else if ($username) {
                echo "Username already exists";
            } else if ($password) {
                echo "Password already exists";
            } else {
                $stmt = $con->prepare("INSERT INTO student (username, password, guardian, name, age, easy, normal, hard) VALUES (?, ?,?,?,?,?,?,?)");
                $easy = 0;
                $normal = 0;
                $hard = 0;
                $stmt->bind_param("ssssiiii", $childusername, $childpassword, $childparent, $childname, $childage, $easy, $normal, $hard);
                $stmt->execute();
                $stmt->get_result();

                $stmt = $con->prepare("SELECT child FROM guardian WHERE username = ?");
                $stmt->bind_param("s", $childparent);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $childno = isset($row['child']) ? (int)$row['child'] : 0;

                $stmt = $con->prepare("UPDATE guardian SET child = ? WHERE username = ?");
                $childId = $childno + 1;
                $stmt->bind_param("is", $childId, $childparent);
                $stmt->execute();

                echo "Successful";
            }
            $stmt->close();
            $con->close();
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['finalscore']) && isset($_POST['finaltype'])) {
        echo "Score received: " . htmlspecialchars($_POST['finalscore']);
        $_SESSION['scoreget'] = $_POST['finalscore'];
        $_SESSION['type'] = $_POST['finaltype'];
        $username = htmlspecialchars($_POST['finaltype']); // Ensure valid username
        $score = (int)$_POST['finalscore']; // Cast POST data to integer
        $mode = $_POST['mode'];
        $zero = 0;
        if ($mode == "normal") {
           $stmt = $con->prepare("SELECT * FROM student WHERE username = ? AND normal = ?");
            $stmt->bind_param("si", $username, $zero);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Score already exists";
                $row = $result->fetch_assoc();
                $score = $score+(int)$row['score'];
            }
        
        }else if($mode == "hard" ){
            $stmt = $con->prepare("SELECT * FROM student WHERE username = ? AND hard = ?");
            $stmt->bind_param("si", $username, $zero);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Score already exists";
                $row = $result->fetch_assoc();
                $score = $score+(int)$row['score'];
            }
        }
            
        $one = 1; // this is use when the mode is clear 
        $stmt = $con->prepare("UPDATE student SET score = ?, $mode = ?   WHERE username = ?");

        $stmt->bind_param("iis", $score, $one, $username);
        $stmt->execute();

        echo "Score updated successfully for user: " . $username;
    }
}

//for the read message
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['notification_id'])) {
        $readmessage = (int)$_POST['notification_id'];
        $stmt = $con->prepare("UPDATE login SET unreadmessage = ?, readmessage = ? WHERE id = ?");
        $zero = 0;
        $read = 1;
        $stmt->bind_param("iii", $zero, $read, $readmessage);
        $stmt->execute();
    }
}
