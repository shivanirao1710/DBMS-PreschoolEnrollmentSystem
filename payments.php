<?php
include('config.php');

// Fetch payments data
$sql = "SELECT payments.payment_id, students.first_name, students.last_name, payments.payment_date, payments.amount
        FROM payments
        INNER JOIN students ON payments.student_id = students.student_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments List</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <h2>Payments</h2>

    <table>
        <tr>
            <th>Payment ID</th>
            <th>Student Name</th>
            <th>Payment Date</th>
            <th>Amount</th>
        </tr>
        <?php
        // Display payment data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["payment_id"] . "</td>
                    <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
                    <td>" . $row["payment_date"] . "</td>
                    <td>" . $row["amount"] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No payments found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
