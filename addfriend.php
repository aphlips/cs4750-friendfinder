<?php
    session_start();
    //$db = mysqli_connect('localhost', 'root', '', 'FINALProject');

    //JAWSDB stuff
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $db = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(!empty($_POST['addname'])){
        //$sql1 = "SELECT * FROM isfriendswith WHERE student_id1='$_SESSION[studentID]' AND student_id2 = '$_POST[addname]'";
        //$res1 = $db->query($sql1);
        //if($res1->num_rows == 0){
            $sql2 = "INSERT INTO isfriendswith (student_id1, student_id2) VALUES('$_SESSION[studentID]','$_POST[addname]')";
            if (!mysqli_query($db,$sql2))
            {
                die('Error: ' . mysqli_error($db));
            }
       // }

        //$sql3 = "SELECT * FROM isfriendswith WHERE student_id2='$_SESSION[studentID]' AND student_id1 = '$_POST[addname]'";
       // $res2 = $db->query($sql3);
       // if($res2->num_rows == 0){
            $sql4 = "INSERT INTO isfriendswith (student_id1, student_id2) VALUES('$_POST[addname]','$_SESSION[studentID]')";
            if (!mysqli_query($db,$sql4))
            {
                die('Error: ' . mysqli_error($db));
            }
        //}

    }

    echo "Friend Add Attempted! Check your profile page to make sure it worked";

?>
<br>
<div>
 <a href="https://cs4750-friendsfinder.herokuapp.com/profile.php">Profile</a>
</div>
