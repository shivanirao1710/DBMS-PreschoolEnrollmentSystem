<?php
include('config.php');  // Include your database connection

// Query to fetch all students, their enrolled course, and teacher information
$sql = "
        SELECT s.first_name AS student_first_name, s.last_name AS student_last_name, 
       c.course_name, 
       t.first_name AS teacher_first_name, t.last_name AS teacher_last_name
FROM students s
JOIN enrollment e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
JOIN teachers t ON c.course_name = t.subject
";

$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    echo "Error executing query: " . $conn->error;
    exit;
}

// If no students are found
if ($result->num_rows == 0) {
    echo "No students found!";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students Enrollment Details</title>
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h2>All Students Enrollment Details</h2>

    <!-- Table to display student details -->
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Course Enrolled</th>
                <th>Teacher Name</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['student_first_name'] . " " . $row['student_last_name']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['teacher_first_name'] . " " . $row['teacher_last_name']; ?></td>
                    
                </tr>
                
            <?php } ?>
            
    
        </tbody>
    </table>
    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
