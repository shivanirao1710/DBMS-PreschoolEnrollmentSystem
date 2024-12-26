<?php
include('config.php');  // Include your database connection

// Check if a delete request has been made
if (isset($_GET['delete'])) {
    $student_id = (int) $_GET['delete']; // Get the student ID from the URL

    // Begin a transaction to ensure all delete operations happen atomically
    $conn->begin_transaction();

    try {
        // Delete from payments table
        $sql_delete_payments = "DELETE FROM payments WHERE student_id = ?";
        $stmt = $conn->prepare($sql_delete_payments);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();

        // Delete from enrollment table
        $sql_delete_enrollment = "DELETE FROM enrollment WHERE student_id = ?";
        $stmt = $conn->prepare($sql_delete_enrollment);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();

        // Delete from students table
        $sql_delete_student = "DELETE FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql_delete_student);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the same page after deletion
        header("Location: view.php");
        exit();
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        $conn->rollback();
        echo "Error deleting student: " . $e->getMessage();
    }
}

// Query to fetch all students, their enrolled course, and teacher information
$sql = "
        SELECT s.first_name AS student_first_name, s.last_name AS student_last_name, 
               c.course_name, 
               t.first_name AS teacher_first_name, t.last_name AS teacher_last_name, 
               s.student_id
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
                <th>Action</th> <!-- New column for the delete button -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['student_first_name'] . " " . $row['student_last_name']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['teacher_first_name'] . " " . $row['teacher_last_name']; ?></td>
                    <td>
                        <!-- Delete button to trigger deletion -->
                        <a href="view.php?delete=<?php echo $row['student_id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
