<?php
$currentPage = $_GET['page'] ?? 'form';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Survey</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      color: #000;
    }

    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 24px;
    }

    .brand {
      font-weight: bold;
      font-size: 20px;
    }

    .nav-links {
      display: flex;
      gap: 20px;
    }

    .nav-links a {
      text-decoration: none;
      color: #000;
      font-size: 16px;
      padding: 8px 12px;
      border-radius: 4px;
    }

    .nav-links a.active {
      color: #007BFF;
      font-weight: bold;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: none;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #007BFF;
      color: white;
    }

    input[type="text"], input[type="email"], input[type="date"], input[type="tel"] {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: 2px solid #007BFF;
      border-radius: 4px;
    }

    button {
      margin-top: 20px;
      background-color: #007BFF;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="brand">_Surveys</div>
  <div class="nav-links">
    <a href="index.php" class="<?= $currentPage == 'form' ? 'active' : '' ?>">FILL OUT SURVEY</a>
    <a href="survey_report.php" class="<?= $currentPage == 'report' ? 'active' : '' ?>">VIEW SURVEY REPORTS</a>
  </div>
</nav>

<div class="container">
<?php if ($currentPage == 'form'): ?>
  <h2>Personal Details</h2>
  <form method="post" action="submit.php" id="survey-form">
    <label for="full-name">Full Names</label>
    <input type="text" id="full-name" name="full-name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" required>
    <div id="dob-error" class="error"></div>

    <label for="contact">Contact Number</label>
    <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" required>

    <fieldset>
      <p>What is your favorite food?</p>
      <label><input type="checkbox" name="food[]" value="pizza">Pizza</label>
      <label><input type="checkbox" name="food[]" value="pasta">Pasta</label>
      <label><input type="checkbox" name="food[]" value="pap-wors">Pap and Wors</label>
      <label><input type="checkbox" name="food[]" value="other">Other</label>
    </fieldset>

     <p>Please rate your level of agreement on a scale from 1 to 5, with being "Strongly Agree"and 5 being "Strongly Disagree"</p>
    <table>
      <thead>
        <tr>
          <th></th>
          <th>Strongly Agree</th>
          <th>Agree</th>
          <th>Neutral</th>
          <th>Disagree</th>
          <th>Strongly Disagree</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $questions = [
          "movies" => "I like to watch movies",
          "radio" => "I like to listen to the radio",
          "eat-out" => "I like to eat out",
          "tv" => "I like to watch TV"
        ];
        $values = ["strongly-agree", "agree", "neutral", "disagree", "strongly-disagree"];
        foreach ($questions as $name => $label) {
          echo "<tr><td>$label</td>";
          foreach ($values as $val) {
            echo "<td><input type='radio' name='$name' value='$val' required></td>";
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit">SUBMIT</button>
  </form>

<?php elseif ($currentPage == 'report'): ?>
  <h2>Survey Summary Report</h2>
  <?php
  $conn = new mysqli("localhost", "root", "", "user_preferences");
  if ($conn->connect_error) {
    echo "<p style='color:red;'>Failed to connect: " . $conn->connect_error . "</p>";
  } else {
    $result = $conn->query("SELECT * FROM survey_summary LIMIT 1");
    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo "<table>";
      foreach ($row as $key => $val) {
        $label = ucwords(str_replace("_", " ", $key));
        echo "<tr><th>$label</th><td>$val" . (strpos($key, '_pct') !== false ? '%' : '') . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No survey data found.</p>";
    }
    $conn->close();
  }
  ?>
<?php endif; ?>
</div>

<script>
document.getElementById('survey-form').addEventListener('submit', function (e) {
  const dob = document.getElementById('dob').value;
  const errorDiv = document.getElementById('dob-error');
  errorDiv.textContent = '';

  if (dob) {
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    if (age < 5 || age > 120) {
      e.preventDefault();
      errorDiv.textContent = "Age must be between 5 and 120 years.";
    }
  }
});
</script>

</body>
</html>
<link rel="stylesheet" href="styles.css">