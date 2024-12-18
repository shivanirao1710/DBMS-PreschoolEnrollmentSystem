<?php
// Include the database connection config
include('config.php');

// Query to count total students
$studentCountQuery = "SELECT COUNT(*) AS student_count FROM students";
$studentCountResult = $conn->query($studentCountQuery);
$studentCount = $studentCountResult->fetch_assoc()['student_count'];

// Query to count total teachers
$teacherCountQuery = "SELECT COUNT(*) AS teacher_count FROM teachers";
$teacherCountResult = $conn->query($teacherCountQuery);
$teacherCount = $teacherCountResult->fetch_assoc()['teacher_count'];

// Query to count new enrollments in the last 30 days
$newEnrollmentsQuery = "SELECT COUNT(*) AS new_enrollments FROM enrollment WHERE enrollment_date >= CURDATE() - INTERVAL 1 MONTH";
$newEnrollmentsResult = $conn->query($newEnrollmentsQuery);
$newEnrollments = $newEnrollmentsResult->fetch_assoc()['new_enrollments'];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Dashboard Styling */
.dashboard-container {
    display: flex;
    justify-content: space-between;  /* Adjusted to give spacing */
    margin-top: 30px;
    
}

.dashboard-card {
    background: #FFFF8F;
    border: 2px solid black;
    padding: 20px;
    width: 20%; 
    height: 18%;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    margin-right: 20px;  /* Added margin to separate the cards */
    text-align: center;  /* Center text inside the card */
}

.dashboard-card:last-child {
    margin-right: 30px;  /* Ensure the last card has no right margin */
}
.dashboard-card:first-child {
    margin-left: 30px;  /* Ensure the last card has no right margin */
}

.dashboard-card h2 {
    font-size: 1.5rem;
    color:rgb(173, 44, 5);
    margin-bottom: 10px;
}

.dashboard-card p {
    font-size: 2rem;
    font-weight: bold;
    color: rgb(173,44,5);
}

/* Button Container Styling */
.button-container {
    text-align: center;
    margin-top: 30px;
}

button {
    background: linear-gradient(90deg,rgb(243, 67, 3),rgb(255, 102, 0)); /* Bright orange gradient */
    color: white;
    padding: 14px 24px;
    cursor: pointer;
    font-size: 18px;
    border-radius: 12px;
    border: none;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
}

button:hover {
    background: linear-gradient(90deg,rgb(224, 4, 4), #ff3d00); /* Deeper orange gradient */
    transform: translateY(-4px); /* Lift effect */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
}

    </style>
    <title>Dashboard - Preschool Enrollment System</title>
</head>
<body>

    <h2>Preschool Enrollment Dashboard</h2>  <!-- Centering main title -->

    <div class="dashboard-container">
        <div class="dashboard-card">
            <h2>Total Students</h2>
            <p><?php echo $studentCount; ?></p>
        </div>

        <div class="dashboard-card">
            <h2>Total Teachers</h2>
            <p><?php echo $teacherCount; ?></p>
        </div>

        <div class="dashboard-card">
            <h2>New Enrollments</h2>
            <p><?php echo $newEnrollments; ?></p>
        </div>
    </div>

    <div class="button-container">
        <a href="index.php"><button>Back to Home</button></a>
    </div>

</body>
</html>
