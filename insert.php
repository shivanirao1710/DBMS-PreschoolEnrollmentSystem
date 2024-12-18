<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $parent_name = $_POST['parent_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $course_id = $_POST['course_id'];

    // Insert student data
    $sql_student = "INSERT INTO students (first_name, last_name, dob, parent_name, contact_number, address)
                    VALUES ('$first_name', '$last_name', '$dob', '$parent_name', '$contact_number', '$address')";

    if ($conn->query($sql_student) === TRUE) {
        $student_id = $conn->insert_id;  // Get the last inserted student ID

        // Insert enrollment data
        $sql_enrollment = "INSERT INTO enrollment (student_id, course_id, enrollment_date)
                           VALUES ('$student_id', '$course_id', NOW())";

        if ($conn->query($sql_enrollment) === TRUE) {
            echo "Enrollment successful!";
        } else {
            echo "Error: " . $sql_enrollment . "<br>" . $conn->error;
        }

        // Trigger will insert payment automatically
    } else {
        echo "Error: " . $sql_student . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Success</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color:rgb(253, 211, 5);
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color:rgb(255, 83, 9);
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Enrollment Process Complete</h2>
        <p>Your enrollment has been processed successfully!</p>
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
