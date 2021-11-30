<?php
session_start();
   include_once("./library.php"); // To connect to the database
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
   //update student table
   if (!empty($_POST['name'])){
    $sql = "UPDATE Student SET name='$_POST[name]' WHERE student_id='$_SESSION[studentID]'";
    if (!mysqli_query($db,$sql))
    {
    die('Error: ' . mysqli_error($db));
    }
   }

    
   if (!empty($_POST['year'])){
    $sql2 = "UPDATE Student SET year='$_POST[year]' WHERE student_id='$_SESSION[studentID]'";
    if (!mysqli_query($db,$sql2))
    {
    die('Error: ' . mysqli_error($db));
    }
   }
   
   if (!empty($_POST['phone_number'])){
    $sql3 = "UPDATE Student SET phone_number='$_POST[phone_number]' WHERE student_id='$_SESSION[studentID]'";
    if (!mysqli_query($db,$sql3))
    {
    die('Error: ' . mysqli_error($db));
    }
  }

   if (!empty($_POST['major'])){
    $sql4 = "UPDATE Student_Major SET major='$_POST[major]' WHERE student_id = '$_SESSION[studentID]'"; 
    if (!mysqli_query($db,$sql4))
    {
    die('Error: ' . mysqli_error($db));
    }
  }

   if (!empty($_POST['major_add'])){
    $sql5 = "INSERT INTO Student_Major (student_id, major) VALUES ('$_SESSION[studentID]','$_POST[major_add]')";
    if (!mysqli_query($db,$sql5))
    {
    die('Error: ' . mysqli_error($db));
    } 
  }

   if (!empty($_POST['addy_bldg']) && !empty($_POST['addy_rm'])){
    $sql6 = "UPDATE LivesIn SET address_street='$_POST[addy_bldg]', address_room='$_POST[addy_rm]' WHERE student_id='$_SESSION[studentID]'";
    if (!mysqli_query($db,$sql6))
    {
    die('Error: ' . mysqli_error($db));
    } 
  }

   if (!empty($_POST['addy_bldg_add']) && !empty($_POST['addy_rm_add'])){
    $sql7 = "INSERT INTO LivesIn (student_id, address_street, address_room) VALUES ('$_SESSION[studentID]','$_POST[addy_bldg_add]', '$_POST[addy_rm_add]')";
    if (!mysqli_query($db,$sql7))
    {
    die('Error: ' . mysqli_error($db));
    } 
  }

  
  echo "Profile Updated Successfully"; // Output to user
  header('location: profile.php')
?>
