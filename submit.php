<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_preferences"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting form data
$fullName = $_POST['full-name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];

// Favorite food - multiple checkboxes
$favoriteFood = isset($_POST['food']) ? $_POST['food'] : [];
$favoriteFoodString = implode(',', $favoriteFood);


// Radio selections (1 per row)
$watchMovies = $_POST['movies'] ?? '';
$listenRadio = $_POST['radio'] ?? '';
$eatOut = $_POST['eat-out'] ?? '';
$watchTV = $_POST['tv'] ?? '';

// Prepare SQL
$sql = "INSERT INTO user (full_names, email, dob, contact_number, favorite_food, watch_movies, listen_radio, eat_out, watch_tv, submitted_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssss",
    $fullName,
    $email,
    $dob,
    $contact,
    $favoriteFoodString,
    $watchMovies,
    $listenRadio,
    $eatOut,
    $watchTV,
    $submittedAt
);



// Execute and redirect or show message
if ($stmt->execute()) {
    echo "<script>alert('Survey submitted successfully!'); window.location.href='survey_report.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
