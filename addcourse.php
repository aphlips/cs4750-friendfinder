<?php
session_start();
   $db = mysqli_connect('localhost', 'root', '', '4750_project');

   // Check connection
   if (mysqli_connect_errno())
     {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
   // Form the SQL query (an UPDATE query) 
   // insert new value into takes table
   if (!empty($_POST['courseID']) && !empty($_POST['section'])){
    $sql = "INSERT INTO Takes VALUES('$_SESSION[studentID]', '$_POST[courseID]', '$_POST[section]')";
    if (!mysqli_query($db,$sql))
    {
    die('Error: ' . mysqli_error($db));
    }
   }

    // add course to list of courses if not already existing
    // make sure that the course ID,section courseName,date, and time aren't already in there together so we don't have repeats?? 
    if (!empty($_POST['courseID']) && !empty($_POST['section']) && !empty($_POST['courseName']) && !empty($_POST['meetingDays']) && !empty($_POST['time']) && !empty($_POST['building']) && !empty($_POST['room'])){
        $sql0 = "SELECT * FROM course";
        $res0 = $db->query($sql0);
        if($res0->num_rows == 0){
            $sql1 = "INSERT INTO Course (course_id, section, name, days_of_week, time) VALUES('$_POST[courseID]', '$_POST[section]', '$_POST[courseName]', '$_POST[meetingDays]', '$_POST[time]') ";
            if (!mysqli_query($db,$sql1))
            {
                die('Error: ' . mysqli_error($db));
            }
        }

        $sql2 = "SELECT * FROM LocatedAt";
        $res2 = $db->query($sql2);
        if($res2->num_rows == 0){
            $sql3 = "INSERT INTO LocatedAt VALUES ('$_POST[courseID]', '$_POST[section]', '$_POST[building]', '$_POST[room]')";
            if (!mysqli_query($db,$sql3))
            {
                die('Error: ' . mysqli_error($db));
            }

        }
    }

    
//     $sql1 = "INSERT INTO Course (course_id, section, name, days_of_week, time) VALUES('$_POST[courseID]', '$_POST[section]', '$_POST[courseName]', '$_POST[meetingDays]', '$_POST[time]') ";
//     if (!mysqli_query($db,$sql1))
//     {
//     die('Error: ' . mysqli_error($db));
//     }

//     $sql2 = "INSERT INTO LocatedAt VALUES ('$_POST[courseID]', '$_POST[section]', '$_POST[building]', '$_POST[room]')";
//     if (!mysqli_query($db,$sql2))
//     {
//     die('Error: ' . mysqli_error($db));
//     }
//    }


   echo "Course Added Successfully!"; // Output to user
   header('location: profile.php');
?>