<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'FINALProject');
    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(!empty($_POST['remname'])){
        $sql1 = "SELECT * FROM isfriendswith WHERE student_id1='$_SESSION[studentID]' AND student_id2 = '$_POST[remname]'";
        $res1 = $db->query($sql1);
        if($res1->num_rows > 0){
            $sql2 = "DELETE FROM isfriendswith WHERE(student_id1 = '$_SESSION[studentID]'AND student_id2 = '$_POST[remname]')";
            if (!mysqli_query($db,$sql2))
            {
                die('Error: ' . mysqli_error($db));
            }
        }

        $sql3 = "SELECT * FROM isfriendswith WHERE student_id2='$_SESSION[studentID]' AND student_id1 = '$_POST[remname]'";
        $res2 = $db->query($sql3);
        if($res2->num_rows > 0){
            $sql4 = "DELETE FROM isfriendswith WHERE(student_id1 = '$_POST[remname]'AND student_id2 ='$_SESSION[studentID]')";
            if (!mysqli_query($db,$sql4))
            {
                die('Error: ' . mysqli_error($db));
            }
        }
    }
    echo "Remove attempted.  Check your profile page to make sure it worked"
?>
<br>
<div>
 <a href="http://localhost/FINALProject/profile.php">Profile</a>
</div>
