<?php
include('config.php');



// Fetch teachers data
$sql = 
"SELECT * FROM teachers";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <h2>Teachers</h2>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 80%; margin: 20px auto; border-collapse: collapse;">
        <tr>
            <th>Teacher ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Subject</th>
            <th>Hire Date</th>
            <th>Contact Number</th>
        </tr>
        <?php
        // Display teachers data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["teacher_id"] . "</td>
                    <td>" . $row["first_name"] . "</td>
                    <td>" . $row["last_name"] . "</td>
                    <td>" . $row["subject"] . "</td>
                    <td>" . $row["hire_date"] . "</td>
                    <td>" . $row["contact_number"] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No teachers found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
