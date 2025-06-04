<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_preferences";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Calculate survey summary from `user` table
$sql = "
    SELECT
        COUNT(*) AS total_surveys,
        ROUND(AVG(TIMESTAMPDIFF(YEAR, dob, CURDATE())), 1) AS average_age,
        MAX(TIMESTAMPDIFF(YEAR, dob, CURDATE())) AS oldest_age,
        MIN(TIMESTAMPDIFF(YEAR, dob, CURDATE())) AS youngest_age,
        ROUND(100 * SUM(favorite_food LIKE '%pizza%') / COUNT(*), 1) AS pizza_pct,
        ROUND(100 * SUM(favorite_food LIKE '%pasta%') / COUNT(*), 1) AS pasta_pct,
        ROUND(100 * SUM(favorite_food LIKE '%pap-wors%') / COUNT(*), 1) AS pap_wors_pct,
        ROUND(100 * SUM(watch_movies IN ('strongly-agree', 'agree')) / COUNT(*), 1) AS movies_like,
        ROUND(100 * SUM(listen_radio IN ('strongly-agree', 'agree')) / COUNT(*), 1) AS radio_like,
        ROUND(100 * SUM(eat_out IN ('strongly-agree', 'agree')) / COUNT(*), 1) AS eat_out_like,
        ROUND(100 * SUM(watch_tv IN ('strongly-agree', 'agree')) / COUNT(*), 1) AS tv_like
    FROM user;
";


$result = $conn->query($sql);
$summary = $result ? $result->fetch_assoc() : null;

// Optional: Save to `survey_summary` table
if ($summary) {
    $insert = $conn->prepare("INSERT INTO survey_summary (
        total_surveys, average_age, oldest_age, youngest_age,
        pizza_pct, pasta_pct, pap_wors_pct,
        movies_like, radio_like, eat_out_like, tv_like
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$insert) {
        die("Prepare failed: " . $conn->error);
    }

    $insert->bind_param(
        "ddddddddddd",
        $summary['total_surveys'],
        $summary['average_age'],
        $summary['oldest_age'],
        $summary['youngest_age'],
        $summary['pizza_pct'],
        $summary['pasta_pct'],
        $summary['pap_wors_pct'],
        $summary['movies_like'],
        $summary['radio_like'],
        $summary['eat_out_like'],
        $summary['tv_like']
    );

    $insert->execute();
    $insert->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survey Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; padding: 0;
            background: #f9f9f9;
            color: #000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar .brand {
            font-weight: bold;
            font-size: 22px;
        }

        .nav-links a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            margin-left: 20px;
            border-bottom: 2px solid transparent;
        }

        .nav-links a.active {
            color: #007BFF;
            border-color: #007BFF;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            
        }

        th, td {
            text-align: left;
            padding: 10px 12px;
            background: transparent;
            border: none;
             font-weight: normal;
        }

        tr {
            border: none;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="brand">_Surveys</div>
    <div class="nav-links">
        <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">FILL OUT SURVEY</a>
        <a href="survey_report.php" class="<?= basename($_SERVER['PHP_SELF']) == 'survey_report.php' ? 'active' : '' ?>">VIEW SURVEY RESULTS</a>
    </div>
</nav>

<div class="container">
    <h1>Survey Results</h1>

    <?php if ($summary): ?>
    <table>
        <tr><th>Total number of Surveys:</th><td><?= htmlspecialchars($summary['total_surveys']) ?></td></tr>
        <tr><th>Average Age:</th><td><?= htmlspecialchars($summary['average_age']) ?></td></tr>
        <tr><th>Oldest person who participated in survey</th><td><?= htmlspecialchars($summary['oldest_age']) ?></td></tr>
        <tr><th>Youngest person who participated in survey</th><td><?= htmlspecialchars($summary['youngest_age']) ?></td></tr>
        <tr style="height: 30px;"></tr>
        <tr><th>Percentage of people who like Pizza:</th><td><?= htmlspecialchars($summary['pizza_pct']) ?>%</td></tr>
        <tr><th>Percentage of people who like Pasta:</th><td><?= htmlspecialchars($summary['pasta_pct']) ?>%</td></tr>
        <tr><th>Percentage of people who like Pap and Wors:</th><td><?= htmlspecialchars($summary['pap_wors_pct']) ?>%</td></tr>
        <tr style="height: 30px;"></tr>
        <tr><th>People who like to watch movies:</th><td><?= htmlspecialchars($summary['movies_like']) ?>%</td></tr>
        <tr><th>People who like to listen to radio:</th><td><?= htmlspecialchars($summary['radio_like']) ?>%</td></tr>
        <tr><th>People who like to eat Out:</th><td><?= htmlspecialchars($summary['eat_out_like']) ?>%</td></tr>
        <tr><th>People who like to watch TV:</th><td><?= htmlspecialchars($summary['tv_like']) ?>%</td></tr>
    </table>
    <?php else: ?>
        <p>No survey data available.</p>
    <?php endif; ?>
</div>

</body>
</html>