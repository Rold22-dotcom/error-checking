<?php
require 'connection.php';
session_start();
//check if who is login
if (!isset($_SESSION['guardian-name'])) {

  header("Location: index.php");
  exit();
}

$guardian = $_SESSION['guardian-name'];
$guardianjson = json_encode($guardian);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guardian Table</title>
  <style>
    body {
      background-image: url(img/background.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;

    }
    .main-content {
      margin-top: 100px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .btn1 {
      background-color: transparent;

    }

    .btn1 button {
      background-color: rgb(148, 76, 43);
    }

    table {
            margin: auto;
            width: 80%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 1rem;
            margin-left: 1rem;
            height: 200px;
            font-weight: bold;

        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            color: rgb(0, 49, 97);
            width: auto;
        }

        th {
            background-color: rgb(122, 178, 211);
            color: rgb(0, 49, 97);
        }

        thead {
            position: sticky;
        }


  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body loading="lazy">

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
                Back
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="guardian_menu.php">Game Menu</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Child Registeration
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#myModalforaddchild" data-bs-toggle="modal" data-bs-target="#myModalforaddchild">Register a child</a>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- modal for adding child -->
  <div class="modal fade" id="myModalforaddchild">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Child Account</h1>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="child-name" class="col-form-label">Child name:</label>
              <input type="text" class="form-control" id="child-name" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="user-age" class="col-form-label">Age:</label>
              <input type="text" class="form-control" id="user-age" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="child-user-name" class="col-form-label">Username:</label>
              <input type="text" class="form-control" id="child-user-name" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="childpassword" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="childpassword" autocomplete="off" required></input>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="child()">ADD</button>
        </div>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="text-center mx-auto">
      <table class="table text-center table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Name OF Kid</th>
            <th scope="col">Age</th>
            <th scope="col">Easy</th>
            <th scope="col">Normal</th>
            <th scope="col">Hard</th>
            <th scope="col">Total Score</th>
          </tr>
        <tbody>
          <?php
          $stmt = $con->prepare("SELECT * FROM student WHERE guardian = ?");
          $stmt->bind_param("s", $guardian);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['age'] . "</td>";
              echo "<td>" . $row['easy'] . "</td>";
              echo "<td>" . $row['normal'] . "</td>";
              echo "<td>" . $row['hard'] . "</td>";
              echo "<td>" . $row['score'] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function child() {
      const valueget = <?= $guardianjson ?>;
      const childname = document.getElementById('child-name').value;
      const childusername = document.getElementById('child-user-name').value;
      const age = document.getElementById('user-age').value;
      const password = document.getElementById('childpassword').value;
      if (childusername === "" || password === "") {
        alert("Please fill in the required fields");
      } else if (childusername.length < 6 || password.length < 16) {
        alert("Username must be at least 6 characters and password must be at least 16 characters");
      } else {

        const data = {
          parent: valueget,
          childsname: childname,
          cun: childusername,
          age: age,
          cpuse: password
        };

        $.ajax({

          url: 'function.php',
          method: 'Post',
          data: data,
          dataType: 'text',
          success: function(response) {
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
        $('#myModalforaddchild').modal('hide');
        document.getElementById('child-name').value = "";
        document.getElementById('child-user-name').value = "";
        document.getElementById('user-age').value = "";
        document.getElementById('childpassword').value = "";

      }

    }
    $('#myModalforaddchild').on('hidden.bs.modal', function() {
      document.activeElement.blur(); // Remove focus from the modal
    });
  </script>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>