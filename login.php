<?php
 session_start();
 include('errors.php');
 //$db = mysqli_connect('localhost', 'root', '', '4750_project');

 //JAWSDB stuff
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $db = new mysqli($hostname, $username, $password, $database);

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
        $q = "SELECT * FROM student WHERE student_id='$studentID' AND password='$password'";
        $results = mysqli_query($db, $q);
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
