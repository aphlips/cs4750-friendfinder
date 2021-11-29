<?php
 session_start();
 include('errors.php');
 $db = mysqli_connect('localhost', 'root', '', '4750_project');

 if (isset($_POST['login_user'])) {
    $studentID = mysqli_real_escape_string($db, $_POST['studentID']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($studentID)) {
        array_push($errors, "Student ID is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM student WHERE student_id='$studentID' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['studentID'] = $studentID;
          $_SESSION['success'] = "You are now logged in";
          header('location: home.html');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  ?>