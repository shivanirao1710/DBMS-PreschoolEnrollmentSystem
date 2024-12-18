<?php
include('config.php');

// Fetch courses data
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <h2>Courses</h2>

    <table>
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Duration</th>
        </tr>
        <?php
        // Display courses data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["course_id"] . "</td>
                    <td>" . $row["course_name"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>" . $row["duration"] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No courses found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
