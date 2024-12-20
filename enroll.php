<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preschool Enrollment System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Preschool Enrollment System</h1>
    </header>

    <main>
        <section>
            <h2>Enroll a Student</h2>
            <form action="enroll.php" method="POST">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br>

                <label for="parent_name">Parent's Name:</label>
                <input type="text" id="parent_name" name="parent_name" required><br>

                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required><br>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea><br>

                <label for="course_id">Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="1">Math Play</option>
                    <option value="2">Science Fun</option>
                    <option value="3">English Play</option>
                    <option value="4">History Fun</option>
                    <option value="5">Art & Craft</option>
                </select><br><br>

                <button type="submit">Enroll</button>
            </form>
        </section>

        <div class="button-container">
            <a href="index.php"><button>Back to Home</button></a>
        </div>
    </main>

</body>
</html>

<?php
include('config.php');  // Include your database connection file

// Initialize error messages
$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get student details from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $parent_name = $_POST['parent_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $course_id = $_POST['course_id'];

    // Validation for First Name (Only letters allowed)
    if (empty($first_name) || !preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $errors[] = "First Name should only contain letters and spaces.";
    }

    // Validation for Last Name (Only letters allowed)
    if (empty($last_name) || !preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $errors[] = "Last Name should only contain letters and spaces.";
    }

    // Validation for Contact Number (Should be numeric and exactly 10 digits)
    if (empty($contact_number) || !is_numeric($contact_number) || strlen($contact_number) != 10) {
        $errors[] = "Contact number should be a 10-digit numeric value.";
    }

    // Ensure other fields are not empty
    if (empty($dob)) {
        $errors[] = "Date of birth cannot be empty.";
    }

    if (empty($parent_name)) {
        $errors[] = "Parent's name cannot be empty.";
    }

    if (empty($address)) {
        $errors[] = "Address cannot be empty.";
    }

    // If there are no validation errors, proceed with the database insertion
    if (empty($errors)) {
        // Insert student data into the 'students' table
        $sql_student = "INSERT INTO students (first_name, last_name, dob, parent_name, contact_number, address)
                        VALUES ('$first_name', '$last_name', '$dob', '$parent_name', '$contact_number', '$address')";

        if ($conn->query($sql_student) === TRUE) {
            $student_id = $conn->insert_id;  // Get the last inserted student ID

            // Insert enrollment data into the 'enrollment' table
            $sql_enrollment = "INSERT INTO enrollment (student_id, course_id, enrollment_date)
                               VALUES ('$student_id', '$course_id', NOW())";

            if ($conn->query($sql_enrollment) === TRUE) {
                echo "Enrollment successful!";
            } else {
                echo "Error: " . $sql_enrollment . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_student . "<br>" . $conn->error;
        }
    } else {
        // Display errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }
}
?>
