<?php
session_start();
   //$db = mysqli_connect('localhost', 'root', '', '4750_project');

   //JAWSDB stuff
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $db = new mysqli($hostname, $username, $password, $database);

   // Check connection
   if (mysqli_connect_errno())
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
   // Form the SQL query (an UPDATE query) 
   // insert new value into takes table
   if (!empty($_POST['courseID']) && !empty($_POST['section'])){
    $sql = "DELETE FROM Takes WHERE (student_id = '$_SESSION[studentID]') AND (course_id = '$_POST[courseID]' AND (section = '$_POST[section]'))";
    if (!mysqli_query($db,$sql))
    {
    die('Error: ' . mysqli_error($db));
    }
   }



   echo "Course Dropped Successfully!"; // Output to user
   header('location: profile.php');
?>
