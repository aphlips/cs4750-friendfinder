<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
   <div class="navbar">
      <li><a href="http://localhost/FINALProject/home.html">Home</a></li>
      <li><a href="http://localhost/FINALProject/explore.php">Explore</a></li>
      <li><a href="http://localhost/FINALProject/addfriend.html">Add Friend</a></li>
      <li><a href="http://localhost/FINALProject/profile.php">Back</a></li>
     </div>
    <title>Friend Finder</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
    table, th, td {
    border: 1px solid black;
    }
    </style>
</head>

<body>
    <h1> Explore </h1>
    <p>Find friends in your classes!</p>
    <?php 
        session_start();
        $db = mysqli_connect('localhost', 'root', '', '4750_Project');
        $sql = "SELECT student.name, student.year, course_id, section FROM Takes NATURAL JOIN student";
        if (isset($_POST['original_courses'])){
            $sql = "SELECT student.name, student.year, course_id, section FROM Takes NATURAL JOIN student";
            $res = $db->query($sql);
        }
        if (isset($_POST['submitYear'])){
            $sql1 = "UPDATE student SET show_row='yes' WHERE year='$_POST[yearChosen]'";
            $sql2 = "UPDATE student SET show_row='no' WHERE year!='$_POST[yearChosen]'";
            $sql = "SELECT student.name, student.year, course_id, section FROM Takes NATURAL JOIN student WHERE student.show_row = 'yes'";
            $db->query($sql1);
            $db->query($sql2);
            $res = $db->query($sql);
        }
        if (isset($_POST['submitCourse'])){
            $sql = "SELECT student.name, student.year, course_id, section FROM Takes NATURAL JOIN student WHERE course_id = '$_POST[classChosen]'";
            $sql = "EXEC SelectSpecificCourses @coursePrefix = '$_POST[classChosen]'";
            $res = $db->query($sql);
        }
        if (isset($_POST['submitGrounds'])){
            if ($_POST['is_on_grounds'] == "on"){
                $sql = "SELECT student.name, student.year, course_id, section FROM takes NATURAL JOIN student NATURAL JOIN livesin NATURAL JOIN address WHERE is_on_grounds = 1";
            } else {
                $sql = "SELECT student.name, student.year, course_id, section FROM takes NATURAL JOIN student NATURAL JOIN livesin NATURAL JOIN address WHERE is_on_grounds = 0";
            }
            $res = $db->query($sql);
        }
        
        if($res->num_rows > 0){
            echo"<table><tr><th>Name</th><th>Year</th><th>Course ID</th><th>Section</th></tr>";
            while($row = $res->fetch_assoc()){
                echo "<tr><td>" . $row["name"] . "</td>><td>" . $row["year"] . "</td><td>" . $row["course_id"] . "</td><td>" . $row["section"] .  "</td></tr>";
            }
            echo "</table>";
        }
        else {
            echo "0 results";
        }
        echo "<br><br><br>";
        $sql = "SELECT student.name, major FROM student NATURAL JOIN student_major";
        if (isset($_POST['original_majors'])){
            $sql = "SELECT student.name, major FROM student NATURAL JOIN student_major";
        }
        if (isset($_POST['submitMajor'])){
            $sql = "SELECT student.name, major FROM student NATURAL JOIN student_major WHERE major = '$_POST[majorChosen]'";
        }
        $res = $db->query($sql);
        if($res->num_rows > 0){
            echo"<table><tr><th>Name</th><th>Major</th></tr>";
            while($row = $res->fetch_assoc()){
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["major"] .  "</td></tr>";
            }
            echo "</table>";
        }
        else {
            echo "0 results";
        }

    ?>
    <h2>Filter by Year, Classes Taken<h/2>
    <h3>Filter the upper table by what year students are in and what classes they are taking.</h3>
    <form method="post" action="explore.php">
        <div class="input-group">
          <label>Year</label>
          <input type="number" name="yearChosen">
        </div>
        <div class="input-group">
          <label>Submit Year</label>
          <input type="submit" class="btn" name="submitYear">
        </div>
        <div class="input-group">
            <label>On or off grounds?</label>
            <select name="is_on_grounds">
                <option value="off">Off Grounds</option>
                <option value="on">On Grounds</option>
            </select>
        </div>
        <div class="input-group">
          <label>Submit On or Off Grounds</label>
          <input type="submit" class="btn" name="submitGrounds">
        </div>
        <div class="input-group">
          <label>Course Name</label>
          <input type="text" name="classChosen">
        </div>
        <div class="input-group">
          <label>Submit Course</label>
          <input type="submit" class="btn" name="submitCourse">
        </div>
        <div class="input-group">
          <label>Original</label>
          <input type="submit" class="btn" name="original_courses">
        </div>
    </form>
    <h2>Filter by Major<h/2>
    <h3>Filter the lower table by what major you want to see.</h3>
    <form method="post" action="explore.php">
        <div class="input-group">
          <label>Major</label>
          <input type="text" name="majorChosen">
        </div>
        <div class="input-group">
          <label>Submit Major</label>
          <input type="submit" class="btn" name="submitMajor">
        </div>
        <div class="input-group">
          <label>Original</label>
          <input type="submit" class="btn" name="original_majors">
        </div>
    </form>
    
</body>
</html>

